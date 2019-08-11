package com.example.grms;

import android.support.v4.app.Fragment;
import android.support.v4.app.FragmentPagerAdapter;

public class StoriesAdapter extends FragmentPagerAdapter {

    String tabtitle[] = new String[3];

    public StoriesAdapter(android.support.v4.app.FragmentManager fm) {
        super(fm);
        tabtitle[0] = "Top Stories";
        tabtitle[1] = "News";
        tabtitle[2] = "Featured";

    }

    @Override
    public Fragment getItem(int position) {
        switch (position)
        {
            case 0:
                return new TopStoriesFragment(); //ChildFragment1 at position 0
            case 1:
                return new TopStoriesFragment();  //ChildFragment2 at position 1
            case 2:
                return new TopStoriesFragment();  //ChildFragment3 at position 2
        }
        return null; //does not happen
    }

    @Override
    public int getCount() {
        return 3; //three fragments
    }

    //set title of the tab
    @Override
    public CharSequence getPageTitle(int position) {
        String title = getItem(position).getClass().getName();
        //return title.subSequence(title.lastIndexOf(".") + 1, title.length());
        return tabtitle[position];
    }
}
