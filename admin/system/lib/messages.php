<?php

if (!defined('ACCESS')) die('Direct access is not allowed');

class messages {

	public static function getMessage($message, $error = true, $special = null) {

		$messages = array(
		
			# Login
			'login.failed'	=> 'The username or password you entered was not correct.',
			
			# File Uploads
			'files.upload.success' => 'The file ' . $special . ' was successfully uploaded.',
			'files.upload.error'   => 'There was an error uploading the file, please try again.',
			'files.large'          => 'The file was too large.',
			'files.compatible'     => 'That file was not compatible.',
			'files.nofile'         => 'No file was selected.',
			
			# Deleting Articles
			'file.delete.success' => 'The file ' . $special . ' was successfully deleted.',
			'file.delete.error'   => 'There was an error deleting the file, please try again.',
			
			# Cache
			'cache.clear'     => 'The cache was successfully cleared.',
			'cache.error'     => 'There was an error clearing the cache.',
		
		);
		
		# Build status array
		$status = array(
			'error' => $error,
			'message' => $messages[$message],
		);
		
		return $status;
		
	}

}

?>