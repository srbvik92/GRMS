package com.example.grms;

import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.ImageView;
import android.widget.ListView;
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

import javax.net.ssl.HttpsURLConnection;


/**
 * A simple {@link Fragment} subclass.
 * Activities that contain this fragment must implement the
 * {@link LatestAdditionsFragment.OnFragmentInteractionListener} interface
 * to handle interaction events.
 * Use the {@link LatestAdditionsFragment#newInstance} factory method to
 * create an instance of this fragment.
 */
public class LatestAdditionsFragment extends Fragment {
    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;

    private OnFragmentInteractionListener mListener;

    //layout variables
    ListView latestAdditions;
    String[] gname = new String[10];
    String[] relDate = new String[10];
    int[] gid = new int[10];
    View latestAdditionsView;
    LatestAdditionsAdapter latestAdditionsAdapter;
    LayoutInflater minflater;
    ViewGroup mcontainer;

    //Other Variables
    String line;



    public LatestAdditionsFragment() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment LatestAdditionsFragment.
     */
    // TODO: Rename and change types and number of parameters
    public static LatestAdditionsFragment newInstance(String param1, String param2) {
        LatestAdditionsFragment fragment = new LatestAdditionsFragment();
        Bundle args = new Bundle();
        args.putString(ARG_PARAM1, param1);
        args.putString(ARG_PARAM2, param2);
        fragment.setArguments(args);
        return fragment;
    }

    @Override
    public void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        if (getArguments() != null) {
            mParam1 = getArguments().getString(ARG_PARAM1);
            mParam2 = getArguments().getString(ARG_PARAM2);
        }
    }

    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {

        this.minflater = inflater;
        this.mcontainer = container;

        //String[] gname = {"bubi", "chubi"};
        //String [] relDate = {"27-10-2010", "28-10-2020"};
        //int[] gid = {1,2};

        // Inflate the layout for this fragment
        latestAdditionsView = inflater.inflate(R.layout.fragment_latest_additions, container, false);
        //return inflater.inflate(R.layout.fragment_latest_additions, container, false);

        latestAdditions = (ListView) latestAdditionsView.findViewById(R.id.latestAdditions);

        //ArrayAdapter<String> lva = new ArrayAdapter<String>(getActivity(), android.R.layout.simple_list_item_1, gname);

        //initiate custom adapter for listview
        LatestAdditionsAdapter lva = new LatestAdditionsAdapter(getActivity(), null, null, null);

        latestAdditions.setAdapter(lva);

        new GetLatestAdditions().execute();

        latestAdditions.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                Intent gameDetails = new Intent(getActivity().getApplicationContext(), GameDetails.class);
                gameDetails.putExtra("gid", gid[position]);
                startActivity(gameDetails);
                Toast.makeText(getActivity().getApplicationContext(), gname[position],
                Toast.LENGTH_LONG).show();
            }
        });

        return latestAdditionsView;
    }



    // TODO: Rename method, update argument and hook method into UI event
    public void onButtonPressed(Uri uri) {
        if (mListener != null) {
            mListener.onFragmentInteraction(uri);
        }
    }

    /*
    @Override
    public void onAttach(Context context) {
        super.onAttach(context);
        if (context instanceof OnFragmentInteractionListener) {
            mListener = (OnFragmentInteractionListener) context;
        } else {
            throw new RuntimeException(context.toString()
                    + " must implement OnFragmentInteractionListener");
        }
    } */

    @Override
    public void onDetach() {
        super.onDetach();
        mListener = null;
    }

    /**
     * This interface must be implemented by activities that contain this
     * fragment to allow an interaction in this fragment to be communicated
     * to the activity and potentially other fragments contained in that
     * activity.
     * <p>
     * See the Android Training lesson <a href=
     * "http://developer.android.com/training/basics/fragments/communicating.html"
     * >Communicating with Other Fragments</a> for more information.
     */
    public interface OnFragmentInteractionListener {
        // TODO: Update argument type and name
        void onFragmentInteraction(Uri uri);
    }


    //get game name, release date and id from database
    public class GetLatestAdditions extends AsyncTask<String, Void, String> {

        ImageView bmImage;

        protected void onPreExecute(){}

        protected String doInBackground(String... arg0) {

            try {

                URL url = new URL(Variables.server+"android/latest_additions_android.php"); // here is your URL path

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
                        Log.d("latest", n+"");
                        JSONObject obj = arr.getJSONObject(n);
                        if (obj != null) {
                            gid[n]= Integer.parseInt(obj.getString("gid"));
                            gname[n]=obj.getString("gname");
                            relDate[n]=obj.getString("reldate");
                            Log.d("latestadditions", gname[n]+"bubi"+gid[n]+n);
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
                return new String("Exceptionbubi: " + e.getMessage());
            }

        }

        @Override
        protected void onPostExecute(String result) {
            //Toast.makeText(getActivity().getApplicationContext(), result,
            //Toast.LENGTH_LONG).show();
            //user.setText(loginMessage);

            //add and notify the listview that data has been fetched and now load into listview
            LatestAdditionsAdapter latestAdditionsAdapter = new LatestAdditionsAdapter(getActivity(), gname, relDate, gid);

            latestAdditions.setAdapter(latestAdditionsAdapter);

            latestAdditionsAdapter.notifyDataSetChanged();

        }
    }
}
