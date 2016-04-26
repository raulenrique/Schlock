<?php

namespace App\Controllers;

use App\Models\Comment;
use App\Models\Movies;
use App\Views\MoviesView;
use App\Views\SingleMovieView;
use App\Views\MovieCreateView;

class MoviesController extends Controller
{
	public function index()
	{
		$pageNumber= isset($_GET['p']) ? $_GET['p'] : 1;
		$pageSize = 15;
		$recordCount = Movies::count();

		$movies = Movies::all("title", true, $pageNumber, $pageSize);
		$view = new MoviesView(compact('movies', 'pageNumber', 'pageSize', 'recordCount'));
		$view->render();
	}
	public function show()
	{
		$movie = new Movies((int)$_GET['id']);
		$newcomment = $this->getCommentFormData();
		$comments = $movie->comments();
		$tags = $movie->getTags();

		$view = new SingleMovieView(compact('movie', 'newcomment', 'comments','tags'));
		$view->render();
	}
	public function create()
	{
		static::$auth->mustBeAdmin();

		$movie = $this->getFormData();
		$view = new MovieCreateView(['movie' => $movie]);
		$view->render();
	}
	public function store()
	{
		static::$auth->mustBeAdmin();

		$movie = new Movies($_POST);

		if(is_array($movie->tags)){
			$movie->tags = implode(",", $movie->tags);
		}
		if(! $movie->isValid()){
			$_SESSION['movie.create'] = $movie;
			header("Location: .\?page=movie.create");
			exit();
		}

		if($_FILES['poster']['error'] === UPLOAD_ERR_OK){
			$movie->savePoster($_FILES['poster']['tmp_name']);
		}

		$movie->save();
		$movie->saveTags();
		header("Location: .\?page=movie&id=" . $movie->id);
	}
	public function edit()
	{
		static::$auth->mustBeAdmin();

		$movie = $this->getFormData($_GET['id']);
		$movie->loadTags();

		$view = new MovieCreateView(compact('movie','tags'));
		$view->render();
	}
	public function update()
	{
		static::$auth->mustBeAdmin();

		$movie = new Movies($_POST['id']);
		$movie->processArray($_POST);

		if(is_array($movie->tags)){
			$movie->tags = implode(",", $movie->tags);
		}
		
		if(! $movie->isValid()){
			$_SESSION['movie.create'] = $movie;
			header("Location: .\?page=movie.edit&id=".$_POST['id']);
			exit();
		}

		if($_FILES['poster']['error'] === UPLOAD_ERR_OK){
			$movie->savePoster($_FILES['poster']['tmp_name']);
		} else if(isset($_POST['removeImage']) && $_POST['removeImage'] === "true") {
			$movie->poster = null;
		}


		$movie->save();
		$movie->saveTags();
		header("Location: .\?page=movie&id=" . $movie->id);
	}
	public function destroy()
	{
		static::$auth->mustBeAdmin();
		
		Movies::destroy($_POST['id']);
		header("Location: .\?page=movies");
	}
	public function getFormData($id = null){
		if(isset($_SESSION['movie.create'])){
			$movie = $_SESSION['movie.create'];
			unset($_SESSION['movie.create']);
		} else {
			$movie = new Movies((int)$id);
		}
		return $movie;
	}
	public function getCommentFormData($id = null){
		if(isset($_SESSION['comment.form'])){
			$newcomment = $_SESSION['comment.form'];
			unset($_SESSION['comment.form']);
		} else {
			$newcomment = new Comment((int)$id);
		}
		return $newcomment;
	}
}


















