<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE>Top 10</TITLE>
  <style type="text/css">
  .mainContainer{border:1px solid #DCDCDC; width:600px; font-size:13px; font-family:Arial,Helvetica,sans-serif}
  .logoContainer{border-bottom:1px solid #DCDCDC; text-align:left;}
  .logoContainerImg{padding:10px;}
  .contentContainer{margin:20px;}
  </style>
 </HEAD>
 <BODY>
	<!-- MAIN BODY CONTAINER START -->
	<div class="mainContainer">
		<!-- LOGO CONTAINER START -->
		<div class="logoContainer">
			<!-- <a href="<?php echo SITE_PATH;?>" class="logoContainerAnchor" target="_blank"><img src="<?php echo SITE_PATH;?>img/Front/logo.png" alt="" class="logoContainerImg"></a> -->
		</div>
		<!-- LOGO CONTAINER END -->

		<!-- CONTENT CONTAINER START -->
		<div class="contentContainer">
			<?php echo $this->fetch('content');?>
		</div>
		<!-- CONTENT CONTAINER END -->

		<!-- REGRADS CONTAINER START -->
		<br/>
		<div class="contentContainer">
			With Warm Regards,<br/>
			<?php echo REGARDS_TEAM;?>
		</div>
		<!-- REGRADS CONTAINER END -->
	</div>
	<!-- MAIN BODY CONTAINER END -->
 </BODY>
</HTML>
