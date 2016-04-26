<?php

namespace App\Views;

class MovieSuggestSuccessView extends TemplateView
{

  public function render()
  {
      $page = "moviesuggestsuccess";
      $page_title = "Thanks for the suggestion!";
      include "templates/master.inc.php";
  }

  protected function content()
  {
      include "templates/moviesuggestsuccess.inc.php";
  }
}