<div class="header">
	<div class="container clearfix">
		<div class="logo"><?php echo $this->Html->link($this->Html->image('Front/logo.png', array('alt'=>'LOGO', 'style'=>'width:189px; height:44px;')), '/', array('escape'=>false));?></div>

		<div class="serachCon">
			<?php 
				echo $this->Html->image('Front/srchicon.png', array('alt'=>''));
				$srchVal = '';
				/* if(isset($this->params->pass[0]) && ($this->params->pass[0] != '')){
					$srchVal = $this->params->pass[0];
				} */
				if(isset($keyword) && !empty($keyword)){
					$srchVal = $keyword;
				}
			?>

			<input id="searchItem" type="text" placeholder="Enter Your Search..." class="srchInput" value="<?php echo $srchVal;?>"/>
			<input type="submit" class="srchBtn" value="&nbsp;" id="srchBtn">
			<div class="clearfix"></div>
		</div>

		<div class="signIn">
			<?php if($this->Session->read('Auth.User.User.id') == ''){?>
				<a href="javascript:void(0)" class="signUp login" id="login">Login</a>
				<a href="javascript:void(0)" class="signUp" id="signup">Sign Up</a>
			<?php }else{ 
				// Image Avatar Start
				if($this->Session->read('Auth.User.User.image') != ''){
					$proPath = '';
					$imagePath = '../webroot/img/Users/'.$this->Session->read('Auth.User.User.image');
					if(is_file($imagePath)){
						$proPath = 'Users/'.$this->Session->read('Auth.User.User.image');
			?>
					<a href="<?php echo SITE_PATH;?>my-account/" class="userImg"><?php echo $this->Image->resize($proPath, 40, 40);?></a>
			<?php
					}
				}
				// Image Avatar End
			?>
				<a href="<?php echo SITE_PATH.'users/sign_out/';?>" class="signUp" id="signout" style="margin-top:-9px;">Sign Out</a>
			<?php } ?>
			<?php echo $this->Html->link($this->Html->image('Front/mail.png', array('alt'=>'')), '/contact-us/', array('escape'=>false));?>
		</div>
	</div>
</div>

<script type="text/javascript">
$('#srchBtn').click(function(){
	var searchItem = $('#searchItem').val();
	if(searchItem != ''){
		var nxtUrl = "<?php echo SITE_PATH;?>products/searchitem/"+searchItem;
		$(location).attr('href', nxtUrl);
	}
});

$("#searchItem").keyup(function(event){
  if(event.keyCode == 13){
   var searchItem = $('#searchItem').val();
	if(searchItem != ''){
		var nxtUrl = "<?php echo SITE_PATH;?>products/searchitem/"+searchItem;
		$(location).attr('href', nxtUrl);
	}
  }
});

</script>
