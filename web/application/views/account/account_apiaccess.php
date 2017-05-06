<!DOCTYPE html>
<html>
<head>
	<?php echo $this->load->view('head', array('title' => "API Access")); ?>

</head>
<body>

<?php echo $this->load->view('header'); ?>

<div class="container">
    <div class="row">
        <div class="span2">
			<?php echo $this->load->view('account/account_menu', array('current' => 'account_apiaccess')); ?>
        </div>
        <div class="span10">

			<?php if ($this->session->flashdata('api_info')) : ?>
            <div class="alert alert-success fade in">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
				<?php echo $this->session->flashdata('api_info'); ?>
            </div>
			<?php endif; ?>

            <h2><?php echo "Manage your API keys" ?></h2>

            <div class="well"><?php echo "Manage your API keys from here" ?></div>

            <h3>Add new key</h3>

			<?php echo form_open(uri_string(), 'class="form-horizontal"'); ?>
			<?php echo form_fieldset(); ?>

            <br>

            <div class="control-group <?php echo (form_error('api_package_name')) ? 'error' : ''; ?>">
                <label class="control-label" for="api_package_name">Package Name</label>

                <div class="controls">
					<?php echo form_input(array(
					'class' => 'input-xlarge',
					'name' => 'api_package_name',
					'id' => 'api_package_name',
					'value' => set_value('api_package_name'),
					'autocomplete' => 'off',
					'placeholder' => 'com.yourcompany.yourapp'
				)); ?>
					<?php if (form_error('api_package_name')):?>
                    <span class="help-inline">
						<?=form_error('api_package_name');?>
						</span>
					<?php endif; ?>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-primary">Add new key</button>
            </div>

			<?php echo form_fieldset_close(); ?>
			<?php echo form_close(); ?>

            <h3>Active keys</h3>

            <table class="table">
                <thead>
                <tr>
                    <th style="width:30%">Key</th>
                    <th style="width:50%">App's Package name</th>
                    <th style="width:15%">Access Count</th>
                    <th style="width:5%"></th>
                </tr>
                </thead>
                <tbody>

				<?php if($api_keys != NULL):?>
					<?php foreach($api_keys as $api_key):?>
                    <tr>
                        <td>
                            <code style="font-size:16px;color:green;background:#FFFFFF;border: 0px;"><?=$api_key->key?></code>
                            <i style="cursor:pointer" class="icon-copy api_ctc_buttons" data-clipboard-text="<?=$api_key->key?>"></i>
                        </td>
                        <td><?=$api_key->pname?></td>
                        <td style="text-align: right"><?=$api_key->counter?></td>
                        <td style="text-align: right">
                            <i style="cursor:pointer;color:#808080" data-api-key-uid="<?=$api_key->UID?>" data-api-key-code="<?=$api_key->key?>" class="icon-remove api_remove_key_btn"></i>
                        </td>
                    </tr>
						<?php endforeach;?>

					<?php else:?>
                <tr>
                    <td colspan="3" style="text-align: center; ">You haven't created any API keys yet.</td>
                </tr>
					<?php endif;?>

                </tbody>
            </table>

            <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/ZeroClipboard.min.js"></script>

            <script language="JavaScript">

                var enableZC = true;
                var is_firefox18 = navigator.userAgent.toLowerCase().indexOf('firefox/18') > -1;
                var is_firefox19 = navigator.userAgent.toLowerCase().indexOf('firefox/19') > -1;

                if (is_firefox18 || is_firefox19) enableZC = false;

                var clip = new ZeroClipboard();
                clip.glue( $(".api_ctc_buttons") );

                if(enableZC){
                    clip.on( 'complete', function ( client, args ) {
                        alert("Copied key " + args.text +" to clipboard");
                    } );
                }

            </script>



        </div>
    </div>
</div>

<div id="delete_modal" class="modal hide fade">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3>Delete key confirmation</h3>
    </div>
    <div class="modal-body">
        <p>Are you sure you want to deletey this key? This process cannot be undone</p>
		<p>Key : <strong><code id="modal_id" style="font-size:16px;color:green;background:#FFFFFF;border: 0px;"></code></strong></p>
        <p>Package name : <strong>com.suredigit.naftemporiki.hd</strong></p>
    </div>
    <div class="modal-footer">
        <a href="#" class="btn" onclick="$('#delete_modal').modal('hide'); return false;">Cancel</a>
		<?php echo form_open(uri_string()."/delete", 'style="float:right;margin-left:5px"'); ?>
		<?php echo form_fieldset(); ?>
		<?php echo form_hidden('api_key_id', "NOKEY"); ?>
		<?php echo form_button(array(
		'type' => 'submit',
		'class' => 'btn btn-danger',
		'content' => '<i class="icon-trash"></i> Delete Key'
		)); ?>
		<?php echo form_fieldset_close(); ?>
		<?php echo form_close(); ?>

    </div>
</div>

<script>

    $(".api_remove_key_btn").click(function () {

        var key_UID = ($(this).attr("data-api-key-uid"));
        var key_code = ($(this).attr("data-api-key-code"));

		$('input:hidden[name="api_key_id"]').val(key_UID);

		$('#modal_id').html(key_code);

        $('#delete_modal').modal({
            keyboard: false
        })
    });



</script>


<?php echo $this->load->view('footer'); ?>