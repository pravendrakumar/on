<div>
	<div class="header_inner">
		<!-- <div class="logo">
			<?php //echo $this->Html->link($this->Html->image('Front/logo.png', array('alt'=>'')), SITE_PATH.'admin', array('escape'=>false));?>
		</div> -->

		<ul class="name">
		<li>Hi</li>
		<li><?php echo ucwords($this->Session->read('Auth.Admin.Admin.username'));?></li>
		<li class="pdleft5">
			<a href="<?php echo SITE_PATH.'admin/admins/sign_out/';?>"><input name="" value="sign out" class="black_btn_small" type="button"></a>
		</li>
		</ul>

		<!-- HEADER NAVIGATION START -->
		<?php echo $this->element('Admin/top_navigation');?>
		<!-- HEADER NAVIGATION END -->
	</div>
</div>