package com.example.grms;

import android.content.Intent;
import android.support.v4.view.MenuItemCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.widget.SearchView;

public class SearchActivity extends AppCompatActivity {

    SearchView sv;
    String searchtext;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search);

        //setting toolbar and its menus
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        //get intent
        Intent in = getIntent();
        searchtext = in.getStringExtra("searchtext");

        //set back arrow
        getSupportActionBar().setDisplayHomeAsUpEnabled(true);

        //set search query in the toolbar/actionbar
        getSupportActionBar().setTitle(searchtext);



    }
    @Override
    public boolean onSupportNavigateUp() {
        onBackPressed();
        return true;
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        //getMenuInflater().inflate(R.menu.menu_action_bar, menu);
        menu.clear();
        //load defualt menu if user not logged in
        if(Variables.username.equals("")){
            getMenuInflater().inflate(R.menu.menu_action_bar, menu);
        }
        else{
            getMenuInflater().inflate(R.menu.menu_action_bar_logged_in, menu);
        }

        MenuItem search = menu.findItem(R.id.action_search);
        sv = (SearchView) MenuItemCompat.getActionView(search);

        sv.setQuery(searchtext, false);

        SearchView.OnQueryTextListener queryTextListener = new SearchView.OnQueryTextListener() {
            @Override
            public boolean onQueryTextSubmit(String query)
            {
                Log.d("TAG","You queried for="+query); // Here it prints correct query input. but doesnot starting the new activity.
                Intent searchActivity = new Intent(getApplicationContext(), SearchActivity.class);
                searchActivity.putExtra("searchtext", query);
                startActivity(searchActivity);
                return true;
            }

            @Override
            public boolean onQueryTextChange(String newText) {
                return false;
            }
        };

        sv.setOnQueryTextListener(queryTextListener);

        return true;
    }

    //set action bar menus action
    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {

            //login page
            case R.id.action_login:
                Intent loginActivity = new Intent(this, LoginActivity.class);
                startActivity(loginActivity);
                return true;

            case R.id.action_register:
                // User chose the "Favorite" action, mark the current item
                // as a favorite...
                return true;

            case R.id.action_logout:
                Intent logoutActivity = new Intent(this, LogoutActivity.class);
                startActivity(logoutActivity);
                return true;

            // case R.id.action_search:
            //  Intent searchActivity = new Intent(this, SearchActivity.class);
            // SearchView sv = (SearchView) item.getActionView();

            default:
                // If we got here, the user's action was not recognized.
                // Invoke the superclass to handle it.
                return super.onOptionsItemSelected(item);

        }
    }
}
