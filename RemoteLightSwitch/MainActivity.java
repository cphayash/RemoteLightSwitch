package com.example.mylightswitch;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.lang.reflect.Array;
import java.net.URL;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;
import org.json.JSONTokener;

import android.support.v7.app.ActionBarActivity;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

public class MainActivity extends ActionBarActivity {
	TextView tvData;
	Button btnDownload;

	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_main);
		tvData = (TextView) findViewById(R.id.textView1);
		btnDownload = (Button) findViewById(R.id.onBtn);
		btnDownload.setOnClickListener(new View.OnClickListener() {
			public void onClick(View v) {
				new downloader().execute();
			}
		});
	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.main, menu);
		return true;
	}

	@Override
	public boolean onOptionsItemSelected(MenuItem item) {
		// Handle action bar item clicks here. The action bar will
		// automatically handle clicks on the Home/Up button, so long
		// as you specify a parent activity in AndroidManifest.xml.
		int id = item.getItemId();
		if (id == R.id.action_settings) {
			return true;
		}
		return super.onOptionsItemSelected(item);
	}

	class downloader extends AsyncTask<Void, Void, String> {
		protected String doInBackground(Void... params) {
			String result = "";
			try {
				result = downloadData();
//				downloadData();
			} catch (IOException e) {
				e.printStackTrace();
			}
			return result;
		}

		private String downloadData() throws IOException {
			Log.i("AA", "in downloadData()");
			// Toast hi = new Toast().makeText(Context new Context(), "HI!", 1);
//			URL url = new URL(
//					"http://api.geonames.org/weatherJSON?north=44.1&south=-9.9&east=-22.4&west=55.2&username=demo");
			URL url = new URL("http://107.202.146.106/scripts/lightOff.php");
			Log.i("BB", "Just created URL.  About to create BufferedReader");
			BufferedReader reader = new BufferedReader(new InputStreamReader(
					url.openStream()));
			Log.i("BB", "just created BufferedReader");
			String rdata = "";
			String line = "";
			while ((line = reader.readLine()) != null) {
				rdata += line + "\n";
			}
			reader.close();
			return rdata;

			/*
			 * URL url = new URL("http://www.google.com"); BufferedReader reader
			 * = new BufferedReader(new InputStreamReader( url.openStream()));
			 * String line = ""; while ((line = reader.readLine()) != null) {
			 * Log.d("DEBUG", line); }
			 */
		}

		protected void onPostExecute(String result) {
			super.onPostExecute(result);
			String msg = "";
			try {
				JSONObject obj = (JSONObject) new JSONTokener(result).nextValue();
//				JSONArray wholeList = new JSONArray(obj.getJSONArray("weatherObservations"));
//				Log.i("HA",wholeList.toString());
//				tvData.setText(wholeList.toString());
				
				JSONObject status = new JSONObject().put("message",obj.getJSONObject("status"));
				msg = status.getJSONObject("message").get("message").toString();
				
//				
//				tvData.setText(obj.getClass().toString()+" \n");
//				JSONObject clouds = (JSONObject) obj.get("clouds");
//				tvData.append(clouds.getClass().toString()+"  ");
//				JSONObject temp = (JSONObject) obj.get("temperature");
//				tvData.append(temp.getClass().toString()+"  ");
//				JSONObject humidity = (JSONObject) obj.get("humidity");
//				tvData.append(temp.getClass().toString()+"\n");
			} catch (JSONException e) {
				e.printStackTrace();
			}
//			 tvData.setText(result);
			 tvData.setText(msg);
		}
	}
}
