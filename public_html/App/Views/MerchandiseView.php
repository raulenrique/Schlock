<?php

namespace App\Views;

class MerchandiseView extends TemplateView
{
	
	public function render() 
	{
		extract($this->data);
		$page = "merchandise";
		$page_title = "Merchandise";
		include "templates/master.inc.php";
	}
	protected function content()
	{
		extract($this->data);
		include "templates/merchandise.inc.php";
	}
}