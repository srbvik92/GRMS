package com.example.grms;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextUtils;
import android.text.TextWatcher;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;

import java.util.Calendar;

public class RegisterActivity extends AppCompatActivity {

    EditText unameEditText, emailEditText, passEditText, nameEditText,dobEditText, dispnameEditText;
    Spinner countrySpinner;
    String uname, email, pass, name, dob, dispname, country;
    Button submit;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);

        unameEditText  = (EditText)findViewById(R.id.username);
        emailEditText  = (EditText)findViewById(R.id.email);
        passEditText  = (EditText)findViewById(R.id.pass);
        nameEditText  = (EditText)findViewById(R.id.name);
        dobEditText  = (EditText)findViewById(R.id.dob);
        countrySpinner  = (Spinner)findViewById(R.id.country);
        dispnameEditText  = (EditText)findViewById(R.id.dispname);




        // check all fields are filled properly
        if(TextUtils.isEmpty(uname)){
            unameEditText.setError("Username is required");
        }

        //use submit button
        submit = findViewById(R.id.submit);

        submit.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

                uname = unameEditText.getText().toString();
                email = emailEditText.getText().toString();
                pass = passEditText.getText().toString();
                name = nameEditText.getText().toString();
                dob = dobEditText.getText().toString();
                dispname = dispnameEditText.getText().toString();
                country = countrySpinner.getSelectedItem().toString();

                Intent registerAction = new Intent(getApplicationContext(), RegisterAction.class);
                registerAction.putExtra("uname", uname);
                registerAction.putExtra("pass", pass);
                registerAction.putExtra("email", email);
                registerAction.putExtra("name", name);
                registerAction.putExtra("dob", dob);
                registerAction.putExtra("dispname", dispname);
                registerAction.putExtra("country", country);

                startActivity(registerAction);

            }
        });

        //set date in layout
        TextWatcher tw = new TextWatcher() {
            private String current = "";
            private String ddmmyyyy = "DDMMYYYY";
            private Calendar cal = Calendar.getInstance();

            @Override
            public void onTextChanged(CharSequence s, int start, int before, int count) {
                if (!s.toString().equals(current)) {
                    String clean = s.toString().replaceAll("[^\\d.]|\\.", "");
                    String cleanC = current.replaceAll("[^\\d.]|\\.", "");

                    int cl = clean.length();
                    int sel = cl;
                    for (int i = 2; i <= cl && i < 6; i += 2) {
                        sel++;
                    }
                    //Fix for pressing delete next to a forward slash
                    if (clean.equals(cleanC)) sel--;

                    if (clean.length() < 8){
                        clean = clean + ddmmyyyy.substring(clean.length());
                    }else{
                        //This part makes sure that when we finish entering numbers
                        //the date is correct, fixing it otherwise
                        int day  = Integer.parseInt(clean.substring(0,2));
                        int mon  = Integer.parseInt(clean.substring(2,4));
                        int year = Integer.parseInt(clean.substring(4,8));

                        mon = mon < 1 ? 1 : mon > 12 ? 12 : mon;
                        cal.set(Calendar.MONTH, mon-1);
                        year = (year<1900)?1900:(year>2100)?2100:year;
                        cal.set(Calendar.YEAR, year);
                        // ^ first set year for the line below to work correctly
                        //with leap years - otherwise, date e.g. 29/02/2012
                        //would be automatically corrected to 28/02/2012

                        day = (day > cal.getActualMaximum(Calendar.DATE))? cal.getActualMaximum(Calendar.DATE):day;
                        clean = String.format("%02d%02d%02d",day, mon, year);
                    }

                    clean = String.format("%s/%s/%s", clean.substring(0, 2),
                            clean.substring(2, 4),
                            clean.substring(4, 8));

                    sel = sel < 0 ? 0 : sel;
                    current = clean;
                    dobEditText.setText(current);
                    dobEditText.setSelection(sel < current.length() ? sel : current.length());
                }
            }
            @Override
            public void beforeTextChanged(CharSequence s, int start, int count, int after) {}

            @Override
            public void afterTextChanged(Editable s) {}
        };

        //add text watcher for date
        dobEditText.addTextChangedListener(tw);
    }
}
