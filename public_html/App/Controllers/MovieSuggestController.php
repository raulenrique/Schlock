<?php

namespace App\Controllers;

use App\Views\SuggesterEmailView;
use App\Views\HostEmailView;
use App\Views\MovieSuggestSuccessView;

class MovieSuggestController extends Controller
{
	private $moviesuggest = [];
	
	public function __construct()
	{
		$this->moviesuggest = [
						'errors' => []
						];
	}
	public function resetSessionData()
	{
		$_SESSION['suggestmovieerror'] = NULL;
		$_SESSION['moviesuggest'] = NULL;
		
	}
	public function getFormData() 
	{
		$expectedVariables = ['title', 'email', 'newsletter'];

		foreach ($expectedVariables as $variable) {

			// assume no errors
			$this->moviesuggest['errors'][$variable]="";

			if(isset($_POST[$variable])){
				$this->moviesuggest[$variable] = $_POST[$variable];
			}else {
				$this->moviesuggest[$variable] = "";
			}
		}

	}
	public function isFormValid()
	{
		//validating form
		$valid = true;

		if(strlen($this->moviesuggest['title']) == 0) {
			$this->moviesuggest['errors']['title']= "Enter a movie title";
			$valid = false;
		}

		if(! filter_var($this->moviesuggest['email'], FILTER_VALIDATE_EMAIL)){
			$this->moviesuggest['errors']['email']="Enter a valid email address";
			$valid = false;
		}
		return $valid;
	}

	public function show()
	{
		$this->resetSessionData();

		//capture suggester data
		$this->getFormData();

		//validate form data
		if(! $this->isFormValid()){
			$_SESSION['moviesuggest'] = $this->moviesuggest;
			header("Location:./#moviesuggest");
			return;
		}

		//once  form is validated, get to thanks page
		$view = new MovieSuggestSuccessView();
		$view->render();

		//send email to the suggester
		$suggesterEmail = new SuggesterEmailView($this->moviesuggest);
		$suggesterEmail->render();

		//send email to the host
		$hostEmail = new HostEmailView($this->moviesuggest);
		$hostEmail->render();


	}
}