<?php 

class app {

	static public function initiate() {
		
		# Auto login if password remembered
		if (cookie::get('username') && cookie::get('password')) {
			
			$login = users::login(cookie::get('username'), cookie::get('password'));
			
			if ($login) session::validateUser($login);
			
		}
		
		# Login form submission
		if (isset($_POST['login'])) {
			
			$login = users::login($_POST['username'], $_POST['password']);
			
			if ($login) {
				
				# Set session variables
				session::validateUser($login);
				
				# If remember checked
				if (isset($_POST['remember'])) {
					
					cookie::set('username', $_POST['username']);
					cookie::set('password', $_POST['password']);
				
				}
				
			}
		
		}
		
		# Check login state
		if (session::isLoggedIn()) {
			
			# Check for loggout link
			if (isset($_GET['logout'])) {
			
				session::logout();
				header('Location: ' . c::get('home'));
				
			}
			
			# Load admin panel
			require_once(c::get('root.site') . '/templates/index.php');
		
		}
		else {
		
			# If not logged in, load login screen
			require_once(c::get('root.site') . '/templates/login.php');
		
		}
	
	}

}

?>