<?php

/**
 * Displays documentation for a specific method or class,
 * or searches for one if acting as an error handler
 * (for search).
 */

if ($appconf['Docusaur']['layout'] !== 'default') {
	$page->layout = $appconf['Docusaur']['layout'];
}

$this->params = explode ('/', ltrim ($_SERVER['REQUEST_URI'], '/'));

if (count ($this->params) === 3) {
	// /version/class/method
	$doc = Docusaur::query ()
		->where ('version', $this->params[0])
		->where ('class', $this->params[1])
		->where ('name', $this->params[2])
		->single ();

	echo $tpl->render ('docusaur/index', $doc);
	info ($doc, true);
} elseif (count ($this->params) === 2) {
	// /version/class
	$doc = Docusaur::query ()
		->where ('version', $this->params[0])
		->where ('class', $this->params[1])
		->single ();

	echo $tpl->render ('docusaur/index', $doc);
	info ($doc, true);
} elseif (count ($this->params) === 1) {
	if (in_array ($this->params[0], $appconf['Docusaur']['versions'])) {
		// /version
		$page->title = i18n_getf ('%s Documentation', $appconf['Docusaur']['app_name']);
		echo $this->run ('docusaur/nav', array ('version' => $this->param[0]));
		return;
	}

	// search
	$parts = preg_split ('/(->|::)/', $this->params[0]);
	if (count ($parts) === 2) {
		// direct match
		$doc = Docusaur::query ()
			->where ('version', $appconf['Docusaur']['default_version'])
			->where ('class', $parts[0])
			->where ('name', $parts[1])
			->single ();

		if ($doc) {
			$this->redirect (sprintf (
				'/%s/%s/%s',
				$appconf['Docusaur']['default_version'],
				$parts[0],
				$parts[1]
			));
		}

		// search results
		$docs = Docusaur::query ()
			->where ('class like ?', $parts[0] . '%')
			->where ('name like ?', $parts[1] . '%')
			->fetch_orig ();
	} else {
		// direct match
		$doc = Docusaur::query ()
			->where ('version', $appconf['Docusaur']['default_version'])
			->where ('class', $parts[0])
			->where ('name = ""')
			->single ();

		if ($doc) {
			$this->redirect (sprintf (
				'/%s/%s',
				$appconf['Docusaur']['default_version'],
				$parts[0]
			));
		}

		// search results
		$docs = Docusaur::query ()
			->where ('class like ?', $parts[0] . '%')
			->or_where ('name like ?', $parts[0] . '%')
			->fetch_orig ();
	}
	info ($docs, true);
} else {
	// /docusaur or equivalent (embedded into page)
	$page->title = i18n_getf ('%s Documentation', $appconf['Docusaur']['app_name']);
	echo $this->run ('docusaur/nav', array ('version' => $appconf['Docusaur']['default_version']));
}

?>