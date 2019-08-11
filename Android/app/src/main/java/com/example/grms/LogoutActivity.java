package com.example.grms;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;

public class LogoutActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        //remove the saved username
        Variables.username = "";

        //redirect to login page
        Intent in = new Intent(LogoutActivity.this, MainActivity.class);
        startActivity(in);
    }
}
