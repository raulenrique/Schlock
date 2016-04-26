<?php

namespace App\Controllers;

use App\Views\AboutView;

class AboutController extends Controller
{
	public function show()
	{
		$view = new AboutView();
		$view->render();
	}
}