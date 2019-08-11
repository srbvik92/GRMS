package com.example.grms;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;

public class SearchResultAdapter extends BaseAdapter {

    String[] logo, title, producer, developer, avgRating;
    int gid[];
    LayoutInflater mInflater;

    //context
    Context c1;

    //constructor
    public SearchResultAdapter(Context c, String[] l, String[] t, String[] p, String[] d, String[] a, int[] g){
        logo = l;
        title=t;
        producer=p;
        developer=d;
        avgRating=a;
        gid=g;

        this.c1=c;
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
        convertView = mInflater.inflate(R.layout.search_result_adapter, null);

        TextView titleTextView = (TextView) convertView.findViewById(R.id.title);
        TextView developerTextView = (TextView) convertView.findViewById(R.id.developer);
        TextView producerTextView = (TextView) convertView.findViewById(R.id.producer);
        TextView avgRatingTextView = (TextView) convertView.findViewById(R.id.avgRating);
        ImageView logoImageView = (ImageView) convertView.findViewById(R.id.logo);

        String title1 = title[position];
        String logo1 = logo[position];
        String producer1 = producer[position];
        String developer1 =developer[position];

        titleTextView.setText(title[position]);
        developerTextView.append(developer[position]);
        producerTextView.append(producer[position]);
        avgRatingTextView.setText(avgRating[position]);

        Picasso.with(c1)
                .load(logo[position])
                .fit()
                .into(logoImageView);


        return convertView;
    }
}
