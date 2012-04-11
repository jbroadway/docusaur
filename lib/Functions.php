<?php

function docusaur_versions ($versions = null) {
	static $_versions = null;
	if ($versions !== null) {
		$_versions = $versions;
	}
	return $_versions;
}

function docusaur_version ($version = null) {
	static $_version = null;
	if ($version !== null) {
		$_version = $version;
	}
	return $_version;
}

function docusaur_parse_links ($body) {
	return preg_replace (
		'/\[\[(.+?)\]\]/e',
		'\'<a href="/\\1">\\1</a>\'',
		$body
	);
}

function docusaur_markdown ($body) {
	require_once ('apps/docusaur/lib/markdown.php');
	return docusaur_parse_links (Markdown ($body));
}

?>