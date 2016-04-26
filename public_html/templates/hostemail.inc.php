<?php

$emailHeader = [
	'from' => 'Schlocktoberfest < mailgun@' .$domain. '>',
	'to' => '<assin.testmail@gmail.com>',
	'subject' => 'Movie Suggestion '.$title
	];
?>

Hi Schlockpickers,

A kind suggestion that we show "<?php echo $title; ?>" at Schlocktoberfest has just been suggested by 
<?=$email; ?>. See if the suggestion could be included in the schedule in coming months.

<?php 
if($newsletter): ?>
Yay!!!They have also signed up for our newsletter! 
<?php endif; ?>


Your benevolent Overlord Robots!