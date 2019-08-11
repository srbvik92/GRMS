package com.example.grms;

import android.net.Uri;
import android.os.AsyncTask;
import android.support.constraint.ConstraintLayout;
import android.support.constraint.ConstraintSet;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.MenuItem;
import android.widget.TextView;
import android.widget.Toast;

import com.squareup.picasso.Picasso;

import org.json.JSONArray;
import org.json.JSONObject;
import org.w3c.dom.Text;

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

public class StatsActivity extends AppCompatActivity implements BottomNavigationFragment.OnFragmentInteractionListener {

    String line;

    BottomNavigationFragment bnf;
    MenuItem statsMenuItem;

    TextView mostOccGenre, favGenre, avgComp, avgRating, totalGamePlayed, topRatedCount;
    String mog, fg, ac, ar, tgp, trc;

    //for dynamically adding highest rated games in layout
    String gamekey[], gametitle[];

    //total highest rated count
    int trc1;

    ConstraintLayout view;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_stats);

        //set Stats in bottom navigation as checked
        bnf = (BottomNavigationFragment) getSupportFragmentManager().findFragmentById(R.id.statsFragment);


        view = findViewById(R.id.stats_layout);

        mostOccGenre = (TextView) view.findViewById(R.id.mostOccGenre);
        favGenre = (TextView) view.findViewById(R.id.favGenre);
        avgComp = (TextView) view.findViewById(R.id.avgComp);
        avgRating = (TextView) view.findViewById(R.id.avgRating);
        totalGamePlayed = (TextView) view.findViewById(R.id.totalgameplayed);
        topRatedCount = (TextView) view.findViewById(R.id.topratedcount);

        new GetStats().execute();

    }

    //for bottom navigation view fragment
    @Override
    public void onFragmentInteraction(Uri uri) {

    }


    //get game details from the server
    public class GetStats extends AsyncTask<String, Void, String> {


        protected void onPreExecute() {
        }

        protected String doInBackground(String... arg0) {

            try {

                URL url = new URL(Variables.server + "android/statistics_android.php"); // here is your URL path

                JSONObject postDataParams = new JSONObject();
                postDataParams.put("uname", Variables.username);
                //postDataParams.put("pass",pass);
                Log.e("params", postDataParams.toString());

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

                    JSONObject jObj = arr.getJSONObject(0);

                    //JSONObject jObj = new JSONObject(arr.toString());;
                    //JSONObject jObj = new JSONObject(arr.getJSONObject());itle");
                    //Log.e("mytag", jObj.toString());
                    //JSONObject jObj = new JSONObject(arr.toString());

                    tgp = jObj.getString("game count");
                    //totalGamePlayed.setText(jObj.getString("game count"));

                    jObj = arr.getJSONObject(1);
                    trc1 = Integer.parseInt(jObj.getString("top rated count"));
                    trc = jObj.getString("top rated count");
                    int topRatedCount1 = Integer.parseInt(jObj.getString("top rated count"));
                    //topRatedCount.setText(jObj.getString("top rated count"));


                    //Log.e("stats", jObj.getString("4"));
                    jObj = arr.getJSONObject(topRatedCount1 + 2);
                    mog = jObj.getString("most occuring genre");
                    fg = jObj.getString("fav genre");
                    ac = jObj.getString("avg comp");
                    ar = jObj.getString("total avg rating");
                    //mostOccGenre.setText(jObj.getString("most occuring genre"));
                    //favGenre.setText(jObj.getString("fav genre"));
                    //avgComp.setText(jObj.getString("avg comp"));
                    //avgRating.setText(jObj.getString("total avg rating"));

                    ConstraintSet cs;
                    int topMargin = 1262;
                    gamekey = new String[trc1];
                    gametitle = new String[trc1];

                    int j = 0;
                    for (int i = 2; i <= 4; i++) {
                        jObj = arr.getJSONObject(i);


                        //TextView tv = new TextView(getApplicationContext());
                        //tv.setId(view.generateViewId());
                        //tv.setTextSize(18);
                        //tv.setMaxWidth(600);
                        gamekey[j] = jObj.keys().next();
                        Log.e("key", gamekey[j]);
                        gametitle[j] = jObj.getString(gamekey[j]);

                        /*view.addView(tv, 0);

                        cs = new ConstraintSet();
                        cs.clone(view);
                        cs.connect(tv.getId(), ConstraintSet.LEFT, view.getId(), ConstraintSet.LEFT, 920);
                        cs.connect(tv.getId(), ConstraintSet.TOP, view.getId(), ConstraintSet.TOP, topMargin);

                        cs.applyTo(view);  */

                        topMargin = topMargin + 80;
                        j++;


                    }


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
            Toast.makeText(getApplicationContext(), result,
                    Toast.LENGTH_LONG).show();
            //user.setText(loginMessage);

            //set valued in layout
            totalGamePlayed.setText(tgp);
            topRatedCount.setText(trc);
            mostOccGenre.setText(mog);
            favGenre.setText(fg);
            avgComp.setText(ac);
            avgRating.setText(ar);

            //put dynamically all the highest rated games
            ConstraintSet cs;
            int topMargin = 1262;
            int j = 0;
            for (int i = 2; i <= trc1 + 1; i++) {

                TextView tv = new TextView(getApplicationContext());
                tv.setId(view.generateViewId());
                tv.setTextSize(18);
                tv.setMaxWidth(600);
                //String k = jObj.keys().next();
                Log.e("key", gamekey[j]);
                tv.setText(gametitle[j]);

                view.addView(tv, 0);

                cs = new ConstraintSet();
                cs.clone(view);
                cs.connect(tv.getId(), ConstraintSet.LEFT, view.getId(), ConstraintSet.LEFT, 920);
                cs.connect(tv.getId(), ConstraintSet.TOP, view.getId(), ConstraintSet.TOP, topMargin);

                cs.applyTo(view);

                topMargin = topMargin + 80;
                j++;

            }

        }


        public String getPostDataString(JSONObject params) throws Exception {

            StringBuilder result = new StringBuilder();
            boolean first = true;

            Iterator<String> itr = params.keys();

            while (itr.hasNext()) {

                String key = itr.next();
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
}