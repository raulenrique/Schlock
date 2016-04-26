<?php

namespace App\Views;

use Mailgun\Mailgun;

abstract class EmailView extends View
{
	public function sendEmail($templateFile)
	{
		extract($this->data);
		# Instantiate the client.
		$mgClient = new Mailgun('key-32d563349310ff041b03b4015120d421');
		$domain = "sandbox528ac6793aa4452db9f48a0ed1ceb297.mailgun.org";

		ob_start();

		include $templateFile;

		$emailBody = ob_get_clean();

		# Make the call to the client.
		$result = $mgClient->sendMessage($domain, array(
		    'from'    => $emailHeader['from'],
		    'to'      => $emailHeader['to'],
		    'subject' => $emailHeader['subject'],
		    'text'    => $emailBody
		));
	}
}

