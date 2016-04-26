<?php

namespace App\Controllers;
use App\Models\Movies;
use App\Views\SearchResultsView;

class SearchController extends Controller
{
	function search() 
	{
		if(! isset($_GET['q'])){
			$q = "";
		} else {
			$q = $_GET['q'];
		}
		$movies = Movies::search($q);

		$view = new SearchResultsView(compact('movies', 'q'));
		$view->render();
	}
}