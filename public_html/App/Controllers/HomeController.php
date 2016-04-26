<?php

namespace App\Controllers;

use App\Views\HomeView;

class HomeController extends Controller
{
	public function show()
	{
		$moviesuggest = $this->getMovieSuggestFormData();

		$view = new HomeView($moviesuggest);
		$view->render();
	}
	public function getMovieSuggestFormData()
	{
		if(isset($_SESSION['moviesuggest'])){
			$moviesuggest = $_SESSION['moviesuggest'];
		} else {
			$moviesuggest = [
				'title' => "",
				'email' => "",
				'newsletter' => "",
				'errors' => [
					'title' =>"",
					'email' =>"",
					'newsletter' =>""
				]
			];
		}
		return $moviesuggest;
	}
}