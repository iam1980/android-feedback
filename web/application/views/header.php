<div class="navbar navbar-inverse navbar-fixed-top" xmlns="http://www.w3.org/1999/html">
    <div class="navbar-inner">
        <div class="container">
            <a style="padding: 3px 20px;" class="brand" href=""><img alt="inApp Feedback" src="<?base_url()?>assets/img/smalllogo.png"> </a>

            <div class="nav-collapse collapse">
                <ul class="nav">
                    <li class="divider-vertical"></li>
                    <li><?php echo anchor('#features', 'Features'); ?></li>
                    <li><?php echo anchor('#usage', 'Usage'); ?></li>
                    <li><?php echo anchor('#howitworks', 'How it works'); ?></li>
                    <li><?php echo anchor('library', 'Library'); ?></li>
                    <li><?php echo anchor('contact', 'Contact'); ?></li>
                </ul>

                <ul class="nav pull-right">
					<?if (($this->uri->segment(1) === FALSE) || ($this->uri->segment(1) === "contact")): ?>

                    <li style="padding: 10px 0 0;">
                        <div class="g-plusone" data-size="medium"></div>
                    </li>
					<? endif;?>


                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php if ($this->authentication->is_signed_in()) : ?>
                        <i class="icon-user icon-white"></i> <?php echo $account->username; ?> <b class="caret"></b></a>
					<?php else : ?>
                        <i class="icon-user icon-white"></i> <b class="caret"></b></a>
						<?php endif; ?>

                        <ul class="dropdown-menu">
							<?php if ($this->authentication->is_signed_in()) : ?>
                            <li><?php echo anchor('account/account_profile', lang('website_profile')); ?></li>
                            <li><?php echo anchor('account/account_settings', lang('website_account')); ?></li>
							<?php if ($account->password) : ?>
                                <li><?php echo anchor('account/account_password', lang('website_password')); ?></li>
							<?php endif; ?>
                            <li><?php echo anchor('account/account_linked', lang('website_linked')); ?></li>
                            <li><?php echo anchor('account/account_apiaccess', "API Access"); ?></li>
                            <li><?php echo anchor('account/account_library', "Library"); ?></li>
                            <li class="divider"></li>
                            <li><?php echo anchor('account/sign_out', lang('website_sign_out')); ?></li>
							<?php else : ?>
                            <li><?php echo anchor('account/sign_in', lang('website_sign_in')); ?></li>
							<?php endif; ?>

                        </ul>
                    </li>
                </ul>

            </div>
            <!--/.nav-collapse -->
        </div>


    </div>


    <div style="height:6px;">
        <div style="float:left;height:5px;background:#33B5E5;width:20%"></div>
        <div style="float:left;height:5px;background:#AA66CC;width:20%"></div>
        <div style="float:left;height:5px;background:#99CC00;width:20%"></div>
        <div style="float:left;height:5px;background:#FFBB33;width:20%"></div>
        <div style="float:left;height:5px;background:#FF4444;width:20%"></div>
    </div>

</div>
