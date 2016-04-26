<?php

$emailHeader = [
	'from' => 'Schlocktoberfest < mailgun@' .$domain. '>',
	'to' => '<'.$email.'>',
	'subject' => 'Thanks for suggesting '.$title
	];
?>

Hi there,

Thank you for your kind suggestion that we show "<?php echo $title; ?>" at Schlocktoberfest.
We will be releasing the schedule in the coming months.

<?php 
if($newsletter): ?>
Thank you for signing up for our newsletter. You will receive your copy within a fortnight.
<?php endif; ?>


Thanks.

The Schlockpickers
Schlocktoberfest
