<?php
	session_start;
	if($_SERVER['REQUEST_METHOD'] == "POST") {
		$privatekey = "6LcjqcgSAAAAABcxkdO8zNqggdtTS93rSDi2Rbz3";
		$error = null;
		$reCaptchaResponse = $_POST["recaptcha_response_field"];
		$reCaptchaChallenge = $_POST["recaptcha_challenge_field"];
		$contactName = $_POST["contactName"];
		$contactEmail = $_POST["contactEmail"];
		$contactBody = $_POST["contactBody"];
		$sensibleEmail = "submissions@sensibleux.com";
		$headers = 'From: '. $contactEmail . "\r\n" .
			'Reply-To: '. $contactEmail . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		if ($reCaptchaResponse) {
				$resp = recaptcha_check_answer ($privatekey,
												$_SERVER["REMOTE_ADDR"],
												$reCaptchaChallenge,
												$reCaptchaResponse);

				if (!$resp->is_valid) {
					$error = $resp->error;
				} else {
					if($contactName && $contactEmail && $contactBody){
						mail($sensibleEmail, "Contact from SensibleUX", $message, $headers);
						exit();
					}
				}
		}
	}
	//Detect special conditions devices
	$iPod = stripos($_SERVER['HTTP_USER_AGENT'], "iPod");
	$iPhone = stripos($_SERVER['HTTP_USER_AGENT'], "iPhone");
	$iPad = stripos($_SERVER['HTTP_USER_AGENT'], "iPad");
	if(stripos($_SERVER['HTTP_USER_AGENT'], "Android") && stripos($_SERVER['HTTP_USER_AGENT'], "mobile")) {
		$Android = true;
	}else if(stripos($_SERVER['HTTP_USER_AGENT'], "Android")) {
		$Android = false;
		$AndroidTablet = true;
	} else {
		$Android = false;
		$AndroidTablet = false;
	}
	$webOS = stripos($_SERVER['HTTP_USER_AGENT'], "webOS");
	$BlackBerry = stripos($_SERVER['HTTP_USER_AGENT'], "BlackBerry");
	$RimTablet = stripos($_SERVER['HTTP_USER_AGENT'], "RIM Tablet");
?>
<!doctype html><!--[if lt IE 7]><html class="no-js ie6 oldie" lang="en"><![endif]--><!--[if IE 7]><html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]><html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
	<!--<![endif]-->
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>SensibleUX | Experience that makes sense.</title>
		<meta name="description" content="User experience experts. The people to call when you want the job done right.">
		<meta name="author" content="" />
		<?php if( $iPod || $iPhone ){
		?><meta name="viewport" content="initial-scale=1, maximum-scale=1" /><?php	}?><link rel="stylesheet" href="css/screen.css" /><script src="js/libs/modernizr-2.0.6.min.js"></script>
		<script type="text/javascript">
			 var RecaptchaOptions = {
				theme : 'custom',
				custom_theme_widget: 'recaptcha_widget'
			 };
		</script>
	</head>
	<body>
		<div id="container">
			<header>
				<div class="company">
					<span class="company-name">Sensible<span>UX</span></span>
				</div>
			</header>
			<div id="main" role="main">
				<div class="introduction">
					<h1>Sensible User Experience</h1>
					<p>
						We start with a simple concept, <em>the user comes first</em>. This philosophy enables us to build interactive websites that people actually want to interact with.
					</p>
					<p>
						By building on this concept using standards-compliant development practices we deliver engaging feature-rich experiences that are both accessible and device-agnostic.
					</p>
					<p>
						Software interaction should be elegant and intuitive. By prototyping and engaging user input early, we can focus on developing robust applications that are easy to navigate and use. Combined with modern accessibility best practices, your application can reach a wider audience with less support.
					</p>
				</div>
				
				<form id="contactSensibleUX" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" class="ui-form">
					<input type="hidden" name="contactIP" value="<?php	print($_SERVER['REMOTE_ADDR']);?>" />
					<fieldset>
						<legend>
							Contact Us
						</legend>
						<p>
							Want to know how we can help you? This form will send us an email that will trigger a lightning-fast response from someone who knows what they are talking about. Imagine that.
						</p>
						<div>
							<label for="contactName">Your Name:</label>
							<input type="text" id="contactName" name="contactName" placeholder="John Doe" class="required" />
						</div>
						<div>
							<label for="contactEmail">Your Email Address:</label>
							<input type="email" id="contactEmail" name="contactEmail" placeholder="jdoe@example.com" class="required email" />
						</div>
						<div>
							<label for="contactBody">Message:</label>
							<textarea id="contactBody" name="contactBody" placeholder="Type your message here." class="required"></textarea>
						</div>
						<?php
							require_once('include/recaptchalib.php');
							$publickey = "6LcjqcgSAAAAAPK0bJIP0qHx0n1PwN2SOMQbpZti";
							
							echo recaptcha_get_html($publickey);
						?>
						<div id="recaptcha_widget" style="display:none;">
							<label for="recaptcha_response_field" class="recaptcha_only_if_image">Enter the words.</label>
							<label for="recaptcha_response_field" class="recaptcha_only_if_audio">Enter the numbers you hear.</label>
							<input type="text" id="recaptcha_response_field" name="recaptcha_response_field" class="required" />
							<label for="recaptcha_response_field" class="recaptcha_only_if_incorrect_sol error">Please try again.</label>
							<div id="recaptcha_image"></div>
							<ul id="recaptcha_controls">
								<li class="recaptcha_refresh"><a href="javascript:Recaptcha.reload()">Refresh Captcha</a></li>
								<li class="recaptcha_only_if_image"><a href="javascript:Recaptcha.switch_type('audio')">Audio Version</a></li>
								<li class="recaptcha_only_if_audio"><a href="javascript:Recaptcha.switch_type('image')">Image Version</a></li>
								<li class="recaptcha_help"><a href="javascript:Recaptcha.showhelp()">Help</a></li>
							</ul>
						</div>
						<script type="text/javascript" src="http://www.google.com/recaptcha/api/challenge?k=<?php echo $publickey; ?>"></script>
						 <noscript>
						   <iframe src="http://www.google.com/recaptcha/api/noscript?k=<?php echo $publickey; ?>"
								height="300" width="500" frameborder="0"></iframe><br>
						   <textarea name="recaptcha_challenge_field" rows="3" cols="40"></textarea>
						   <input type="hidden" name="recaptcha_response_field" value="manual_challenge" />
						 </noscript>
						<div>
							<button type="submit" class="submit">
								<span>Submit</span>
							</button>
						</div>
					</fieldset>
					<div id="thankYou">
						<strong>Thank you for your interest,</strong> you should receive a message shortly. Either by carrier pigeon, singing telegram, telephone, or email. In the meantime, <a href="http://www.youtube.com/">YouTube</a> is pretty entertaining.
					</div>
				</form>
			</div>
			<footer>
				<p class="footer-credits">
					Copyright <span class="company-name">Sensible<span>UX</span></span>
				</p>
			</footer>
		</div><!--! end of #container --><script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
		<script>window.jQuery || document.write('<script src="js/libs/jquery-1.6.2.min.js"><\/script>')</script><script src="js/plugins.js"></script>
		<script src="js/script.js"></script>
		<script>var _gaq = [['_setAccount', 'UA-25876679-1'], ['_trackPageview']];
			// Change UA-XXXXX-X to be your site's ID (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1; g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js'; s.parentNode.insertBefore(g,s)}(document,'script'));		</script><!--[if lt IE 7 ]> <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.2/CFInstall.min.js"></script> <script>window.attachEvent("onload",function(){CFInstall.check({mode:"overlay"})})</script> <![endif]-->
	</body>
</html>
