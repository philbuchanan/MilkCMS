<?php 

class app {

	static public function initiate() {
		
		if (!session::isLoggedIn()) {
		
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
			
		}
		
		# Check login state
		if (session::isLoggedIn()) {
		
			# Check for loggout link
			if (isset($_GET['action'])) action::doAction($_GET['action']);
			
			# Cehck for file upload
			if (isset($_POST['upload'])) action::doAction('upload');
			
			# Check for messages
			if (isset($_GET['m'])) $status = messages::getMessage($_GET['m']);
			
			$url = str_replace(c::get('rewritebase'), '', $_SERVER['REQUEST_URI']);
			$urlstring = explode('?', $url);
			
			if ($urlstring[0] == 'articles') {
				
				# Load articles page
				$files = files::listDir();
				require_once(c::get('root.site') . '/templates/articles.php');
			
			}
			else {
				
				# Load admin panel
				require_once(c::get('root.site') . '/templates/index.php');
			
			}
		
		}
		else {
		
			# If not logged in, load login screen
			require_once(c::get('root.site') . '/templates/login.php');
		
		}
	
	}

}

?>