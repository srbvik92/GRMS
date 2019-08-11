package com.example.grms;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

public class LoginActivity extends AppCompatActivity{

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        final EditText username =(EditText)findViewById(R.id.username);
        final EditText pass = (EditText)findViewById(R.id.pass);

        Button login = (Button) findViewById(R.id.login);

        //get Intent
        Intent loginActivity = getIntent();

        //check if Login Activity was launched again due to error in username and password, or mismatched username and password
        if(loginActivity.hasExtra("message")) {
            String message = loginActivity.getStringExtra("message");
            Toast.makeText(this, message, Toast.LENGTH_LONG).show();
        }

        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                Intent login_action = new Intent(getApplicationContext(),LoginAction.class);
                login_action.putExtra("username",username.getText().toString());
                login_action.putExtra("pass", pass.getText().toString());
                startActivity(login_action);
            }
        });

        Button register = (Button) findViewById(R.id.register);
        register.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent registerAction = new Intent(getApplicationContext(), RegisterActivity.class);
                startActivity(registerAction);
            }
        });
    }
}
