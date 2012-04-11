<?php

$this->require_admin ();
$page->layout = 'admin';

$doc = new Docusaur ($_GET['id']);
if ($doc->error) {
	$this->redirect ('/docusaur/admin');
}

$page->title = i18n_get ('Edit Page') . ': ' . $doc->class;
if (! empty ($doc->name)) {
	$page->title .= ' - ' . $doc->name;
}

require_once ('apps/docusaur/lib/Functions.php');

docusaur_versions ($appconf['Docusaur']['versions']);
docusaur_version ($doc->version);

$form = new Form ('post', $this);
$form->data = $doc->orig ();

echo $form->handle (function ($form) {
	unset ($_POST['_token_']);
	$doc = new Docusaur ($_GET['id']);
	foreach ($_POST as $key => $value) {
		$doc->{$key} = $value;
	}
	$doc->put ();
	Versions::add ($doc);
	if (! $doc->error) {
		$form->controller->add_notification (i18n_get ('Page saved.'));
		$form->controller->redirect ('/docusaur/admin?version=' . $doc->version);
	}
	$page->title = i18n_get ('An Error Occurred');
	echo i18n_get ('Error Message') . ': ' . $doc->error;
});

?>