package com.example.grms;

import android.net.Uri;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;

public class MyAccountActivity extends AppCompatActivity implements BottomNavigationFragment.OnFragmentInteractionListener {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_account);


    }

    //for Bottom navigation Fragment
    @Override
    public void onFragmentInteraction(Uri uri) {

    }
}
