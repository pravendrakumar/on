<div class="menu">
	<div>
	<ul>
		<!-- <li <?php if($this->params['controller']=='users'){echo 'class="active"';}?>><a href="<?php echo SITE_PATH.'admin/users/manage/';?>">Users</a></li> -->
		<li <?php if($this->params['controller']=='pages'){echo 'class="active"';}?>><a href="<?php echo SITE_PATH.'admin/pages/manage/';?>">Static Pages</a></li>
		<li <?php if(($this->params['controller']=='products') && ($this->params['action']=='admin_manage')){echo 'class="active"';}?>><a href="<?php echo SITE_PATH.'admin/products/manage/';?>">Products</a></li>
		<li <?php if(($this->params['controller']=='products') && $this->params['action']=='admin_manage_api'){echo 'class="active"';}?>><a href="<?php echo SITE_PATH.'admin/products/manage_api/';?>">API Products</a></li>
		<li <?php if($this->params['controller']=='categories'){echo 'class="active"';}?>><a href="<?php echo SITE_PATH.'admin/categories/manage/';?>">Categories</a></li>
		<li <?php if($this->params['controller']=='admins'){echo 'class="active"';}?>><a href="<?php echo SITE_PATH.'admin/admins/dashboard/';?>">Admin Settings</a></li>
	</ul>
	</div>
</div>
