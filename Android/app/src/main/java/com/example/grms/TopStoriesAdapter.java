package com.example.grms;

import android.content.Context;
import android.text.Layout;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;

public class TopStoriesAdapter extends BaseAdapter {

    //layout variables
    int nid[];
    String[] title;
    String[] image;
    LayoutInflater mInflater;

    Context c1;

    public TopStoriesAdapter(Context c, String[] i, String[] p, int[] d){
        title = i;
        image = p;
        nid = d;
        this.c1 = c;
        mInflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }
    @Override
    public int getCount() {
        if(title == null) {
            return 0;
        }
        else {
            return title.length;
        }
    }

    @Override
    public Object getItem(int position) {
        return title[position];
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        convertView = mInflater.inflate(R.layout.top_stories_adapter, null);
        TextView titleTextView = (TextView) convertView.findViewById(R.id.title);
        ImageView StoryImageView = (ImageView) convertView.findViewById(R.id.storyImage);

        String title1 = title[position];
        String image1 = image[position];
        int n_id = nid[position];

        //set title of story
        titleTextView.setText(title1);

        //set image of story
        Picasso.with(c1)
                .load(image[position])
                .fit()
                .into(StoryImageView);


        return convertView;

    }
}
