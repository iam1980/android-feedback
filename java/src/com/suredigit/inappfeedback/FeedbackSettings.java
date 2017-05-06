package com.suredigit.inappfeedback;

import android.view.Gravity;
import android.widget.LinearLayout;
import android.widget.Toast;

public class FeedbackSettings {

	private String title = "Feedback";
	private String replyTitle = "Message from the Developer";
	private String text = "Love it? Hate it? Would you like to suggest a new feature or report a bug? We would love to hear from you: ";
	private String toast = "Thank you!";
	private String sendButton = "Send";
	private String cancelButton = "Cancel";
	private String yourComments = "Your comments";
	private String bugLabel = "bug";
	private String ideaLabel = "idea";
	private String questionLabel = "question";
	private boolean isModal = false;
	private boolean displayRadioButtons = true;
	private String replyCloseButtonText = "Close";
	private String replyRateButtonText = "RATE!";
	private String developerMessage = "";
	private int toastDuration = Toast.LENGTH_SHORT;
	private int orientation = LinearLayout.HORIZONTAL;
	private int gravity = Gravity.RIGHT;

	public FeedbackSettings() {
		super();
	}

	public String getTitle() {
		return title;
	}

	public void setTitle(String title) {
		this.title = title;
	}

	public String getText() {
		return text;
	}

	public void setText(String text) {
		this.text = text;
	}

	public String getToast() {
		return toast;
	}

	public void setToast(String toast) {
		this.toast = toast;
	}

	public String getSendButtonText() {
		return sendButton;
	}

	public void setSendButtonText(String sendButton) {
		this.sendButton = sendButton;
	}

	public String getCancelButtonText() {
		return cancelButton;
	}

	public void setCancelButtonText(String cancelButton) {
		this.cancelButton = cancelButton;
	}

	public String getYourComments() {
		return yourComments;
	}

	public void setYourComments(String yourComments) {
		this.yourComments = yourComments;
	}

	public String getBugLabel() {
		return bugLabel;
	}

	public void setBugLabel(String bugLabel) {
		this.bugLabel = bugLabel;
	}

	public String getIdeaLabel() {
		return ideaLabel;
	}

	public void setIdeaLabel(String ideaLabel) {
		this.ideaLabel = ideaLabel;
	}

	public String getQuestionLabel() {
		return questionLabel;
	}

	public void setQuestionLabel(String questionLabel) {
		this.questionLabel = questionLabel;
	}

	public boolean isModal() {
		return isModal;
	}

	public void setModal(boolean isModal) {
		this.isModal = isModal;
	}

	public boolean isEnableRadio() {
		return displayRadioButtons;
	}

	public void setRadioButtons(boolean enableRadio) {
		this.displayRadioButtons = enableRadio;
	}

	public String getReplyTitle() {
		return replyTitle;
	}

	public void setReplyTitle(String replyTitle) {
		this.replyTitle = replyTitle;
	}

	public String getReplyCloseButtonText() {
		return replyCloseButtonText;
	}

	public void setReplyCloseButtonText(String replyCloseButtonText) {
		this.replyCloseButtonText = replyCloseButtonText;
	}

	public int getOrientation() {
		return orientation;
	}

	public void setOrientation(int orientation) {
		this.orientation = orientation;
	}

	public int getGravity() {
		return gravity;
	}

	public void setGravity(int gravity) {
		this.gravity = gravity;
	}

	public String getReplyRateButtonText() {
		return replyRateButtonText;
	}

	public void setReplyRateButtonText(String replyRateButtonText) {
		this.replyRateButtonText = replyRateButtonText;
	}

	public String getDeveloperMessage() {
		return developerMessage;
	}

	public void setDeveloperMessage(String developerMessage) {
		this.developerMessage =  developerMessage;
	}

	public int getToastDuration() {
		return toastDuration;
	}

	public void setToastDuration(int toastDuration) {
		this.toastDuration = toastDuration;
	}

	
	

}
