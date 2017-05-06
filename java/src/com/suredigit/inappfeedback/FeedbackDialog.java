package com.suredigit.inappfeedback;

import java.io.IOException;
import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

import org.apache.http.HttpEntity;
import org.apache.http.HttpResponse;
import org.apache.http.NameValuePair;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.entity.UrlEncodedFormEntity;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.client.methods.HttpPost;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.message.BasicNameValuePair;
import org.apache.http.params.BasicHttpParams;
import org.apache.http.params.HttpConnectionParams;
import org.apache.http.params.HttpParams;
import org.apache.http.protocol.HTTP;
import org.apache.http.util.EntityUtils;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.Activity;
import android.app.AlertDialog;
import android.content.ActivityNotFoundException;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.PackageManager.NameNotFoundException;
import android.net.Uri;
import android.text.InputType;
import android.util.Log;
import android.view.Gravity;
import android.view.ViewGroup.LayoutParams;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.RadioButton;
import android.widget.RadioGroup;
import android.widget.Toast;

public class FeedbackDialog {
	public static enum LogTypes {
		DEBUG, NONE
	};

	public static LogTypes LOGT = LogTypes.NONE;

	private static final String APIVER = "2";
	private static final String LIBVER = "6";
	private static final String POSTURL = "http://www.android-feedback.com/service/" + APIVER;
	// private static final String POSTURL =
	// "http://192.168.1.10/ANDROID/service/" + APIVER;

	private static final String REPLIESURL = "http://www.android-feedback.com/service/" + APIVER + "/getPending/";
	// private static final String REPLIESURL =
	// "http://192.168.1.10/ANDROID/service/" + APIVER + "/getPending/";

	private static final String PREFS_NAME = "inappfeedback_prefs";
	private static final int MAX_PENDING_ITEMS = 20;
	private static final String TAG = "FeedbackDialog";
	private static int CONN_TIMEOUT = 5000;

	private String APPUID;

	private AlertDialog.Builder builder;
	private Context mContext;
	private Activity mActivity;

	private FeedbackSettings mSettings;

	private EditText eTcomments;

	private RadioGroup rGroup;
	private LinearLayout ll;

	private ArrayList<FeedBackItem> mFeedBackItems = new ArrayList<FeedBackItem>();

	private AlertDialog mDialog;
	private AlertDialog mResponseDialog;

	private String UUID;

	public FeedbackDialog(Context context, String appUID) {
		this.mActivity = (Activity) context;
		this.mContext = context;
		this.mSettings = new FeedbackSettings();
		this.APPUID = appUID;
		this.UUID = Installation.id(mContext);
		initialise();
		this.mDialog = createDialog();
		this.mDialog.setView(createLayout());
	}

	public FeedbackDialog(Activity activity, String appUID, FeedbackSettings settings) {
		this(activity, appUID);
		this.mSettings = settings;
		this.mDialog = createDialog();
		this.mDialog.setView(createLayout());
	}

	public void setSettings(FeedbackSettings settings) {
		this.mSettings = settings;
		this.mDialog = createDialog();
		this.mDialog.setView(createLayout());
	}

	public void setDebug(boolean flag) {
		if (flag)
			LOGT = LogTypes.DEBUG;
		else
			LOGT = LogTypes.NONE;
	}

	private void initialise() {
		loadUnsentItems(mActivity);
		if (mFeedBackItems.size() > 0) {
			if (LOGT == LogTypes.DEBUG)
				Log.d(TAG, "Found pending feedback items");
			sendFeedback(null, false);
		}
		getPendingResponses();
	}

	private AlertDialog createDialog() {
		builder = null;
		builder = new AlertDialog.Builder(mContext);
		builder.setCancelable(!(mSettings.isModal()));
		builder.setTitle(mSettings.getTitle());

		// TextView title = new TextView(mContext);
		// // You Can Customise your Title here
		// title.setText(mSettings.getTitle());
		// title.setBackgroundColor(Color.DKGRAY);
		// title.setPadding(10, 10, 10, 10);
		// title.setGravity(Gravity.CENTER);
		// title.setTextColor(Color.WHITE);
		// title.setTextSize(20);
		//
		// builder.setCustomTitle(title);
		//
		builder.setMessage(mSettings.getText());
		builder.setPositiveButton(mSettings.getSendButtonText(), new DialogInterface.OnClickListener() {
			@Override
			public void onClick(DialogInterface dialog, int id) {
				if (!(eTcomments.getText().toString().trim().equalsIgnoreCase(""))) {
					sendFeedback(createFeedBackItem(), true);
					Toast toast = Toast.makeText(mContext, mSettings.getToast(), Toast.LENGTH_SHORT);
					toast.show();
				}
			}
		});
		builder.setNegativeButton(mSettings.getCancelButtonText(), new DialogInterface.OnClickListener() {
			@Override
			public void onClick(DialogInterface dialog, int id) {

			}
		});
		return builder.create();
	}

	private LinearLayout createLayout() {

		ll = new LinearLayout(mContext);
		ll.setPadding(10, 10, 10, 10);
		ll.setOrientation(LinearLayout.VERTICAL);
		ll.setLayoutParams(new LayoutParams(LayoutParams.WRAP_CONTENT, LayoutParams.WRAP_CONTENT));

		eTcomments = new EditText(mContext);
		// eTcomments.setLayoutParams(new LayoutParams(
		// LayoutParams.WRAP_CONTENT, LayoutParams.FILL_PARENT));
		// eTcomments.setGravity(Gravity.CENTER_VERTICAL | Gravity.TOP);

		eTcomments.setHint(mSettings.getYourComments());
		eTcomments.setInputType(InputType.TYPE_TEXT_FLAG_CAP_SENTENCES | InputType.TYPE_TEXT_FLAG_MULTI_LINE | InputType.TYPE_CLASS_TEXT);
		eTcomments.setLayoutParams(new LayoutParams(LayoutParams.MATCH_PARENT, LayoutParams.WRAP_CONTENT));
		eTcomments.setMinLines(1);
		eTcomments.setMaxLines(5);

		rGroup = new RadioGroup(mContext);
		rGroup.setOrientation(mSettings.getOrientation());
		LinearLayout.LayoutParams params = new LinearLayout.LayoutParams(LayoutParams.FILL_PARENT, LayoutParams.FILL_PARENT);
		params.setMargins(0, 20, 10, 20); // substitute parameters for left,
		rGroup.setLayoutParams(params);

		RadioButton rBbug = new RadioButton(mContext);
		rBbug.setText(mSettings.getBugLabel());
		rBbug.setLayoutParams(new LayoutParams(LayoutParams.WRAP_CONTENT, LayoutParams.WRAP_CONTENT));
		rGroup.addView(rBbug);

		RadioButton rBidea = new RadioButton(mContext);
		rBidea.setText(mSettings.getIdeaLabel());
		rBidea.setLayoutParams(new LayoutParams(LayoutParams.WRAP_CONTENT, LayoutParams.WRAP_CONTENT));
		rGroup.addView(rBidea);

		RadioButton rBquestion = new RadioButton(mContext);
		rBquestion.setText(mSettings.getQuestionLabel());
		rBquestion.setLayoutParams(new LayoutParams(LayoutParams.WRAP_CONTENT, LayoutParams.WRAP_CONTENT));
		rGroup.addView(rBquestion);

		rGroup.setGravity(mSettings.getGravity());

		rBquestion.setChecked(true);

		ll.addView(eTcomments);
		if (mSettings.isEnableRadio())
			ll.addView(rGroup);

		return ll;
	}

	private FeedBackItem createFeedBackItem() {
		String comment = eTcomments.getText().toString();

		String type = "";
		int count = rGroup.getChildCount();
		for (int i = 0; i < count; i++) {
			RadioButton theButton = (RadioButton) rGroup.getChildAt(i);
			if (theButton.isChecked()) {
				type = theButton.getText().toString();
				break;
			}
		}

		if (!(mSettings.isEnableRadio())) {
			type = "Feedback:";
		}

		String ts = Long.toString(System.currentTimeMillis() / 1000L);
		String model = android.os.Build.MODEL;
		String manufacturer = android.os.Build.MANUFACTURER;
		String sdk = String.valueOf(android.os.Build.VERSION.SDK_INT);
		String uuid = this.UUID;
		String versionName = "";
		String versionCode = "";
		String customMessage = mSettings.getDeveloperMessage();
		
		try {
			versionName = mContext.getPackageManager().getPackageInfo(mContext.getPackageName(), 0).versionName;
			versionCode = String.valueOf(mContext.getPackageManager().getPackageInfo(mContext.getPackageName(), 0).versionCode);
		} catch (NameNotFoundException e) {
			e.printStackTrace();
		}

		FeedBackItem fItem = new FeedBackItem(comment, type, ts, model, manufacturer, sdk, mContext.getPackageName(), uuid, LIBVER, versionName,
				versionCode, customMessage);

		return fItem;
	}

	protected void sendFeedback(final FeedBackItem fi, final boolean toast) {
		Thread thread = new Thread() {
			@Override
			public void run() {
				try {
					HttpPost httppost = new HttpPost(POSTURL);

					HttpParams httpParameters = new BasicHttpParams();
					int timeoutConnection = CONN_TIMEOUT;
					HttpConnectionParams.setConnectionTimeout(httpParameters, timeoutConnection);
					int timeoutSocket = CONN_TIMEOUT;
					HttpConnectionParams.setSoTimeout(httpParameters, timeoutSocket);

					HttpClient httpclient = new DefaultHttpClient(httpParameters);

					boolean success = false;

					JSONObject submitJson = new JSONObject();
					JSONArray list = new JSONArray();
					try {
						if (fi != null)
							list.put(fi.toJson());

						if (mFeedBackItems.size() > 0)
							Collections.reverse(mFeedBackItems);
						for (FeedBackItem myFi : mFeedBackItems) {
							list.put(myFi.toJson());
						}
						submitJson.put("APPUID", APPUID);
						submitJson.put("feedback", list);
					} catch (JSONException e1) {
						e1.printStackTrace();
					}

					try {

						if (LOGT == LogTypes.DEBUG)
							Log.d(TAG, submitJson.toString());

						List<NameValuePair> nameValuePairs = new ArrayList<NameValuePair>(2);
						nameValuePairs.add(new BasicNameValuePair("json", submitJson.toString()));
						httppost.setEntity(new UrlEncodedFormEntity(nameValuePairs, "UTF-8"));

						HttpResponse response = httpclient.execute(httppost);

						HttpEntity entity = response.getEntity();
						String result = EntityUtils.toString(entity);

						if (LOGT == LogTypes.DEBUG)
							Log.d(TAG, result);

						int code = response.getStatusLine().getStatusCode();
						if (code == 200)
							success = true;
					} catch (ClientProtocolException e) {
						e.printStackTrace();
						success = false;
					} catch (IOException e) {
						e.printStackTrace();
						success = false;
					} finally {
						if (!(success)) {
							if (fi != null) {
								mFeedBackItems.add(fi);
								saveUnsentItems();
							}
						}

						else {
							mFeedBackItems.clear();
							saveUnsentItems();
						}

					}
				} finally {

				}
			}

		};
		thread.start();
	}

	private void openGooglePlay() {
		String packageName = mActivity.getPackageName();
		System.out.println(packageName);
		Uri uri = Uri.parse("market://details?id=" + packageName);
		Intent goToMarket = new Intent(Intent.ACTION_VIEW, uri);
		try {
			mActivity.startActivity(goToMarket);
		} catch (ActivityNotFoundException e) {
			e.printStackTrace();
			Toast.makeText(mActivity, "Couldn't launch the market", Toast.LENGTH_LONG).show();
		}
	}

	protected void getPendingResponses() {
		Thread thread = new Thread() {
			@Override
			public void run() {
				try {
					HttpGet httpget = new HttpGet(REPLIESURL + UUID);
					if (LOGT == LogTypes.DEBUG)
						Log.d(TAG, httpget.getURI().toString());

					HttpParams httpParameters = new BasicHttpParams();
					int timeoutConnection = CONN_TIMEOUT;
					HttpConnectionParams.setConnectionTimeout(httpParameters, timeoutConnection);
					int timeoutSocket = CONN_TIMEOUT;
					HttpConnectionParams.setSoTimeout(httpParameters, timeoutSocket);

					HttpClient httpclient = new DefaultHttpClient(httpParameters);

					boolean success = false;

					String result = "";
					try {

						HttpResponse response = httpclient.execute(httpget);

						HttpEntity entity = response.getEntity();
						result = EntityUtils.toString(entity, HTTP.UTF_8);
						if (LOGT == LogTypes.DEBUG)
							Log.d(TAG, result);

						int code = response.getStatusLine().getStatusCode();
						if (code == 200)
							success = true;
					} catch (ClientProtocolException e) {
						e.printStackTrace();
						success = false;
					} catch (IOException e) {
						e.printStackTrace();
						success = false;
					} finally {
						if (!(success)) {

						}

						else {
							if (!(result.equalsIgnoreCase(""))) {

								String resultInterim = result.toString();

								final boolean rate;
								rate = resultInterim.contains("[RATE]");
								if (rate)
									resultInterim = resultInterim.replace("[RATE]", "");

								final String resultFinal = resultInterim;

								mActivity.runOnUiThread(new Runnable() {
									public void run() {
										AlertDialog.Builder builder = new AlertDialog.Builder(mActivity);
										builder.setTitle(mSettings.getReplyTitle()).setMessage(resultFinal).setCancelable(false)
												.setNegativeButton(mSettings.getReplyCloseButtonText(), new DialogInterface.OnClickListener() {
													public void onClick(DialogInterface dialog, int id) {
														dialog.cancel();
													}
												});
										if (rate) {
											builder.setPositiveButton(mSettings.getReplyRateButtonText(), new DialogInterface.OnClickListener() {
												public void onClick(DialogInterface dialog, int id) {
													dialog.cancel();
													openGooglePlay();
												}
											});
										}
										mResponseDialog = builder.create();
										mResponseDialog.show();
									}
								});

							}
						}

					}
				} finally {

				}
			}
		};
		thread.start();
	}

	private boolean saveUnsentItems() {

		SharedPreferences preferences = mActivity.getSharedPreferences(PREFS_NAME, 0);
		SharedPreferences.Editor editor = preferences.edit();
		editor.putInt("com.suredigit.feedbackdialog.pending_size", mFeedBackItems.size());

		// Clean up possible old pending items
		for (int i = 0; i < MAX_PENDING_ITEMS; i++) {
			editor.remove("com.suredigit.feedbackdialog.pending_item_" + i);
		}

		//

		if (mFeedBackItems.size() > 0) {
			for (int i = 0; i < mFeedBackItems.size(); i++) {
				editor.putString("com.suredigit.feedbackdialog.pending_item_" + i, mFeedBackItems.get(i).toString());
			}
		}

		return editor.commit();
	}

	private void loadUnsentItems(Activity hostActivity) {
		SharedPreferences preferences = hostActivity.getSharedPreferences(PREFS_NAME, 0);
		mFeedBackItems.clear();
		int size = preferences.getInt("com.suredigit.feedbackdialog.pending_size", 0);

		for (int i = 0; i < size; i++) {
			String jsonTxt = preferences.getString("com.suredigit.feedbackdialog.pending_item_" + i, null);
			if (jsonTxt != null) {
				JSONObject json = null;
				try {
					json = new JSONObject(jsonTxt);
				} catch (JSONException e1) {
					e1.printStackTrace();
				}
				try {
					if (json != null)
						mFeedBackItems.add(new FeedBackItem(json.get("comment").toString(), json.get("type").toString(), json.get("ts").toString(),
								json.get("model").toString(), json.get("manufacturer").toString(), json.get("sdk").toString(), json.get("pname")
										.toString(), json.get("UUID").toString(), json.get("libver").toString(), json.get("versionname").toString(),
								json.get("versioncode").toString(), json.get("custommessage").toString()));
				} catch (JSONException e) {
					e.printStackTrace();
				}
			}
		}
	}

	public void show() {
		if (eTcomments != null) {
			eTcomments.setText("");
		}
		mDialog.show();
	}

	public void dismiss() {
		if (mDialog != null)
			mDialog.dismiss();

		if (mResponseDialog != null)
			mResponseDialog.dismiss();

	}

}
