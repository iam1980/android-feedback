<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head', array('title' => "Library")); ?>

</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
    <div class="row">
        <div class="span2">
			<?php
				if(isset($account))
				echo $this->load->view('account/account_menu', array('current' => 'account_library'));
			?>
        </div>
        <div class="span10">

            <h2><?php echo "Android Feedback Library" ?></h2>

            <div class="well"><h4>Download Latest: <a href="<?=base_url()?>assets/jars/feedback_v6.jar">feedback-v6.jar <i class="icon-download-alt"></i></a></h4></div>



            <h3>Changelong:</h3>

            <p><strong>2014/05/21:</strong> v6
            <ul>
				<li>
					<strong>There are several applications that do not reference the use of the library. Within the next couple of weeks we will be blocking access to those accounts.</strong>
				</li>

                <li>
                    Added the option to pass a String to every feedback item. This is limited to 1000 characters.
                </li>

				<li>
					Added Version name and code to the feedback email notifications
				</li>

				<li>
					Added the Feedback library version to the notifications
				</li>

            </ul>
            </p>

            <p><strong>2014/01/31:</strong> v5
            <ul>
                <li>
                    Added the ability for the users to Rate your application. If you have successfully helped a user with a problem, or have received a positive feedback, you can now enable a RATE button which will direct him too your application's Google Play store page.

					To enable the rate functionality just include <code>[RATE]</code> (case sensitive) within your e-mail reply.
                </li>

            </ul>
            </p>

            <p><strong>2013/11/30:</strong> v4
            <ul>
                <li>
                    added ability to set the orientation and gravity of the radio buttons. For usage see the example at the bottom.
                </li>

            </ul>
            </p>

            <p><strong>2013/11/07:</strong> v3
            <ul>
                <li>
                    Fixed a bug where on Holo.Light radio button text would not be readable
                </li>

            </ul>
            </p>

            <p><strong>2013/06/09:</strong> v2
            <ul>
                <li>
                    The library is released under the MIT Licence. i.e. you must refer to it somewhere within your app.
                </li>
                <li>
                    Added basic reply functionality
                </li>
                <li>
                    Added ability to disable radio buttons
                </li>
                <li>
                    Feedback dialog is now by default non-modal.
                </li>
			<li>Settings class has been renamed to "FeedbackSettings"</li>

            </ul>


            </p>
            <p><strong>2013/03/07:</strong> Beta release</p>


            </p>

            <h3>Usage</h3>
            <h4>Setup:</h4>
            <ol>
                <li>
                    Download <a href="<?=base_url()?>assets/jars/feedback_v6.jar">feedback-v6.jar <i class="icon-download-alt"></i></a>
                </li>
                <li>
                    Put the .jar into your project, in the <code>/libs</code> directory
                </li>
                <li>
                    Get your <a href="<?=base_url()?>account/account_apiaccess">API key</a>
                </li>
            </ol>
            <h4>Code:</h4>
            <ol>
                <li>
                    Make sure you have <code>&lt;uses-permission android:name="android.permission.INTERNET" /&gt;</code> in your manifest

                </li>
                <li>
                    Add a class field:<BR>
                    <code>
                        private FeedbackDialog feedBack;
                    </code>
                </li>
                <li>
                    At the end of your <strong>onCreate()</strong> method add: <BR>
                    <code>
                        feedBack = new FeedbackDialog(this, "YOUR_API_KEY");
                    </code>
                </li>
                <li>
                    Add/Edit your <strong>onPause()</strong> method:<BR>
                    <pre class="prettyprint"><code class="language-java" style="font-size:16px">
@Override
protected void onPause() {
&nbsp;&nbsp;&nbsp;&nbsp;super.onPause();
&nbsp;&nbsp;&nbsp;&nbsp;feedBack.dismiss();
}
					</code></pre>
                </li>
                <li>
                    Show the dialog (on a button press, on a menu click, .etc) <BR>
                    <code>
                        feedBack.show();
                    </code>
                </li>
            </ol>

            <h4>Customize:</h4>
            <pre class="prettyprint"><code class="language-java" style="font-size:16px">
FeedbackSettings feedbackSettings = new FeedbackSettings();

//SUBMIT-CANCEL BUTTONS
feedbackSettings.setCancelButtonText("No");
feedbackSettings.setSendButtonText("Send");

//DIALOG TEXT
feedbackSettings.setText("Hey, would you like to give us some feedback so that we can improve your experience?");
feedbackSettings.setYourComments("Type your question here...");
feedbackSettings.setTitle("Feedback Dialog Title");

//TOAST MESSAGE
feedbackSettings.setToast("Thank you so much!");
feedbackSettings.setToastDuration(Toast.LENGTH_SHORT);  // Default
feedbackSettings.setToastDuration(Toast.LENGTH_LONG);

//RADIO BUTTONS
feedbackSettings.setRadioButtons(false); // Disables radio buttons
feedbackSettings.setBugLabel("Bug");
feedbackSettings.setIdeaLabel("Idea");
feedbackSettings.setQuestionLabel("Question");

//RADIO BUTTONS ORIENTATION AND GRAVITY
feedbackSettings.setOrientation(LinearLayout.HORIZONTAL); // Default
feedbackSettings.setOrientation(LinearLayout.VERTICAL);
feedbackSettings.setGravity(Gravity.RIGHT); // Default
feedbackSettings.setGravity(Gravity.LEFT);
feedbackSettings.setGravity(Gravity.CENTER);

//SET DIALOG MODAL
feedbackSettings.setModal(true); //Default is false

//DEVELOPER REPLIES
feedbackSettings.setReplyTitle("Message from the Developer");
feedbackSettings.setReplyCloseButtonText("Close");
feedbackSettings.setReplyRateButtonText("RATE!");

//DEVELOPER CUSTOM MESSAGE (NOT SEEN BY THE END USER)
feedbackSettings.setDeveloperMessage("This is a custom message that will only be seen by the developer!");

feedBack = new FeedbackDialog(this, "YOU_API_KEY", feedbackSettings);
            </code></pre>




        </div>
    </div>
</div>



<?php echo $this->load->view('footer'); ?>
