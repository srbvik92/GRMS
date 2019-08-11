package com.example.grms;

import android.arch.lifecycle.Lifecycle;
import android.net.Uri;
import android.os.Bundle;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.constraint.Placeholder;
import android.support.design.widget.TabLayout;
import android.support.v4.app.Fragment;
import android.support.v4.view.ViewPager;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;

public class HomeActivityFragment extends Fragment implements HomeImageSlider.OnFragmentInteractionListener{

    View HomeView;



    @Nullable
    @Override
    public View onCreateView(@NonNull LayoutInflater inflater, @Nullable ViewGroup container, @Nullable Bundle savedInstanceState) {
        //return super.onCreateView(inflater, container, savedInstanceState);

        HomeView = inflater.inflate(R.layout.home_activity_fragment, container, false);

        //set top tabs for pc, ps4, xboxone



        //set tabs for top stories, news and featured after topimageslider
        ViewPager viewPager = (ViewPager) HomeView.findViewById(R.id.pager);
        viewPager.setAdapter(new StoriesAdapter(getFragmentManager()));
        TabLayout tabLayout = (TabLayout) HomeView.findViewById(R.id.tab_layout);
        tabLayout.setupWithViewPager(viewPager);



        return HomeView;
    }

    @Override
    public void onFragmentInteraction(Uri uri) {

    }
}
