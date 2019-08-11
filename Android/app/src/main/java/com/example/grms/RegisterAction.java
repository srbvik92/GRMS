package com.example.grms;

import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Handler;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.widget.TextView;

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
import java.util.Calendar;
import java.util.Iterator;

import javax.net.ssl.HttpsURLConnection;

public class RegisterAction extends AppCompatActivity {

    String uname, email, pass, name, dob, dispname, country;
    String line;

    TextView resultTextView;


    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register_action);

        Intent registerActivity = getIntent();

        uname = (String) registerActivity.getStringExtra("uname");
        email = registerActivity.getStringExtra("email");
        pass = registerActivity.getStringExtra("pass");
        name = registerActivity.getStringExtra("name");
        dob = registerActivity.getStringExtra("dob");
        dispname = registerActivity.getStringExtra("dispname");
        country = registerActivity.getStringExtra("country");

        new RegisterRequest().execute();


    }

    public class RegisterRequest extends AsyncTask<String, Void, String> {

        protected void onPreExecute(){}

        protected String doInBackground(String... arg0) {

            try {

                URL url = new URL(Variables.server+"android/register_action_android.php"); // here is your URL path

                JSONObject postDataParams = new JSONObject();
                postDataParams.put("uname",uname);
                postDataParams.put("email", email);
                postDataParams.put("pass",pass);
                postDataParams.put("name", name);
                postDataParams.put("dob", dob);
                postDataParams.put("country", country);
                postDataParams.put("dispname", dispname);

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
                    //String arr = new String(jObj.getString("uname"));
                    String code = new String(jObj.getString("code"));
                    Log.e("success", "bubi");

                    //get result from server
                    if(code.equals("registered successfully")) {
                        //login successfull, set username variable and redirect to Home page
                        //String uname = jObj.getString("uname");
                        //Variables.username = uname;

                        resultTextView = findViewById(R.id.result);
                        resultTextView.setText("Registered Successfully, Redirecting to home in  10 seconds");

                        // redirect to Main activity after slight delay
                        new Handler().postDelayed(new Runnable() {
                            @Override
                            public void run() {
                                Intent homeActivity = new Intent(getApplicationContext(), MainActivity.class);
                                startActivity(homeActivity);
                                finish();
                            }
                        }, 4000);


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
