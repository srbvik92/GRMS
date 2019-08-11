package com.example.grms;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
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

public class GameDetails extends AppCompatActivity {

    //layout variables
    TextView platformTextView, developerTextView, relDateTextView, genreTextView, summaryTextView, avgRatingTextView, titleTextView;
    ImageView logoImageView, ageRatingImageView;
    String logo;
    String platform;
    String reldate, developer, genre, summary, ageRating, avgRating, title;

    //user submission layout
    Spinner userPlatformSpinner, userRatingSpinner;
    EditText userCompletionEditText;
    Button submitUserData, addWishlist;

    //user data insert variables
    int userRating;
    String userPlatform, userPlatformString;
    int userCompletion, userRatingInt;

    int gid;
    //other Variables
    String line;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_game_details);

        //fro displaying the data received from server of the game
        logoImageView = findViewById(R.id.logo);
        ageRatingImageView = findViewById(R.id.ageRating);
        platformTextView = findViewById(R.id.platform);
        developerTextView = findViewById(R.id.developer);
        relDateTextView = findViewById(R.id.relDate);
        genreTextView = findViewById(R.id.genre);
        summaryTextView = findViewById(R.id.summary);
        avgRatingTextView = findViewById(R.id.avgRating);
        titleTextView = findViewById(R.id.gname);

        //for taking data from user
        userPlatformSpinner = findViewById(R.id.platform_user);
        userRatingSpinner = findViewById(R.id.rating_user);
        userCompletionEditText = findViewById(R.id.completion_user);

        //get game id of the clicked game
        Intent in = getIntent();
        gid = in.getIntExtra("gid", 0);

        new GetGameDetails().execute();

        submitUserData = findViewById(R.id.submitUserData);
        addWishlist = findViewById(R.id.userAddWishlist);

        //submitUserData.setVisibility(Button.GONE);

        submitUserData.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

            }
        });

    }

    //get game details from the server
    public class GetGameDetails extends AsyncTask<String, Void, String> {


        protected void onPreExecute(){}

        protected String doInBackground(String... arg0) {

            try {

                URL url = new URL(Variables.server+"android/game_details_android.php"); // here is your URL path

                JSONObject postDataParams = new JSONObject();
                postDataParams.put("gid",gid);
                //postDataParams.put("pass",pass);
                Log.e("params",postDataParams.toString());

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

                int responseCode=conn.getResponseCode();

                if (responseCode == HttpsURLConnection.HTTP_OK) {

                    BufferedReader in=new BufferedReader(new
                            InputStreamReader(
                            conn.getInputStream()));

                    StringBuffer sb = new StringBuffer("");


                    while((line = in.readLine()) != null) {

                        sb.append(line);
                        break;
                    }

                    JSONArray arr = new JSONArray(sb.toString());
                    //Log.e("result", sb.toString());

                    JSONObject jObj = arr.getJSONObject(0);


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


                    title = new String(jObj.getString("title"));
                    logo = new String(jObj.getString("logo"));
                    platform = new String(jObj.getString("platform"));
                    reldate = new String(jObj.getString("genre"));
                    developer = new String(jObj.getString("developer"));
                    genre = new String(jObj.getString("genre"));
                    summary = new String(jObj.getString("summary"));
                    ageRating = new String(jObj.getString("agerating"));
                    avgRating = new String(jObj.getString("rating"));


                    Log.d("rating", avgRating);

                    in.close();
                    //user.setText(title[2]);
                    return sb.toString();


                }
                else {
                    return new String("false : "+responseCode);
                }
            }
            catch(Exception e){
                return new String("Exception: " + e.getMessage());
            }

        }

        @Override
        protected void onPostExecute(String result) {
            //Toast.makeText(getActivity().getApplicationContext(), result,
            //Toast.LENGTH_LONG).show();
            //user.setText(loginMessage);

            //Log.d("bubi", title+imageUrl);

            //load image
            Picasso.with(getApplicationContext()).load(logo).into(logoImageView);

            //load other values
            titleTextView.setText(title);
            platformTextView.setText(platform);
            relDateTextView.setText(reldate);
            developerTextView.setText(reldate);
            genreTextView.setText(genre);
            developerTextView.setText(developer);
            summaryTextView.append(summary);
            avgRatingTextView.setText(avgRating);


            //load esrb image
            switch (ageRating){

                case "18+":
                    ageRatingImageView.setImageResource(R.drawable.esrb_m);
                    break;
                case "E":
                    ageRatingImageView.setImageResource(R.drawable.esrb_e);
                    break;
                case "T":
                    ageRatingImageView.setImageResource(R.drawable.esrb_t);
                    break;
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
