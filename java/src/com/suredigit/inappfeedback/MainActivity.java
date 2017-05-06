package com.suredigit.inappfeedback;

import android.app.Activity;
import android.os.Bundle;
import android.view.Gravity;
import android.view.Menu;
import android.view.View;
import android.widget.Button;
import android.widget.LinearLayout;
import android.widget.Toast;

public class MainActivity extends Activity {

	private FeedbackDialog myDialog;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		super.onCreate(savedInstanceState);

		FeedbackSettings feedbackSettings = new FeedbackSettings();
		feedbackSettings.setCancelButtonText("CancelT");
		feedbackSettings.setSendButtonText("SendT");
		feedbackSettings.setText("Give me your feedback");
		feedbackSettings.setTitle("FeedTitle");
		feedbackSettings.setToast("OK THANKSSSS");
		feedbackSettings.setBugLabel("Buggg");
		feedbackSettings.setIdeaLabel("Ideaaaa");
		feedbackSettings.setQuestionLabel("Questttt");
		feedbackSettings.setYourComments("hey your coommmies");
		feedbackSettings.setOrientation(LinearLayout.VERTICAL);
		feedbackSettings.setGravity(Gravity.CENTER);
		feedbackSettings.setDeveloperMessage("This is a test!");
		feedbackSettings.setToastDuration(Toast.LENGTH_LONG);
		
		feedbackSettings.setModal(true);
		//feedbackSettings.setRadioButtons(false);
		feedbackSettings.setReplyTitle("My Mahn!");
		feedbackSettings.setReplyCloseButtonText("CLOSE THIS NOW!");
		
		myDialog = new FeedbackDialog(MainActivity.this, "YOU_AF_KEY_HERE");
		
		myDialog.setSettings(feedbackSettings);
		//myDialog.setDebug(true);
	
		
		setContentView(R.layout.activity_main);
		final Button button = (Button) findViewById(R.id.button1);
		button.setOnClickListener(new View.OnClickListener() {
			@Override
			public void onClick(View v) {
				myDialog.show();
			}
		});

	}

	@Override
	protected void onPause() {
		// TODO Auto-generated method stub
		super.onPause();
		System.out.println("ON PAUSE");
		myDialog.dismiss();

	}

	@Override
	public boolean onCreateOptionsMenu(Menu menu) {
		// Inflate the menu; this adds items to the action bar if it is present.
		getMenuInflater().inflate(R.menu.main, menu);
		return true;
	}

}
