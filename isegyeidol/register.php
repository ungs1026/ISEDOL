<?php
include("includes/mysqli-dbconfig.php"); // mysqli로
include("includes/classes/Account.php"); // 계정연결
include("includes/classes/Constants.php"); // 알림문구 모음

$account = new Account($con);

include("includes/handlers/register-handler.php");
include("includes/handlers/login-handler.php");

function getInputValue($name)
{
	if (isset($_POST[$name])) {
		echo $_POST[$name];
	}
}
?>

<html>

<head>
	<title>WELCOME TO ISEDOL FANSITE!</title>

	<link rel="icon" href="source/img/main-logo.png" type="image/x-icon" />
  <link rel="shortcut icon" href="source/img/main-logo.png" type="image/x-icon"/>
	
	<link rel="stylesheet" type="text/css" href="css/register.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
	<div id="background">
		<div id="loginContainer">
			<div id="inputContainer">

				<!--Check Box-->
				<h2><span>Log In </span><span>Sign Up</span></h2>
				<input class="checkbox" type="checkbox" id="reg-log" name="reg-log" />
				<label for="reg-log"></label>

				<div class="card-3d-wrap">
					<div class="card-3d-wrapper">
						<div class="card-front">
							<div class="section">

								<form id="loginForm" action="register.php" method="POST">
									<h2>Log In</h2>
									<p>
										<?php echo $account->getError(Constants::$loginFailed); ?>
										<label for="loginUsername">Username</label>
										<input id="loginUsername" name="loginUsername" type="text" placeholder="ID" value="<?php getInputValue('loginUsername') ?>" required>
									</p>

									<p>
										<label for="loginPassword">Password</label>
										<input id="loginPassword" name="loginPassword" type="password" placeholder="password" required>
									</p>

									<button class="btn" type="submit" name="loginButton">Submit</button>

									<div class="hasAccountText">
										<span id="hideLogin">Don't have an account yet? Signup here.</span>
									</div>
								</form>

							</div>
						</div>

						<div class="card-back">
							<div class="section">
								<form id="registerForm" action="register.php" method="POST">
									<h2>Create your free account</h2>
									<p>
										<?php echo $account->getError(Constants::$usernameCharacters); ?>
										<?php echo $account->getError(Constants::$usernameTaken); ?>
										<label for="username">Username</label>
										<input id="username" name="username" type="text" placeholder="ID" value="<?php getInputValue('username') ?>" required>
									</p>

									<p>
										<?php echo $account->getError(Constants::$firstNameCharacters); ?>
										<label for="firstName">First name</label>
										<input id="firstName" name="firstName" type="text" placeholder="Jau Ung" value="<?php getInputValue('firstName') ?>" required>
									</p>

									<p>
										<?php echo $account->getError(Constants::$lastNameCharacters); ?>
										<label for="lastName">Last name</label>
										<input id="lastName" name="lastName" type="text" placeholder="Seo" value="<?php getInputValue('lastName') ?>" required>
									</p>

									<p>
										<?php echo $account->getError(Constants::$emailsDoNotMatch); ?>
										<?php echo $account->getError(Constants::$emailInvalid); ?>
										<?php echo $account->getError(Constants::$emailTaken); ?>
										<label for="email">Email</label>
										<input id="email" name="email" type="email" placeholder="example@gmail.com" value="<?php getInputValue('email') ?>" required>
									</p>

									<p>
										<label for="email2">Confirm email</label>
										<input id="email2" name="email2" type="email" placeholder="example@gmail.com" value="<?php getInputValue('email2') ?>" required>
									</p>

									<p>
										<?php echo $account->getError(Constants::$passwordsDoNoMatch); ?>
										<?php echo $account->getError(Constants::$passwordNotAlphanumeric); ?>
										<?php echo $account->getError(Constants::$passwordCharacters); ?>
										<label for="password">Password</label>
										<input id="password" name="password" type="password" placeholder="password" required>
									</p>

									<p>
										<label for="password2">Confirm password</label>
										<input id="password2" name="password2" type="password" placeholder="password" required>
									</p>

									<button class="btn" type="submit" name="registerButton">SIGN UP</button>

									<div class="hasAccountText">
										<span id="hideRegister">Already have an account? Log in here.</span>
									</div>

								</form>
							</div>
						</div>
					</div>

				</div>
			</div>

		</div>
	</div>
</body>

</html>