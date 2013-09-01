<?php 

if (!defined('ACCESS')) die('Direct access is not allowed');

class articles {

	public static function getXArticles($number) {
	
		$max = files::countArticles();
		if ($number > $max) $number = $max;
		
		return files::getArticles(0, $number - 1);
	
	}

}

?>