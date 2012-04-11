<?php

$this->require_admin ();

$page->layout = 'admin';
$page->title = 'Docusaur';

$pages = Docusaur::query ()
	->order ('class', 'asc')
	->order ('name', 'asc')
	->fetch_orig ();

echo $tpl->render ('docusaur/admin', array (
	'version' => isset ($_GET['version']) ? $_GET['version'] : $appconf['Docusaur']['default_version'],
	'versions' => $appconf['Docusaur']['versions'],
	'pages' => $pages
));

?>