<script type="text/javascript">
	$(document).ready(function(){
		$("#AdminAdminSignInForm").validationEngine()
	});
</script>

<div id="login"> 
	<dl> <?php echo $this->Session->flash();?>
		<?php echo $this->Form->create('Admin', array('action'=>'admin_sign_in'));?>
		<dt>User Name</dt>
		<dd><?php echo $this->Form->text('Admin.username', array('div'=>false, 'label'=>false, 'maxlength'=>100, 'class'=>'validate[required]'));?></dd>

		<dt>Password</dt>
		<dd><?php echo $this->Form->password('Admin.password_1', array('div'=>false, 'label'=>false, 'maxlength'=>100, 'class'=>'validate[required]'));?></dd>

		<dt>&nbsp;</dt>
		<dd>
			<div style="width:375px;">
				<!-- SUBMIT BUTTON -->
				<div style="float:left;">
					<?php echo $this->Form->submit('Sign In', array('div'=>false, 'class'=>'black_btn'));?>
				</div>

				<!-- FORGOT PASSWORD -->
				<div style="float:right;">
					<?php echo $this->Html->link('Forgot Password?', '/admin/forgot-password/', array('escape'=>false));?>
				</div>
				<div class="clear"></div>
			</div>
		</dd>
		<?php echo $this->Form->end();?>
	</dl>
</div>