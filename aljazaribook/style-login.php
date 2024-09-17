
<style type="text/css">
	.login h1 a {
		background-image: url(<?php echo get_template_directory_uri(); ?>/login-logo.png) !important;
		width:100% !important;
		background-size: contain !important;
		background-position: center center;
		background-color:transparent;
	}

	.login {
		background-color: transparent;
		background-image: url(<?php echo get_template_directory_uri(); ?>/login_bg.jpg) !important;
		background-size: contain;
		background-repeat: no-repeat;
		background-position: right;
	}

	#loginform, #registerform, #lostpasswordform, #resetpassform {

		background: rgba(0, 0, 0, 0) -moz-linear-gradient(center top , rgba(0,0,0, 0.7) 0%, rgba(0, 0, 0, 0.7) 100%) repeat scroll 0 0;
		background: -webkit-linear-gradient(top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.7) 100%);
	}

	#nav {
		background: rgba(0, 0, 0, 0) -moz-linear-gradient(center top , rgba(0,0,0, 0.7) 0%, rgba(0, 0, 0, 0.7) 100%) repeat scroll 0 0;
		background: -webkit-linear-gradient(top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.7) 100%);
	}

	#backtoblog {
		background: rgba(0, 0, 0, 0) -moz-linear-gradient(center top , rgba(0,0,0, 0.7) 0%, rgba(0, 0, 0, 0.7) 100%) repeat scroll 0 0;
		background: -webkit-linear-gradient(top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.7) 100%);
	}

	.login #backtoblog a, .login #nav a, .login a {
		color: rgba(255, 255, 255, 1) !important;
		line-height:40px;
	}
	.login #backtoblog a:hover, .login #nav a:hover, .login a:hover {
		color: rgba(255, 255, 255, 1) !important;
	}
	.login #backtoblog a:active, .login #nav a:active, .login a:active {
		color: rgba(255, 255, 255, 1) !important;
	}
	.login, .login form label, .login form, .login #login_error, .login .message {
		color: rgba(255, 255, 255, 1) !important;
	}
	.login.wp-core-ui .button-primary {
		background-color: rgba(244, 82, 70, 1);
		border:none;
		background: rgba(244, 82, 70, 1);
		text-shadow:none;
		box-shadow:none;
	}
	.login.wp-core-ui .button-primary:hover, .login.wp-core-ui .button-primary:focus {
		background-color: rgba(24, 179, 220, 1);
		border:none;
	}
	.login.wp-core-ui .button-primary {
		color: rgba(255, 255, 255, 1);
		border:none;
	}
	.login form .input, .login form input[type="checkbox"], .login input[type="text"] {
		background-color: transparent !important;
	}
	.login form .input:hover, .login form input[type="checkbox"]:hover, .login input[type="text"]:hover, .login form .input:focus, .login form input[type="checkbox"]:focus, .login input[type="text"]:focus {
		background-color: transparent !important;
	}
	.login form .input, .login form input[type="checkbox"], .login input[type="text"] {
		color: rgba(245, 245, 245, 1);
		background-color: transparent !important;
	}
	.login.wp-core-ui input[type="checkbox"]:checked::before {
		color: rgba(245, 245, 245, 1);
	}
	.login form .input, .login input[type="text"] {
		border-bottom-color: rgba(139, 140, 145, 1);
		border-top: none;
		border-left: none;
		border-right:none;
	}

	#pass1-text {background-color:transparent; }

	.login form input[type="checkbox"] {
		border-color: rgba(139, 140, 145, 1);
	}
	.login label[for="user_login"]::before, .login label[for="user_pass"]::before, .login label[for="user_email"]::before {
		color: rgba(139, 140, 145, 1);
	}
	input[type="checkbox"], input[type="color"], input[type="date"], input[type="datetime-local"], input[type="datetime"], input[type="email"], input[type="month"], input[type="number"], input[type="password"], input[type="radio"], input[type="search"], input[type="tel"], input[type="text"], input[type="time"], input[type="url"], input[type="week"], select, textarea {
		background-color: transparent;
	}
	input[type="checkbox"], input[type="color"], input[type="date"], input[type="datetime-local"], input[type="datetime"], input[type="email"], input[type="month"], input[type="number"], input[type="password"], input[type="radio"], input[type="search"], input[type="tel"], input[type="text"], input[type="time"], input[type="url"], input[type="week"], select, textarea {
		color: rgba(245, 245, 245, 1);
	}
	.login #login_error, .login .message {
		background: rgba(0, 0, 0, 0) -moz-linear-gradient(center top , rgba(0,0,0, 0.7) 0%, rgba(0, 0, 0, 0.7) 100%) repeat scroll 0 0;
		background: -webkit-linear-gradient(top, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.7) 100%);

	}

	.acf-field .acf-label label {
		font-size: inherit !important;
	}		
	


	#login{
		margin: initial !important;
		margin-left: 5% !important;
		width: 375px !important;
		margin-right: 200px !important;
		max-width: 40% !important;
	}
	#loginform{
		background: initial;
		padding: initial !important;
		overflow: initial !important;
	}
	#loginform input {
		box-shadow: 0px 0px 18px #88888899;
	}
	.login form .input, .login input[type="text"]{
		border-bottom: initial !important;
		background-color: #fff !important;
	}
	.login form .input, .login input[type=password], .login input[type=text]{
		min-height: 55px !important;
		border-radius: 30px;
		color: #000;
		padding-left: 25px !important;
		font-size: 20px;
	}
	#loginform .submit{
		display: flex;
		margin-top: 30px !important;
		align-items: center;
		justify-content: center;
	}
	#loginform .submit input{
		background-color: rgb(143 23 54);
		font-size: 18px;
		border-radius: 35px;
		padding: 0 32px !important;
		font-weight: bold;
	}
	#nav{
		background: initial;
		background-color: #8f1736;
	}
	.login form .input, .login input[type=password], .login input[type=text]{
		font-size: 18px !important;
	}
	.login .button.wp-hide-pw{
		padding: initial !important;
		top: 12% !important;
	}
	.login, .login form label, .login form, .login #login_error, .login .message{
		color: #8f1736 !important;
		font-weight: bold;
		margin-bottom: 15px;		
	}
	.login form {
		border: initial !important;
	}

	#login{
		padding-top: initial;
		margin-top: initial;
		margin-bottom: initial;

	}

	.login-action-login{
		display: flex;
		flex-direction: column;
		justify-content: center;
	}
	#login_image{
		width: 100% !important;
		max-width: 60% !important;
		height: 100%;
	}
	#login-message{
		background: #a71923 !important;
		color: #fff !important;
	}
	#nav, #backtoblog{
		display: none;
	}
	.login_buyuk_yazi{
		position: absolute;
		right: 13%;
		font-size: 4rem;
		color: #da9a1d;
		font-weight: bold;
		text-align: center;
	}
	.secili_site{
		margin-left: 9% !important; font-size: 25px; font-weight: bold; color: #da9a1d;
	}

	@media only screen and (max-width: 600px) {
		
		.login {
			background-size: cover;
		}
		#login{
			margin: auto !important;
			width: 100% !important;
			max-width: 85% !important;
			background-color: #ffffffc2;
			padding: 20px !important;
			border-radius: 20px;
		}
		.login_buyuk_yazi{
			position: absolute;
			right: 27%;
			top: 12%;
			font-size: 2rem;
			color: #da9a1d;
			font-weight: bold;
			text-align: center;
		}
		.secili_site{
			margin-left: 23% !important;
			font-size: 20px !important;
			font-weight: bold !important;
			color: #da9a1d !important;
			margin-top: 20px !important;
		}
	}
</style>

<div class="login_buyuk_yazi">
	Aljazari <br>
	GradeBook
</div>

<div class="secili_site">
	<?php 
	global $blog_id;
	$current_blog_details = get_blog_details( array( 'blog_id' => $blog_id ) );
	echo $current_blog_details->blogname;
	?>
</div>
