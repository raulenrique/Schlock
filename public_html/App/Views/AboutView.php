<?php

namespace App\Views;


class AboutView extends TemplateView
{
	public function render() {
		
		$page = "about";
		$page_title = "About the Festival";
		include "templates/master.inc.php";
	}
	protected function content() {
		
		include "templates/about.inc.php";
	}
}