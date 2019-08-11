package com.example.grms;

import android.app.Activity;
import android.app.SearchManager;
import android.content.Context;
import android.content.Intent;
import android.net.Uri;
import android.support.annotation.NonNull;
import android.support.design.widget.TabLayout;
import android.support.v4.view.GravityCompat;
import android.support.v4.view.MenuItemCompat;
import android.support.v4.view.ViewPager;
import android.support.v4.widget.DrawerLayout;
import android.support.v7.app.ActionBarDrawerToggle;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.inputmethod.InputMethodManager;
import android.widget.Button;
import android.support.design.widget.NavigationView;
import android.widget.SearchView;
import android.widget.Toast;

import com.daimajia.slider.library.SliderTypes.BaseSliderView;
import com.daimajia.slider.library.SliderTypes.TextSliderView;

import java.sql.BatchUpdateException;

public class MainActivity extends AppCompatActivity implements NavigationView.OnNavigationItemSelectedListener, BottomNavigationFragment.OnFragmentInteractionListener {

    private DrawerLayout drawer;
    SearchView sv;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        /*
        Button login = (Button) findViewById(R.id.login_button);
        login.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent loginIntent = new Intent(getApplicationContext(),LoginActivity.class);
                startActivity(loginIntent);
            }
        });*/

        //setting toolbar and its menus
        Toolbar toolbar = findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        //set top tab for pc, ps4, sbox one using viev pager
        //ViewPager topTabViewPager =(ViewPager) findViewById(R.id.topTabViewPager);
        //topTabViewPager.setAdapter(new TopTabAdapter(getSupportFragmentManager()));
        //TabLayout topTab = (TabLayout) findViewById(R.id.topTabs);
        //topTab.setupWithViewPager(topTabViewPager);


        drawer = findViewById(R.id.drawer_layout);
        NavigationView navigationView = findViewById(R.id.nav_view);
        navigationView.setNavigationItemSelectedListener(this);

        ActionBarDrawerToggle toggle = new ActionBarDrawerToggle(this, drawer, toolbar,
                R.string.navigation_drawer_open, R.string.navigation_drawer_close);
        drawer.addDrawerListener(toggle);
        toggle.syncState();

        //load the default HomeActivityFragment
        getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container,
                new HomeActivityFragment()).commit();

        //keep first item in navigation menu selected
        navigationView.getMenu().getItem(0).setChecked(true);
    }


    //navigation menu Options
    @Override
    public boolean onNavigationItemSelected(@NonNull MenuItem item) {
        switch (item.getItemId()) {
            case R.id.nav_home:
                getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container,
                        new HomeActivityFragment()).commit();
                break;
            case R.id.nav_myaccount:
                getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container,
                        new MyAccountFragment()).commit();
            case R.id.nav_settings:
                //getSupportFragmentManager().beginTransaction().replace(R.id.fragment_container,
                        //new SettingFragment()).commit();
                break;
            case R.id.logout:
                //Intent logout = new Intent(Navigation.this, LogoutActivity.class);
                //startActivity(logout);
                break;
            case R.id.nav_send:
                Toast.makeText(this, "Send", Toast.LENGTH_SHORT).show();
                break;
        }
        drawer.closeDrawer(GravityCompat.START);
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

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        switch (item.getItemId()) {

            //login page
            case R.id.action_login:
                Intent loginActivity = new Intent(this, LoginActivity.class);
                startActivity(loginActivity);
                return true;

            case R.id.action_register:
                Intent registerActivity = new Intent(this, RegisterActivity.class);
                startActivity(registerActivity);
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


    //when navigaiton menu is opened or keyboard is open, dont exit app with back button
    @Override
    public void onBackPressed() {
        if (drawer.isDrawerOpen(GravityCompat.START)) {
            drawer.closeDrawer(GravityCompat.START);
        }
        else if (!sv.isIconified()) {
            sv.setIconified(true);
            hideSoftKeyboard(this);
        }
        else {
            Intent intent = new Intent(Intent.ACTION_MAIN);
            intent.addCategory(Intent.CATEGORY_HOME);
            intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK);
            startActivity(intent);
        }




    }

    //hide keyboard function
    public static void hideSoftKeyboard(Activity activity) {
        final InputMethodManager inputMethodManager = (InputMethodManager) activity.getSystemService(Activity.INPUT_METHOD_SERVICE);
        if (inputMethodManager.isActive()) {
            if (activity.getCurrentFocus() != null) {
                inputMethodManager.hideSoftInputFromWindow(activity.getCurrentFocus().getWindowToken(), 0);
            }
        }
    }


    //for bottom navigation fragment
    @Override
    public void onFragmentInteraction(Uri uri) {

    }

}
