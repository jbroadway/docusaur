<?php

$this->require_admin ();
$page->layout = 'admin';
$page->title = i18n_get ('Add Page');

require_once ('apps/docusaur/lib/Functions.php');

docusaur_versions ($appconf['Docusaur']['versions']);
docusaur_version ($_GET['version']);

$form = new Form ('post', $this);

echo $form->handle (function ($form) {
	unset ($_POST['_token_']);
	$doc = new Docusaur ($_POST);
	$doc->put ();
	Versions::add ($doc);
	if (! $doc->error) {
		$form->controller->add_notification (i18n_get ('Page created.'));
		$form->controller->redirect ('/docusaur/admin?version=' . $_GET['version']);
	}
	$page->title = i18n_get ('An Error Occurred');
	echo i18n_get ('Error Message') . ': ' . $doc->error;
});

?>