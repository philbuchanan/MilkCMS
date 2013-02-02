<?php include('includes/header.php'); ?>

<div class="container login-container">

	<div class="login-box">
	
		<h2>Log In</h2>
		
		<form class="login<?php if (isset($login) && $login === false) echo ' login-error'; ?>" action="<?php c::get('home'); ?>" method="post">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" <?php if (isset($_POST['username'])) echo 'value="' . $_POST['username'] . '"'; ?> />
			<label for="password">Password</label>
			<input type="password" name="password" id="password" />
			<input type="submit" name="login" value="Log In" />
			<label for="remember" class="remember"><input name="remember" type="checkbox" id="remember" <?php if (isset($_POST['remember'])) echo 'checked'; ?>>Remember Me</label>
		</form>
		
		<?php if (isset($login) && $login === false) { ?>
			<p class="message error">The username or password was incorrect.</p>
		<?php } ?>
	
	</div>
	
</div>

<?php include('includes/footer.php'); ?>