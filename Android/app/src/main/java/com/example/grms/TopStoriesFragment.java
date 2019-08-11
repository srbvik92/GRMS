package com.example.grms;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.annotation.Nullable;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.daimajia.slider.library.Animations.DescriptionAnimation;
import com.daimajia.slider.library.SliderLayout;
import com.daimajia.slider.library.SliderTypes.BaseSliderView;
import com.daimajia.slider.library.SliderTypes.TextSliderView;
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
import java.util.HashMap;

import javax.net.ssl.HttpsURLConnection;

public class TopStoriesFragment extends Fragment {

    public String line ="";
    TextView user;
    int nid[] = new int[5];
    String[] title = new String[5];
    String[] image = new String[5];
    ImageView storyImage1;
    TextView storyDesc1;
    RelativeLayout relativeLayout1;

    //listview variables
    LayoutInflater minflater;
    ViewGroup mcontainer;
    ListView topStoriesListView;

    @Nullable
    @Override
    public View onCreateView(LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        super.onCreateView(inflater, container, savedInstanceState);
        View rootView = inflater.inflate(R.layout.top_stories_fragment_layout, container, false);

        /*storyImage1 = (ImageView) rootView.findViewById(R.id.storyImage1);
        storyDesc1 = (TextView) rootView.findViewById(R.id.storyDesc1);
        relativeLayout1 = (RelativeLayout) rootView.findViewById(R.id.relativeLayout1);


        new GetImageDesc().execute();

        relativeLayout1.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent storyDetails = new Intent(getContext(), StoryDetails.class );
                storyDetails.putExtra("id", nid[0]);
                startActivity(storyDetails);
            }
        }); */

        this.minflater = inflater;
        this.mcontainer = container;

        topStoriesListView = (ListView) rootView.findViewById(R.id.topStories);

        TopStoriesAdapter tpa = new TopStoriesAdapter(getActivity(), null,null, null);

        topStoriesListView.setAdapter(tpa);

        new GetImageDesc().execute();

        topStoriesListView.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Toast.makeText(getActivity().getApplicationContext(), title[position],
                        Toast.LENGTH_LONG).show();
                Intent storyDetails = new Intent(getContext(), StoryDetails.class );
                storyDetails.putExtra("id", nid[position]);
                startActivity(storyDetails);
            }
        });

        return rootView;
    }


    //get images and description for populating into view
    public class GetImageDesc extends AsyncTask<String, Void, String> {

        ImageView bmImage;

        protected void onPreExecute(){}

        protected String doInBackground(String... arg0) {

            try {

                URL url = new URL(Variables.server+"android/top_stories_android.php"); // here is your URL path

                JSONObject postDataParams = new JSONObject();
                //postDataParams.put("uname",username);
                //postDataParams.put("pass",pass);
                // Log.e("params",postDataParams.toString());

                HttpURLConnection conn = (HttpURLConnection) url.openConnection();
                conn.setReadTimeout(15000 /* milliseconds */);
                conn.setConnectTimeout(15000 /* milliseconds */);
                conn.setRequestMethod("POST");
                conn.setDoInput(true);
                conn.setDoOutput(true);

                OutputStream os = conn.getOutputStream();
                BufferedWriter writer = new BufferedWriter(
                        new OutputStreamWriter(os, "UTF-8"));
                //writer.write(getPostDataString(postDataParams));

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

                    //nid = new int[arr.length()];
                    //title = new String[arr.length()];
                    //image = new String[arr.length()];
                    for(int n=0;n<arr.length();n++){

                        JSONObject obj = arr.getJSONObject(n);
                        if (obj != null) {
                            nid[n]= Integer.parseInt(obj.getString("nid"));
                            title[n]=obj.getString("title");
                            image[n]=obj.getString("top_image");
                            Log.d("topstories", image[n]);
                        }
                    }
                    //title1 = title[1];
                    //image1 = image[1];

                    //JSONObject jObj = new JSONObject(arr.toString());
                    //String arr = new String(jObj.getString("uname"));
                    //String error = new String(jObj.getString("code"));
                    // String uname = jObj.getString("uname");
                    //JSONObject jObj = new JSONObject(arr.getJSONObject());
                    //JSONArray eventDetails = jObj.getJSONArray("title");
                    //Log.e("mytag", jObj.toString());

                    //String uname = jObj.getString("title");



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


            //load image into imageview from server
            /*Picasso.with(getContext())
                    .load(image[0])
                    .fit()
                    .into(storyImage1);
            storyDesc1.setText(title[0]);  */

            //pass data to adapter to load into listview

            TopStoriesAdapter tpa = new TopStoriesAdapter(getActivity(), title, image, nid);

            topStoriesListView.setAdapter(tpa);

            tpa.notifyDataSetChanged();

        }
    }
}
