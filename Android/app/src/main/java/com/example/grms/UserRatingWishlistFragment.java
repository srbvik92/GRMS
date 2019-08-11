package com.example.grms;

import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.constraint.ConstraintLayout;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;

import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLEncoder;
import java.util.Iterator;

import javax.net.ssl.HttpsURLConnection;

public class UserRatingWishlistFragment extends Fragment {

    View view;
    String line, code;

    //layout variables
    ViewGroup container;
    ConstraintLayout userData, userSubmit, mainLayout;
    Spinner userPlatformSpinner, userRatingSpinner;
    EditText userCompletionEditText;
    Button submitUserData, addWishlist;

    //user data insert variables
    int userRating;
    String userPlatform, userPlatformString;
    int userCompletion, userRatingInt;
    JSONObject jObj;

    public UserRatingWishlistFragment() {
        // Required empty public constructor
        new GetInsertUserRating().execute();
    }

    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        //return super.onCreateView(inflater, container, savedInstanceState);
        this.container=container;

        //inflate the layout
        view = getLayoutInflater().inflate(R.layout.fragment_user_rating_wishlist, container, false);

        mainLayout = (ConstraintLayout)view.findViewById(R.id.main_layout);

        userData = (ConstraintLayout) view.findViewById(R.id.user_data_load);
        userSubmit = (ConstraintLayout) view.findViewById(R.id.user_submit);


        /*userPlatformSpinner = view.findViewById(R.id.platform_user);
        userRatingSpinner = view.findViewById(R.id.rating_user);
        userCompletionEditText = view.findViewById(R.id.completion_user);  */
        //this.container.removeView(view);
        new GetInsertUserRating().execute();



        return  view;
    }

    public class GetInsertUserRating extends AsyncTask<String, Void, String> {


        protected void onPreExecute() {
        }

        protected String doInBackground(String... arg0) {

            try {

                //get game id from GameDetails Activity
                GameDetails gd;
                gd = (GameDetails) getActivity();

                URL url = new URL(Variables.server+"android/check_user_ratingwishlist_android.php"); // here is your URL path

                JSONObject postDataParams = new JSONObject();
                postDataParams.put("gid", gd.gid);
                postDataParams.put("username", Variables.username);


                //postDataParams.put("pass",pass);
                Log.e("params", postDataParams.toString());
                Log.d("userfragment", "user");

                HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                conn.setReadTimeout(15000 /* milliseconds */);
                conn.setConnectTimeout(15000 /* milliseconds */);
                conn.setRequestMethod("POST");
                conn.setDoInput(true);
                conn.setDoOutput(true);

                OutputStream os = conn.getOutputStream();
                BufferedWriter writer = new BufferedWriter(
                        new OutputStreamWriter(os, "UTF-8"));
                writer.write(getPostDataString(postDataParams));

                writer.flush();
                writer.close();
                os.close();

                int responseCode = conn.getResponseCode();

                if (responseCode == HttpsURLConnection.HTTP_OK) {
                    Log.d("userfragment", "inside if");
                    BufferedReader in = new BufferedReader(new
                            InputStreamReader(
                            conn.getInputStream()));

                    StringBuffer sb = new StringBuffer("");


                    while ((line = in.readLine()) != null) {

                        sb.append(line);
                        break;
                    }

                    JSONArray arr = new JSONArray(sb.toString());
                    //Log.e("result", sb.toString());

                    //Log.d("userfragment", "line 129");

                    jObj = arr.getJSONObject(0);

                    code = jObj.getString("code");
                    Log.d("code", code);





                    //JSONObject jObj = new JSONObject(arr.toString());
                    //String arr = new String(jObj.getString("uname"));
                    //String error = new String(jObj.getString("code"));
                    // String uname = jObj.getString("uname");
                    //JSONObject jObj = new JSONObject(arr.getJSONObject());
                    //JSONArray eventDetails = jObj.getJSONArray("title");
                    //Log.e("mytag", jObj.toString());

                    //String uname = jObj.getString("title");

                    //JSONObject jObj = new JSONObject(arr.toString());
                    //imageUrl = new String(jObj.getString("image"));
                    //title = new String(jObj.getString("title"));



                    in.close();
                    //user.setText(title[2]);
                    return sb.toString();


                } else {
                    return new String("false : " + responseCode);
                }
            } catch (Exception e) {
                return new String("Exception: " + e.getMessage());
            }

        }

        @Override
        protected void onPostExecute(String result) {
            //Toast.makeText(getActivity().getApplicationContext(), result,
            //Toast.LENGTH_LONG).show();
            //user.setText(loginMessage);

            //Log.d("bubi", title+imageUrl);

//inflate different layout based on the data received from the server

            //if played and rated by user
            if(code.equals("played")){
                Log.e("played","played");

                //View view1 = getLayoutInflater().inflate(R.layout.fragment_user_rating_rated, container, false);
                // first remove submit user data view
                mainLayout.removeView(userSubmit);

                try{
                    String completion = jObj.getString("completion");
                    String ratingUser = jObj.getString("rating_user");
                    String platformUser = jObj.getString("platform_user");

                    TextView completionTextView = (TextView) view.findViewById(R.id.completion_user_load);
                    TextView ratingUserTextView = (TextView) view.findViewById(R.id.rating_user_load);
                    TextView platformUserTextView = (TextView) view.findViewById(R.id.completion_user_load);

                    completionTextView.setText(completion);
                    ratingUserTextView.setText(ratingUser);
                    platformUserTextView.setText(platformUser);

                    //container.addView(view);

                } catch (Exception e){
                    e.printStackTrace();
                }

            }
            //if not rated by user or not played by user
            else{
                //view = getLayoutInflater().inflate(R.layout.fragment_user_rating_wishlist, container, false);
                //remove load user data view
                Log.e("else", "else");
                mainLayout.removeView(userData);
                userPlatformSpinner = view.findViewById(R.id.platform_user);
                userRatingSpinner = view.findViewById(R.id.rating_user);
                userCompletionEditText = view.findViewById(R.id.completion_user);
//                container.addView(view);
            }

        }
    }

    public String getPostDataString(JSONObject params) throws Exception {

        StringBuilder result = new StringBuilder();
        boolean first = true;

        Iterator<String> itr = params.keys();

        while(itr.hasNext()){

            String key= itr.next();
            Object value = params.get(key);

            if (first)
                first = false;
            else
                result.append("&");

            result.append(URLEncoder.encode(key, "UTF-8"));
            result.append("=");
            result.append(URLEncoder.encode(value.toString(), "UTF-8"));

        }
        return result.toString();
    }
}
