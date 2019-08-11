package com.example.grms;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.webkit.WebView;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

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

public class StoryDetails extends AppCompatActivity {

    //basic variables for loading in to layout
    ImageView image;
    String title;
    String imageUrl;
    //String content;
    WebView content;

    //Variables to fetch data from server
    String line;
    int id;

    //layout variables
    TextView titleTextView;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_story_details);

        titleTextView = findViewById(R.id.title);
        image = findViewById(R.id.imageView);
        content = findViewById(R.id.content);

        Intent in = getIntent();
        id = in.getIntExtra("id",0);

        new GetImageDescContent().execute();
    }


    //get image, title and content from server
    public class GetImageDescContent extends AsyncTask<String, Void, String> {

        ImageView bmImage;

        protected void onPreExecute(){}

        protected String doInBackground(String... arg0) {

            try {

                URL url = new URL(Variables.server+"android/story_details_android.php"); // here is your URL path

                JSONObject postDataParams = new JSONObject();
                postDataParams.put("id",id);
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
                    imageUrl = new String(jObj.getString("image"));
                    title = new String(jObj.getString("title"));

                    Log.d("imageurl", imageUrl);
                    Log.d("storytitle", title);

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
            Toast.makeText(getApplicationContext(), result,
            Toast.LENGTH_LONG).show();
            //user.setText(loginMessage);

            Log.d("bubi", title+imageUrl);
            //load image into imageview from server
            titleTextView.setText(title);
            String postData = new String();
            try{postData = "id=" + URLEncoder.encode(id+"", "UTF-8");}
            catch (Exception e){}

            Picasso.with(getApplicationContext()).load(imageUrl).into(image);
            content.getSettings().setJavaScriptEnabled(true);
            content.postUrl(Variables.server+"android/stories_content_android.php", postData.getBytes());

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
