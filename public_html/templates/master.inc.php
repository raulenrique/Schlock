<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Schlocktoberfest<?php if ($page_title) { echo "-" . $page_title ;} ?></title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="container">
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <!-- Brand and toggle get grouped for better mobile display -->
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="./">Schlocktoberfest</a>
          </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
          <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li<?php if ($page === "index"): ?> class="active" <?php endif ;?>><a href=".\">Home</a></li>
              <li<?php if ($page === "movies"): ?> class="active" <?php endif ;?>><a href=".\?page=movies">Movies</a></li>
              <li<?php if ($page === "merchandise"): ?> class="active" <?php endif ;?>><a href=".\?page=merchandise">Merchandise</a></li>
              <li<?php if ($page === "about"): ?> class="active" <?php endif ;?>><a href=".\?page=about">About</a></li>
              <li<?php if ($page === "contact"): ?> class="active" <?php endif ;?>><a href=".\?page=contact">Contact</a></li>              
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <?php if(! static::$auth->check()): ?>
              <li<?php if ($page === "auth.register"): ?> class="active" <?php endif ;?>><a href=".\?page=register">Register</a></li>
              <li<?php if ($page === "auth.login"): ?> class="active" <?php endif ;?>><a href=".\?page=login">Login</a></li>
            <?php else: ?>
              <li><a href="#"><?= static::$auth->user()->email; ?></a></li> 
              <li><a href=".\?page=logout">Logout</a></li>
            <?php endif; ?>
            </ul>
           
              <form method="GET" action="./" class="navbar-form pull-right" role="search">
                <div class="input-group">
                  <input type="hidden" name="page" value="search">
                  <input name="q" type="text" class="form-control" placeholder="Search...">
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-default">
                        <span class="glyphicon glyphicon-search"></span>
                      </button>
                    </div>
                </div>
              </form>
             

          </div>
        </div>
      </nav>

      <?php $this->content(); ?>

      <footer>
        <p>&copy;<?php echo date("Y");?> Schlocktoberfest Film Festival NZ</p>
      </footer>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="js/taggle.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/google_analytics.js"></script>
    <script src="js/google_charts.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>

  </body>
</html>
