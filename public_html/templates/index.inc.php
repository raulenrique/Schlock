        <div class="row">
        <div class="col-xs-12">
          <h1>Schlocktoberfest <small> The best worst movie film festival</small></h1>   
        </div>
      </div>

      <div class="row">
        <div class="col-sm-6">
          <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. </p>
          <p><?php echo date('r');?></p>
          <button type="button" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-film" aria-hidden="true"></span> Film Programme</button>
          <button type="button" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> Book Tickets (Coming Soon!)</button>
        </div>
        <div class="col-sm-6">
          <img class="img-responsive" src="https://placekitten.com/700/400" alt="Responsive kitten image">
        </div>        
      </div>

      <div class="row">
          <div class="col-sm-4">
            <h3 class="text-center">Best Worst Movie(2009)</h3>
            <p>This documentry reviews the making of film "Troll 2" from the perspective of its former child actor star, Michael </p>          
          </div>
          <div class="col-sm-4">
           
              <form id="moviesuggest" action=".\?page=moviesuggest" method="POST" class="form-horizontal">
               <h3 class="text-center">Suggest a movie</h3>

                <div class="form-group <?php if($errors['title']): ?> has-error <?php endif; ?>">
                
                    <label for="movietitle" class="col-sm-4 control-label">Movie Title</label>
                    <div class="col-sm-8">
                      <input class="form-control" id="movietitle" name="title" placeholder="Troll2 (1990)"
                      value="<?php echo $title; ?>">
                      <div class="help-block"><?php echo $errors['title']; ?></div>

                    </div>
                  </div>
                  <div class="form-group <?php if($errors['email']): ?> has-error <?php endif; ?>">
                    <label for="email" class="col-sm-4 control-label">Email </label>
                    <div class="col-sm-8">
                      <input type="email" class="form-control" id="email" name="email" placeholder="example@mail.com"
                      value="<?php echo $email; ?>">
                      <div class="help-block"><?php echo $errors['email']; ?></div>
                    </div>
                  </div>
                      
                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-8">
                      <div class="checkbox">
                        <label>
                          <input id="newsletter" name="newsletter" type="checkbox" 
                          <?php if($newsletter): ?>
                            checked
                          <?php endif; ?> value="yes"> Sign Up for Schlocktoberfest Newsletter <small> Once a month!</small>
                        </label>
                      </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-8">
                      <div class="g-recaptcha" data-sitekey="6LcckxgTAAAAABhuIl_ijLmCYU4oSlpOsJBGPHYD">
                      </div>
                      <?php if (isset($_POST['suggest_movie'])) {

                        $url = 'https://www.google.com/recaptcha/api/siteverify';
                        $privatekey = "6LcckxgTAAAAAI-JTkDd6AxEkLzK79X_jDAhzACG";

                        $response = file_get_contents($url."?secret=".$privatekey."&response=".$_POST['g-recaptcha-response']."&remoteip=".$_SERVER['REMOTE_ADDR']);
                        $data = json_decode($response);

                        if (isset($data->success) AND $data->success===true) {

                          header('Location: index.inc.php?CaptchaFail=True');
                         
                        }else{ 

                         header('Location: index.inc.php?CaptchaFail=Fail');
                        }

                        
                      }?>
                    </div>
                  </div>

                <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-8">
                    <button class="btn btn-primary" id="suggest_movie">Suggest Movie</button>
                  </div>
                </div>
              </form>         
          </div>
          <div class="col-sm-4">
            <h3 class="text-center">Our Sponsors</h3>
            <p>Lorem ipsum dolor sit amet, excepteur sint occaecat cupidatat non
            proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>            
          </div>      
      </div>


      