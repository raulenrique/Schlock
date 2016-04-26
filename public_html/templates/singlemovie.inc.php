<?php 
	$errors = $newcomment->errors;
?>
<div class="row">
	<div class="col-xs-12">
		<ol class="breadcrumb">
		  <li><a href=".\">Home</a></li>
		  <li><a href=".\?page=movies">Movies</a></li>
		  <li class="active"><?= $movie->title; ?></li>
		</ol>
				
			
		<h2><?= $movie->title; ?></h2>
		<p>Released in <?= $movie->year; ?></p>

		<?php if($movie->poster !=""):?>
			<a href="./?page=downloadposter&amp;filename=<?= $movie->poster ?>">
				<img src="./images/poster/300h/<?= $movie->poster ?>" alt="<?= $movie->title ?> image">
			</a>
		<?php else: ?>
			<p><small>No poster found</small></p>
		<?php endif; ?>

		<p><?= $movie->description; ?></p>

		<ul class="list-inline">
		<?php foreach ($tags as $tag): ?>
			<li><span class="label label-default"><?= $tag->tag; ?></span></li>
		<?php endforeach; ?>
		</ul>

		<?php if (static::$auth->isAdmin()): ?>
			<p>
				<a href=".\?page=movie.edit&amp;id=<?= $movie->id; ?>" class="btn btn-default">
				<span class="glyphicon glyphicon-pencil"></span> Edit Movie</a>
			</p>
		<?php endif; ?>

	<h3>Comments</h3>

		<?php if(count($comments) > 0) : ?>
			<?php $count = 0; ?>
			<?php foreach ($comments as $comment) : ?>
				<?php $count++; ?>
				<div class="media">
				  <div class="media-left">
				      <img class="media-object" src="<?= $comment->user()->gravatar(48, 'identicon') ; ?>" alt="avatar">
				  </div>
				  <div class="media-body">
				    <h4 class="media-heading"># <?= $count;?> <?= $comment->user()->username;?></h4>
				    <p><?= $comment->comment;?></p>
				  </div>
				</div>
				
			<?php endforeach; ?>

		<?php else: ?>
			<p>No Comments Yet......</p>
		<?php endif; ?>
          
          <h4>Add Comment to '<?= $movie->title ?>'</h4>
          <?php if (static::$auth->check()): ?>
            <form method="POST" action="./?page=comment.create" class="form-horizontal">
              
              <input type="hidden" name="movie_id" value="<?= $movie->id ?>">

              <div class="form-group <?php if ($errors['comment']): ?> has-error <?php endif; ?>">
                <label for="comment" class="col-sm-4 col-md-2 control-label">Comment</label>
                <div class="col-sm-8 col-md-10">
                  <textarea id="comment" class="form-control" name="comment" rows="5"></textarea>
                  <div class="help-block"><?= $errors['comment']; ?></div>
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
                  <button class="btn btn-success">
                    <span class="glyphicon glyphicon-ok"></span> Add Comment
                  </button>
                </div>
              </div>
            </form>
          <?php else: ?>
            <p>You need to be <a href="./?page=login">logged in</a> to add a comment.</p>
          <?php endif; ?>
		
		
	</div>
	
</div>