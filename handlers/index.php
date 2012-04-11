<?php

/**
 * Displays documentation for a specific method or class,
 * or searches for one if acting as an error handler
 * (for search).
 */

if ($appconf['Docusaur']['layout'] !== 'default') {
	$page->layout = $appconf['Docusaur']['layout'];
}

$page->title = i18n_getf ('% Documentation', $appconf['Docusaur']['app_name']);

echo $tpl->render ('docusaur/index', array ());

?>