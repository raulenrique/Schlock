<?php

namespace App\Views;

class SingleMovieView extends TemplateView
{
	
	public function render() 
	{
		extract($this->data);
		$page = "movie";
		$page_title = $movie->title;
		include "templates/master.inc.php";
	}
	protected function content()
	{
		extract($this->data);
		include "templates/singlemovie.inc.php";
	}
}