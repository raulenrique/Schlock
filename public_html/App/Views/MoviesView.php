<?php

namespace App\Views;

class MoviesView extends TemplateView
{
	
	public function render() 
	{
		extract($this->data);
		$page = "movies";
		$page_title = "Movies";
		include "templates/master.inc.php";
	}
	protected function content()
	{
		extract($this->data);
		include "templates/movies.inc.php";
	}
	public function paginate($url, $pageNumber, $pageSize, $recordCount)
	{
		$totalPages = ceil($recordCount/$pageSize);
		$previousPage = $pageNumber - 1;
		$nextPage = $pageNumber + 1;

		$maxLinks = 5;

		//calculating the range of links
		$low = $pageNumber - floor($maxLinks / 2);
		if ($low < 2) {
			$low = 2;
		}
		$high = $pageNumber + floor($maxLinks / 2);
		if ($high > $totalPages - 1) {
			$high = $totalPages -  1;
		}
		// if low or high limit is hit, then adjust the links to suit them

		if($low == 2){ $high = $maxLinks;}
		if($high == $totalPages - 1){ $low = $totalPages - $maxLinks + 1 ;}

		if ($low < 2) { $low = 2; }
		if ($high > $totalPages - 1) { $high = $totalPages - 1; }

		include "templates/paginate.inc.php";
	}
}