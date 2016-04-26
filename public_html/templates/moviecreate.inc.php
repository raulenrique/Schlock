  <?php  
     $errors = $movie->errors; 
     $verb = ( $movie->id ? "Edit" : "Add");
     if($movie->id){
      $submitAction = ".\?page=movie.update";
     } else {
      $submitAction = ".\?page=movie.store";
     }
    ?>
    <div class="row">
          <div class="col-xs-12">  
              <form id="moviecreate" action="<?= $submitAction; ?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
              <?php if($movie->id): ?>
                 <input type="hidden" name='id' value="<?= $movie->id?>">
              <?php endif; ?>
               <h3><?= $verb; ?> Movie</h3>

                <div class="form-group <?php if($errors['title']): ?> has-error <?php endif; ?>">
                    <label for="title" class="col-sm-4 col-md-2 control-label">Movie Title</label>
                    <div class="col-sm-8 col-md-10">
                      <input class="form-control" id="title" name="title" placeholder="Troll2"
                      value="<?php echo $movie->title; ?>">
                      <div class="help-block"><?php echo $errors['title']; ?></div>
                    </div>
                </div>

                <div class="form-group <?php if($errors['year']): ?> has-error <?php endif; ?>">
                  <label for="year" class="col-sm-4 col-md-2 control-label">Release Year </label>
                  <div class="col-sm-8 col-md-10">
                    <input type="year" class="form-control" id="year" name="year" placeholder="1990"
                    value="<?php echo $movie->year; ?>">
                    <div class="help-block"><?php echo $errors['year']; ?></div>
                  </div>
                </div>
                
                <div class="form-group <?php if($errors['description']): ?> has-error <?php endif; ?>">
                  <label for="description" class="col-sm-4 col-md-2 control-label">Description </label>
                  <div class="col-sm-8 col-md-10">
                    <textarea class="form-control" id="description" name="description" rows="5" placeholder="A paragraph about the movie."><?php echo $movie->description; ?></textarea>
                    <div class="help-block"><?php echo $errors['description']; ?></div>
                  </div>
                </div> 

                <div class="form-group <?php if($errors['poster']): ?> has-error <?php endif; ?>">
                  <label for="poster" class="col-sm-4 col-md-2 control-label">Poster Image </label>
                  <div class="col-sm-5 col-md-5">
                    <input type="file" class="form-control" id="poster" name="poster">
                  </div>
                  <?php if($movie->poster != ""): ?>
                    <div class="col-sm-1 col-md-1">
                      <img src="./images/poster/100h/<?= $movie->poster ?>" alt="image">
                    </div>
                    <div class="col-sm-2 col-md-2">
                      <div class="checkbox">
                        <label><input type="checkbox" name="removeImage" value="true">Remove Image</label>
                      </div>
                    </div>

                  <?php else: ?>
                    <div class="col-sm-2 col-md-2">
                      <p><small>No poster found for this movie</small></p>
                    </div>

                  <?php endif; ?>
                </div>

                <div class="form-group <?php if($errors['tags']): ?> has-error <?php endif; ?>">
                  <label for="tags" class="col-sm-4 col-md-2 control-label">Tags </label>
                  <div class="col-sm-8 col-md-10">
                    <div id="tags" class="form-control">
                      <script type="text/javascript">
                       var inputTags = "<?= $movie->tags; ?>";
                       </script>
                     </div>
                   </div>
                </div> 

                <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
                    <button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> <?= $verb; ?> Movie</button>
                  </div>
                </div>
              </form> 
              <?php if($movie->id): ?>
              <form action=".\?page=movie.destroy" method="POST" class="form-horizontal">
                <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
                    <input type="hidden" name='id' value="<?= $movie->id?>">
                    <button class="btn btn-danger"><span class="glyphicon glyphicon-trash"></span> Delete Movie</button>
                  </div>
                </div>
              </form> 
              <?php endif; ?>       
          </div>