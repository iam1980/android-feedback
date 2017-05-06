package com.suredigit.inappfeedback;

import org.json.JSONException;
import org.json.JSONObject;

public class FeedBackItem {

	String comment = "";
	String type = "";
	String ts = "";

	String model = "";
	String manufacturer = "";
	String sdk = "";

	String packageName = "";

	String UUID = "";

	String LIBVER = "";
	String versionName = "";
	String versionCode = "";
	String customMessage = "";

	public FeedBackItem(String comment, String type, String ts, String model, String manufact, String sdk, String pname, String UUID, String LIBVER, String versionName, String versionCode, String customMesssage) {
		super();
		this.comment = comment;
		this.type = type;
		this.ts = ts;
		this.model = model;
		this.manufacturer = manufact;
		this.sdk = sdk;
		this.packageName = pname;
		this.UUID = UUID;
		
		this.LIBVER = LIBVER;
		this.versionName = versionName;
		this.versionCode = versionCode;
		this.customMessage = customMesssage;
		
		
	}

	@Override
	public String toString() {
		return toJson().toString();
	}

	public JSONObject toJson() {
		JSONObject json = new JSONObject();
		try {
			json.put("comment", this.comment);
			json.put("type", this.type);
			json.put("ts", this.ts);
			json.put("model", this.model);
			json.put("manufacturer", this.manufacturer);
			json.put("sdk", this.sdk);
			json.put("pname", this.packageName);
			json.put("UUID", this.UUID);
			json.put("libver", this.LIBVER);
			json.put("versionname", this.versionName);
			json.put("versioncode", this.versionCode);
			json.put("custommessage", this.customMessage);
		} catch (JSONException e) {
			e.printStackTrace();
		}
		return json;
	}
}
