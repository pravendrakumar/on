<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo ADMIN_PAGE_TITLE;?></title>
	<?php 
		echo $this->Html->css('Admin/style');

		//CODE FOR VALIDATION ENGINE
		echo $this->Html->css(array('ValidationEngine/validationEngine.jquery', 'ValidationEngine/template'));
		echo $this->Html->script(array('ValidationEngine/jquery-1.7.2.min', 'ValidationEngine/languages/jquery.validationEngine-en', 'ValidationEngine/jquery.validationEngine'));
	?>
</head>
<body id="loginbg">
	<?php echo $this->fetch('content');?>
</body>
</html>
