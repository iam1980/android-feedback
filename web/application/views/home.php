<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head'); ?>

</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
    <div class="row">
        <div class="span12">

            <!-- Main hero unit for a primary marketing message or call to action -->
            <div class="hero-unit" style="position: relative;">
                <div class="ribbon-wrapper-green">
                    <div class="ribbon-green">v6</div>
                </div>

                <div class="row-fluid">

                    <div class="span5">
                        <img alt="Nexus 4 inApp Feedback Screenshot" src="<?base_url()?>assets/img/nexus4screen.png">
                    </div>

                    <div class="span7">

                        <h1>Android inApp Feedback</h1>
                        <BR>

                        <p>
                            Android in-App Feedback is a lightweight library that can be included in your mobile application projects. </p>

                        <p>
                            It bridges the communication gap between you and your customers. It enables users to provide feedback on their experience directly from within your
                            application.</p>

                        <p>
                            inApp Feedback allows for direct communication between you, the developer, and your customers.
                        </p>
                        <BR>
                        <BR>

                        <p><a class="btn btn-primary btn-large pull-right" href="<?=base_url()?>account/sign_in"><i
                                class="icon-wrench icon-white"></i> LOGIN</a><br/></p>
                        <BR>
                        <BR>

                        <p style="text-align:center;color:#778899">
                            <i class="icon-cog"></i> API 1.5+&nbsp;&nbsp;&nbsp;
                            <i class="icon-plane"></i> lightweight&nbsp;&nbsp;&nbsp;
                            <i class="icon-wrench"></i> customizable
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row" id="features">

        <div class="offset1 span5">
            <h3>Why?
                <small>features and advantages</small>
            </h3>

            <div class="row" style="margin-top:20px;">
                <div class="span1" style="text-align:center">
                    <div style="width:64px;height:52px;background:#EEEEEE;padding-top: 12px">
                        <i class="icon-group icon-3x" style=""></i>
                    </div>
                </div>
                <div class="span4">
                    <h4 style="margin-top:2px">Ease of communication</h4>

                    <p>The User can send his feedback instantly within your application, you are just one click away.</p>
                </div>
            </div>

            <div class="row" style="margin-top:20px;">
                <div class="span1" style="text-align:center">
                    <div style="width:64px;height:52px;background:#EEEEEE;padding-top: 12px">
                        <i class="icon-star icon-3x" style=""></i>
                    </div>
                </div>
                <div class="span4">
                    <h4 style="margin-top:2px">Improve Google Play ratings</h4>

                    <p>Minimise bad Google play ratings and reviews, by listening to your customers and helping them understand and use 100% of your application.</p>
                </div>
            </div>

            <div class="row" style="margin-top:20px;">
                <div class="span1" style="text-align:center">
                    <div style="width:64px;height:52px;background:#EEEEEE;padding-top: 12px">
                        <i class="icon-thumbs-up icon-3x" style=""></i>
                    </div>
                </div>
                <div class="span4">
                    <h4 style="margin-top:2px">Improve and refine</h4>

                    <p>Get valuable feedback and ideas from your customers' perspective. Use this information to improve your App on its next development iteration.</p>
                </div>
            </div>
        </div>

        <div class="offset1 span5">
            <h3>Simple integration
                <small>less than 5 minutes</small>
            </h3>

            <script src="assets/bootstrap/js/holder.js"></script>
            <!-- Used for 64x64 placeholder boxes -->

            <div class="row" style="margin-top:20px;">
                <p>Integrading the feedback library to your project is a very simple process. Bellow are the basic steps
                    that need to be performed in order to get the feedback library working:</p>
                <ol>
                    <li style="margin-bottom:15px;">Sign up and get your <b>API KEY</b></li>
                    <li style="margin-bottom:15px;">Download the <code>feedback.jar</code> library</li>
                    <li style="margin-bottom:15px;">import the feedback library into your project<BR><code>import com.suredigit.inappfeedback;</code></li>
                    <li style="margin-bottom:15px;">Initialise and configure the library in your onCreate() method<BR>
                        <code>feedBackDialog = new FeedbackDialog(Context,"YOUR_API_KEY");</code></li>
                    <li style="margin-bottom:15px;">When you want to show the FeedBack Dialog:<BR><code>feedBackDialog.show()</code></li>
                </ol>
                <p>Thats it! Your customers can now leave their feedback and questions</p>
            </div>

        </div>

    </div>
    <!-- /end row -->

    <div class="row">
        <div class="span12">
            <h3 id="howitworks">How it works
                <small>Five simple steps</small>
            </h3>
            <div style="text-align:center;">
                <img alt="How in app feedback works" src="<?base_url()?>assets/img/howitworks.jpg">
            </div>
        </div>
    </div>

	<div class="row">

	</div>


</div>

<?php echo $this->load->view('footer'); ?>