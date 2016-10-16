<!DOCTYPE html>
<html ng-app="myApp"  lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0">
<!-- CSS START -->
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<?php echo $this->Html->css(array('Front/fonts/fonts', 'Front/style', 'Front/tablet', 'Front/mobile'));?>
<!-- CSS END -->

<!-- SCRIPTS START -->
<?php echo $this->Html->script('Front/jquery.min');?>
<!-- SCRIPTS END -->
<title>Trend Tail</title>
</head>
<body  ng-controller="myCtrl" >
	<div   class="mainCon">
		<!-- HEADER START -->
		<?php echo $this->Element('Front/header');?>
		<!-- HEADER END -->

		<!-- TOP TAB START -->
		<?php echo $this->Element('Front/top_tab');?>
		<!-- TOP TAB END -->

		<!-- MIDDLE CONTAINER START -->
		<div class="midCon">
			<div class="container clearfix">
				<!-- LEFT NAVIGATION START -->
				<?php echo $this->Element('Front/left_nav');?>
				<!-- LEFT NAVIGATION END -->

				<!-- PAGE CONTENT START -->
				<?php echo $this->fetch('content');?>
				<!-- PAGE CONTENT END -->
			</div>
		</div>
		<!-- MIDDLE CONTAINER END -->

		<!-- FOOTER START -->
		<?php echo $this->Element('Front/footer');?>
		<!-- FOOTER END -->
	</div>
</body>
</html>
