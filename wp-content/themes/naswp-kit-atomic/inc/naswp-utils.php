<?php

//obecná funkce pro zjištění jazyka z url pro použití i v jiných částech wp

function naswp_is_lang($lang)
{

	$path_parts = explode('/', $_SERVER['REQUEST_URI']);

	if (isset($path_parts[1]) && $path_parts[1] === $lang) {
		return true;
	}

	return false;
}

