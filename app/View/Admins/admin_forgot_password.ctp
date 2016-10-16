<script type="text/javascript">
	$(document).ready(function(){
		$("#AdminAdminForgotPasswordForm").validationEngine()
	});
</script>

<div id="login"> 
	<dl> <?php echo $this->Session->flash();?>
		<?php echo $this->Form->create('Admin', array('action'=>'admin_forgot_password'));?>
		<dt>Email</dt>
		<dd><?php echo $this->Form->text('Admin.email', array('div'=>false, 'label'=>false, 'maxlength'=>150, 'class'=>'validate[required,custom[email]]'));?></dd>

		<dt>&nbsp;</dt>
		<dd>
			<div style="width:375px;">
				<!-- SUBMIT BUTTON -->
				<div style="float:left;">
					<?php echo $this->Form->submit('Sign In', array('div'=>false, 'class'=>'black_btn'));?>
				</div>

				<!-- FORGOT PASSWORD -->
				<div style="float:right;">
					<?php echo $this->Html->link('Sign In', '/admin/admins/sign_in/', array('escape'=>false));?>
				</div>
				<div class="clear"></div>
			</div>
		</dd>
		<?php echo $this->Form->end();?>
	</dl>
</div>