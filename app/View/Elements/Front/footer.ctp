<div class="footer">
	<div class="footNav">
		<a href="<?php echo SITE_PATH;?>">Home</a>
		<a href="<?php echo SITE_PATH;?>about-us/">About Us</a>
		<a href="<?php echo SITE_PATH;?>contact-us/">Contact Us</a>
		<a href="<?php echo SITE_PATH;?>legal-disclaimer/">Legal Disclaimer</a>
		<a href="<?php echo SITE_PATH;?>privacy/">Privacy Policy</a>
		<a href="<?php echo SITE_PATH;?>terms/">Terms</a>
	</div>
	<div class="copyRight">&copy;<?php echo date('Y').'-'.(date('Y')+1);?> <a href="<?php echo SITE_PATH;?>">Trendtail</a>. All right reserved.</div>
</div>

<!-- REGISTRATION POP-UP START -->
<div class="backBg" id="registration">
    <div class="loginPop registrationBox">
        <div class="innerPop">
            <a href="javascript:void(0)" class="xclose">XClose</a>
            <div class="treandTail">Registration</div>
            <div class="formRow clearfix">
            	<div class="half fl">
			<label>First Name:</label>
			<input type="text" id="firstName" placeholder="First Name" class="srchInput2 reginput">
		</div>
                <div class="half fr">
			<label>Last Name:</label>
			<input type="text" id="lastName" placeholder="Last Name" class="srchInput2 reginput">
		</div>
            </div>
             <div class="formRow clearfix">
            	<div class="half fl">
			<label>Email:</label>
			<input type="text" id="regsEmail" placeholder="Email id" class="srchInput2 reginput">
		</div>
                <div class="half fr">
			<label>Password:</label>
			<input type="password" id="regsPass" placeholder="Password" class="srchInput2 reginput">
		</div>
            </div>
              <input type="submit" value="Sign Up" class="loginBtn Btn" id="regsBtn">
	      <span id="registerSpan"></span>
        </div>
    </div>
</div>

<script type="text/javascript">
$("#signup").click(function(){
	$('#registration').fadeIn(350);
	$("body").css("overflow","hidden");
});

$('#regsBtn').click(function(){
	var firstName = $('#firstName').val();
	if(firstName == ''){
		alert('Please Provide First Name!!');
		$('#firstName').focus();
		return false;
	}

	var lastName = $('#lastName').val();
	if(lastName == ''){
		alert('Please Provide Last Name!!');
		$('#lastName').focus();
		return false;
	}

	var regsEmail = $('#regsEmail').val();
	if(regsEmail == ''){
		alert('Please Provide Email!!');
		$('#regsEmail').focus();
		return false;
	}else{
		
		if(validateEmail(regsEmail) == 'false'){
			alert('Please Provide Valid Email!!');
			$('#regsEmail').focus();
			return false;
		}
	}

	var regsPass = $('#regsPass').val();
	if(regsPass == ''){
		alert('Please Provide Password!!');
		$('#regsPass').focus();
		return false;
	}

	$.ajax({
		type: "POST",
		url: "<?php echo SITE_PATH;?>users/sign_up/",
		data: "email="+regsEmail+"&pass="+regsPass+"&first_name="+firstName+"&last_name="+lastName,
		beforeSend:function(){
			var bSend = '<img src="<?php echo SITE_PATH;?>img/Ajax/pic-loader.gif"> Please Wait...';
			$('#registerSpan').html(bSend);
		},
		success: function(response){
			if(response == 'true'){
				window.location.reload();
			}else{
				$('#registerSpan').html(response);
			}
		}
	});
});
</script>
<!-- REGISTRATION POP-UP END -->

<!-- SIGN IN SECTION START -->
<div class="backBg" id="loginPop">
    <div class="loginPop">
        <div class="innerPop">
            <a href="javascript:void(0)" class="xclose">XClose</a>
            <div class="treandTail">Trend tail login</div>
	    <label style="color: #9fd4d5; float: left; font-size: 15px; margin: 0 0 3px;">Email: </label>
             <input id="loginEmail" type="text" placeholder="Email" class="srchInput2">

	      <label style="color: #9fd4d5; float: left; font-size: 15px; margin: 0 0 3px;">Password: </label>
              <input id="loginPass" type="password" placeholder="Password" class="srchInput2">
              <div class="remeber">
                <a href="javascript:void(0);" class="frgtPass" id="forgotLink">Forgot Password?</a>
                <div class="clearfix"></div>
              </div>
              <input type="submit" value="login" class="loginBtn Btn" id="loginBtn">
	      <div style="color:green; font-weight:bold;" id="loginSpan"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
function validateEmail(email){
	filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	if(filter.test(email))
		return 'true';
	else
		return 'false';
}

$("#login").click(function(){
	$('#loginPop').fadeIn(350);
	$("body").css("overflow","hidden");
});

$("#myAccountLink").click(function(){
	$('#loginPop').fadeIn(350);
	$("body").css("overflow","hidden");
});

// if login button is clicked
$('#loginBtn').click(function(){
	var loginEmail = $('#loginEmail').val();
	if(loginEmail == ''){
		alert('Please Provide Email!!');
		$('#loginEmail').focus();
		return false;
	}else{
		if(validateEmail(loginEmail) == 'false'){
			alert('Please Provide Valid Email!!');
			$('#loginEmail').focus();
			return false;
		}
	}

	var loginPass = $('#loginPass').val();
	if(loginPass == ''){
		alert('Please Provide Password!!');
		$('#loginPass').focus();
		return false;
	}


	$.ajax({
		type: "POST",
		url: "<?php echo SITE_PATH;?>/users/sign_in/",
		data: "email="+loginEmail+"&pass="+loginPass,
		beforeSend:function(){
			var bSend = '<img src="<?php echo SITE_PATH;?>img/Ajax/pic-loader.gif"> Please Wait...';
			$('#loginSpan').html(bSend);
		},
		success: function(response){
			//$('#loginSpan').html(response);
			if(response == 'true'){
				window.location.reload();
			}else{
				$('#loginSpan').html(response);
			}
		}
	});
});
</script>
<!-- SIGN IN SECTION END -->

<!-- FORGOT PASSWORD START -->
<div class="backBg" id="forgotPassPop">
    <div class="loginPop">
        <div class="innerPop">
            <a href="javascript:void(0)" class="xclose">XClose</a>
            <div class="treandTail">Forgot Password?</div>
	    <label style="color: #9fd4d5; float: left; font-size: 15px; margin: 0 0 3px;">Email: </label>
             <input id="forgotEmail" type="text" placeholder="Email" class="srchInput2">
              <div class="remeber">
                <a href="javascript:void(0);" class="frgtPass" id="signInLink">Sign In</a>
                <div class="clearfix"></div>
              </div>
              <input type="submit" value="Submit" class="loginBtn Btn" id="forgotBtn">
	      <div style="color:green; font-weight:bold;" id="forgotSpan"></div>
        </div>
    </div>
</div>

<script type="text/javascript">
// if login button is clicked
$('#forgotBtn').click(function(){
	var forgotEmail = $('#forgotEmail').val();
	if(forgotEmail == ''){
		alert('Please Provide Email!!');
		$('#forgotEmail').focus();
		return false;
	}else{
		if(validateEmail(forgotEmail) == 'false'){
			alert('Please Provide Valid Email!!');
			$('#forgotEmail').focus();
			return false;
		}
	}

	$.ajax({
		type: "POST",
		url: "<?php echo SITE_PATH;?>users/forgot_password/",
		data: "email="+forgotEmail,
		beforeSend:function(){
			var bSend = '<img src="<?php echo SITE_PATH;?>img/Ajax/pic-loader.gif"> Please Wait...';
			$('#forgotSpan').html(bSend);
		},
		success: function(response){
			if(response == 'true'){
				$('#forgotSpan').html('Password Reset & Sent to Your Email!!');
			}else{
				$('#forgotSpan').html(response);
			}
		}
	});
});
</script>
<!-- FORGOT PASSWORD END -->


<script type="text/javascript">
// if forgot password is clicked
$('#forgotLink').click(function(){
	$('#loginPop').fadeOut(); // close the login pop-up

	$('#forgotPassPop').fadeIn(350);
	$("body").css("overflow","hidden"); // open the forgot password pane
});

// if sign in link is clicked
$('#signInLink').click(function(){
	$('#forgotPassPop').fadeOut(); // close the login pop-up

	$('#loginPop').fadeIn(350);
	$("body").css("overflow","hidden"); // open the sign in pane
});
</script>




<script type="text/javascript">
$(".xclose").click(function(){
	$('#registration').fadeOut();
	$('#loginPop').fadeOut();
	//$("body").css("overflow","hidden");
});
</script>