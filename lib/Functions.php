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

?>