package com.example.grms;

import android.content.Context;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

public class LatestAdditionsAdapter extends BaseAdapter {

    LayoutInflater mInflater;
    String[] gname;
    String[] relDate;
    int[] gid;

    public LatestAdditionsAdapter(Context c, String[] i, String[] p, int[] d){
        gname = i;
        relDate = p;
        gid = d;
        mInflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }

    public LatestAdditionsAdapter(Context c){

        mInflater = (LayoutInflater) c.getSystemService(Context.LAYOUT_INFLATER_SERVICE);
    }


    @Override
    public int getCount() {
        //Log.d("getcount", gname.length+"");
        if(gname == null) {
            return 0;
        }
        else {
            return gname.length;
        }
    }

    @Override
    public Object getItem(int position) {
        return gname[position];
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {

        convertView = mInflater.inflate(R.layout.latest_additions_adapter, null);
        TextView gnameTextView = (TextView) convertView.findViewById(R.id.gname);
        TextView relDateTextView = (TextView) convertView.findViewById(R.id.relDate);

        String g_name = gname[position];
        String rel_date = relDate[position];
        int g_id = gid[position];

        gnameTextView.setText(g_name);
        relDateTextView.setText(rel_date);

        return convertView;
    }


}
