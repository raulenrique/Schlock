	<nav>
		  <ul class="pagination">

		  	<?php  //previous ?>
		  	<?php if($pageNumber > 1): ?>
		    	<li><a href="<?= $url ?>&amp;p=<?= $previousPage ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
		    <?php else: ?>
		    	<li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
		    <?php endif; ?>

		    <?php //first ?>
		    	<li<?php if($pageNumber == 1): ?> class="active" <?php endif; ?>><a href="<?= $url?>&amp;p=1">1
		    <?php if($pageNumber == 1): ?>
		     <span class="sr-only">(current)</span>
		    <?php endif; ?></a></li>

		    <?php //links ?>
		    <?php for ($i=$low; $i<=$high; $i++): ?> 
		    	<li<?php if($pageNumber == $i): ?> class="active" <?php endif; ?>>
		    		<a href="<?= $url?>&amp;p=<?= $i?>">
		    			<?= $i; ?>
		    			<?php if($pageNumber == $i):?>
		    		     <span class="sr-only">(current)</span>
		    			<?php endif; ?></a></li>
		    <?php endfor; ?>

		    <?php //last ?>
		    <?php if($totalPages > 1) :?>
		    	<li<?php if($pageNumber == $totalPages): ?> class="active" <?php endif; ?>>
		    		<a href="<?= $url?>&amp;p=<?= $totalPages?>">
		    			<?= $totalPages; ?>
		    			<?php if($pageNumber == $totalPages):?>
		    		     <span class="sr-only">(current)</span>
		    			<?php endif; ?></a></li>
		    <?php endif; ?>

		    <?php //next ?>
		    <?php if($pageNumber < $totalPages): ?>
		    	<li><a href="<?= $url?>&amp;p=<?= $nextPage ?>" 
		    		aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
		    <?php else : ?>
		    	<li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
		    <?php endif; ?>
		    			
		  </ul>
		</nav>