package com.example.grms;

import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedOutputStream;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.URL;
import java.net.URLConnection;
import java.net.URLEncoder;
import java.util.Iterator;

import javax.net.ssl.HttpsURLConnection;

public class LoginAction extends AppCompatActivity {


    String username;
    String pass;
    TextView user;
    String line="";
    String uname;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        //setContentView(R.layout.activity_login_action);

        Intent in = getIntent();

        username = (String) in.getStringExtra("username");
        pass = (String) in.getStringExtra("pass");


        //user = (TextView) findViewById(R.id.username);
        //user.setText(username);


        new SendPostRequest().execute();
        //user.setText(uname);

    }
        public class SendPostRequest extends AsyncTask<String, Void, String> {

            protected void onPreExecute(){}

            protected String doInBackground(String... arg0) {

                try {

                    URL url = new URL("http://10.0.2.2:80/grms/android/login_action_android.php"); // here is your URL path

                    JSONObject postDataParams = new JSONObject();
                    postDataParams.put("uname",username);
                    postDataParams.put("pass",pass);
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

                        //JSONArray arr = new JSONArray(sb.toString());
                        JSONObject jObj = new JSONObject(sb.toString());
                        //String arr = new String(jObj.getString("uname"));
                        String code = new String(jObj.getString("code"));

                        if(code.equals("success")) {
                            //login successfull, set username variable and redirect to Home page
                            String uname = jObj.getString("uname");
                            Variables.username = uname;
                            Intent homeActivity = new Intent(getApplicationContext(), MainActivity.class);
                            startActivity(homeActivity);
                        }

                        else if(code.equals("username and password mismatch")){

                            //cant make toast on a non UI activity, so commenting next line
                            //Toast.makeText(getApplicationContext(), "Login Failure, Username and Password mismatch", Toast.LENGTH_LONG);

                            //put message on this intent to show toast on LoginActivity Page
                            Intent loginActivity = new Intent(getApplicationContext(), LoginActivity.class);
                            loginActivity.putExtra("message","Login Failure, Username and Password mismatch" );
                            startActivity(loginActivity);
                        }

                        in.close();
                        //user.setText(uname);
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
               // Toast.makeText(getApplicationContext(), result,
                 //       Toast.LENGTH_LONG).show();
                //user.setText(loginMessage);

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



