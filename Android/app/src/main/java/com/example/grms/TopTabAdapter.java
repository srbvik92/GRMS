package com.example.grms;

import android.support.annotation.NonNull;
import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentManager;
import android.support.v4.app.FragmentPagerAdapter;

public class TopTabAdapter extends FragmentPagerAdapter {


    public TopTabAdapter(FragmentManager fm){
        super(fm);
    }

    @Override
    public Fragment getItem(int i) {
        switch (i){
            case 0:
                return new HomeActivityFragment();
            case 1:
                return new HomeActivityFragment();

            case 2:
                return new HomeActivityFragment();

            default:
                return new HomeActivityFragment();
        }
    }

    @Override
    public int getCount() {
        return 0;
    }

    @Override
    public int getItemPosition(@NonNull Object object) {
        return super.getItemPosition(object);
    }


}
