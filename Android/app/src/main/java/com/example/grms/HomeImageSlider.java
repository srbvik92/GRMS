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
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.daimajia.slider.library.Animations.DescriptionAnimation;
import com.daimajia.slider.library.SliderLayout;
import com.daimajia.slider.library.SliderTypes.BaseSliderView;
import com.daimajia.slider.library.SliderTypes.TextSliderView;
import com.daimajia.slider.library.Tricks.ViewPagerEx;

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


/**
 * A simple {@link Fragment} subclass.
 * Activities that contain this fragment must implement the
 * {@link HomeImageSlider.OnFragmentInteractionListener} interface
 * to handle interaction events.
 * Use the {@link HomeImageSlider#newInstance} factory method to
 * create an instance of this fragment.
 */
public class HomeImageSlider extends Fragment implements BaseSliderView.OnSliderClickListener, ViewPagerEx.OnPageChangeListener {
    // TODO: Rename parameter arguments, choose names that match
    // the fragment initialization parameters, e.g. ARG_ITEM_NUMBER
    private static final String ARG_PARAM1 = "param1";
    private static final String ARG_PARAM2 = "param2";

    // TODO: Rename and change types of parameters
    private String mParam1;
    private String mParam2;

    private OnFragmentInteractionListener mListener;

    SliderLayout sliderLayout;
    HashMap<String,String> Hash_file_maps ;

    public String line ="";
    TextView user;
    int nid[] = new int[5];
    String[] title = new String[5] ;
    String[] image = new String[5];
    String title1, image1;
    View HomeImageSliderView;

    public HomeImageSlider() {
        // Required empty public constructor
    }

    /**
     * Use this factory method to create a new instance of
     * this fragment using the provided parameters.
     *
     * @param param1 Parameter 1.
     * @param param2 Parameter 2.
     * @return A new instance of fragment HomeImageSlider.
     */
    // TODO: Rename and change types and number of parameters
    public static HomeImageSlider newInstance(String param1, String param2) {
        HomeImageSlider fragment = new HomeImageSlider();
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
        // Inflate the layout for this fragment
        HomeImageSliderView =  inflater.inflate(R.layout.fragment_home_image_slider, container, false);
        sliderLayout = (SliderLayout) HomeImageSliderView.findViewById(R.id.slider);
        new GetSliderImage().execute();
        return HomeImageSliderView;
    }

    // TODO: Rename method, update argument and hook method into UI event
    public void onButtonPressed(Uri uri) {
        if (mListener != null) {
            mListener.onFragmentInteraction(uri);
        }
    }


    @Override
    public void onDetach() {
        super.onDetach();
        mListener = null;
    }

    @Override
    public void onSliderClick(BaseSliderView slider) {

        //get nid of clicked slider
        String s = slider.getDescription();
        int n = 0;

        if(s.equals(title[0])){
            n = nid[0];
        }
        else if (s.equals(title[1])){
            n = nid[1];
        }
        else if (s.equals(title[2])){
            n = nid[2];
        }
        else if (s.equals(title[3])){
            n = nid[3];
        }
        else if (s.equals(title[4])){
            n = nid[4];
        }

        Toast.makeText(getActivity().getApplicationContext(),s,
                Toast.LENGTH_LONG).show();

        Intent storyDetails = new Intent(getContext(), StoryDetails.class );
        storyDetails.putExtra("id", n);
        startActivity(storyDetails);

    }

    @Override
    public void onPageScrolled(int position, float positionOffset, int positionOffsetPixels) {

    }

    @Override
    public void onPageSelected(int position) {

    }

    @Override
    public void onPageScrollStateChanged(int state) {

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


    //get images for image slider and set into slider
    public class GetSliderImage extends AsyncTask<String, Void, String> {

        ImageView bmImage;

        protected void onPreExecute(){}

        protected String doInBackground(String... arg0) {

            try {

                URL url = new URL(Variables.server+"android/image_slider_android.php"); // here is your URL path

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
                            Log.d("bubi", image[n]);
                        }
                    }
                    title1 = title[1];
                    image1 = image[1];

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
            Log.e("result", result);
            Hash_file_maps = new HashMap<String, String>();



            //Hash_file_maps.put("bubi ka grp", "http://10.0.2.2:80/grms/stories/top_image/5/Witcher_3_cover_art.jpg");
            Hash_file_maps.put(title[0], image[0]);
            Hash_file_maps.put(title[1], image[1]);
            Hash_file_maps.put(title[2], image[2]);
            Hash_file_maps.put(title[3], image[3]);
            Hash_file_maps.put(title[4], image[4]);

            //user.setText(title1);

            int i=0;

            for(String name : Hash_file_maps.keySet()){

                TextSliderView textSliderView = new TextSliderView(getActivity());
                textSliderView
                        .description(name)
                        .image(Hash_file_maps.get(name))
                        .setScaleType(BaseSliderView.ScaleType.Fit)
                        .setOnSliderClickListener(HomeImageSlider.this);
                textSliderView.bundle(new Bundle());
                textSliderView.getBundle()
                        .putString("extra",name);
                sliderLayout.addSlider(textSliderView);
            }


            sliderLayout.setPresetTransformer(SliderLayout.Transformer.Accordion);
            sliderLayout.setPresetIndicator(SliderLayout.PresetIndicators.Center_Bottom);
            sliderLayout.setCustomAnimation(new DescriptionAnimation());
            sliderLayout.setDuration(3000);
            sliderLayout.addOnPageChangeListener(HomeImageSlider.this);



        }
    }
}
