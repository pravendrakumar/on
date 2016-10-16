<div class="topTab">
	<div class="container clearfix">
		<!-- TOP TAB NAVIGATION START -->
		<?php
			$topTabCat = $this->Sport->fetchtopTabCategories(); //pr($topTabCat);die;
			if(!empty($topTabCat)){
		?>
		<div class="tab">
			<ul>
				<?php
					foreach($topTabCat as $tabArr){ //pr($tabArr);die;
				?>
				<li><a href="<?php echo SITE_PATH;?>products/listitems/<?php echo $tabArr['Category']['alias_name'];?>"><?php echo $tabArr['Category']['name'];?></a></li>
				<?php } ?>
			</ul>
		</div>
		<?php } ?>
		<!-- TOP TAB NAVIGATION END -->
		<div class="wishList">
			<?php if($this->Session->read('Auth.User.User.id') != ''){?>
				<a href="<?php echo SITE_PATH;?>my-account/"><span><?php echo $this->Html->image('Front/acc.png', array('alt'=>'')); echo $this->Session->read('Auth.User.User.first_name');?></span></a>
			<?php }else{?>
				<a href="javascript:void(0);" id="myAccountLink"><span><?php echo $this->Html->image('Front/acc.png', array('alt'=>''));?>My Account</span></a>
			<?php } ?>

			<?php if($this->Session->read('Auth.User.User.id') != ''){?>
			<a href="<?php echo SITE_PATH.'wishlist/'?>" style="color:#FFF;"><span>Wishlist(<label id="wishlistCounter"><?php echo $this->Sport->fetchWishlistCounter();?></label>)</span></a>
			<?php }else{?>
				<span>Wishlist(0)</span>
			<?php } ?>
		</div>
	</div>
</div>