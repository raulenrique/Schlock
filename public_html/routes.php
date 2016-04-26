<?php

namespace App\Controllers;
use App\Models\Exceptions\ModelNotFoundException;
use App\Services\Exceptions\InsufficientPrivilegesException;

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

try {
	switch ($page) {
		case "home":

			$controller = new HomeController();
			$controller->show();

			break;
		case "register":
			
			$controller = new AuthenticationController();
			$controller->register();

			break;
		case "auth.store":
			
			$controller = new AuthenticationController();
			$controller->store();

			break;
		case "login":
			
			$controller = new AuthenticationController();
			$controller->login();

			break;
		case "auth.attempt":
			$controller = new AuthenticationController();
			$controller->attempt();
			
			break;
		case "logout":
			
			$controller = new AuthenticationController();
			$controller->logout();

			break;
		case "movies":

			$controller = new MoviesController();
			$controller->index();

			break;
		case "movie":

			$controller = new MoviesController();
			$controller->show();

			break;
		case "movie.create":

			$controller = new MoviesController();
			$controller->create();

			break;
		case "movie.store":

			$controller = new MoviesController();
			$controller->store();

			break;
		case "movie.edit":

			$controller = new MoviesController();
			$controller->edit();

			break;
		case "movie.update":

			$controller = new MoviesController();
			$controller->update();

			break;
		case "movie.destroy":

			$controller = new MoviesController();
			$controller->destroy();

			break;

		case "merchandise":

			$controller = new MerchandiseController();
			$controller->show();

		break;

		case "about":
			$controller = new AboutController();
			$controller->show();

			break;
		case "comment.create":

            $controller = new CommentController();
            $controller->create();

            break;


		case "moviesuggest":

			$controller = new MovieSuggestController();
			$controller->show();		
			
			break;
		case "search":

			$controller = new SearchController();
			$controller->search();
			break;
			
		case "downloadposter":
			$file = "./images/poster/originals/" . $_GET['filename'];
			header('Content-Type: application/octet-stream');
			header('Content-Transfer-Encoding: Binary');
			header('Content-disposition: attachment; filename="' . basename($file) . '"');
			readfile($file);
			break;
			
		default:
			throw new ModelNotFoundException();
			break;
			
	}

} catch (ModelNotFoundException $e)
{
	$controller = new ErrorController();
	$controller->error404();

} catch (InsufficientPrivilegesException $e)
{
	$controller = new ErrorController();
	$controller->error401();
}












