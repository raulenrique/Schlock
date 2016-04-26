<?php

namespace App\Views;

class SuggesterEmailView extends EmailView
{
	
	public function render() 
	{
		$this->sendEmail("templates/suggesteremail.inc.php");
		
	}
	
}
