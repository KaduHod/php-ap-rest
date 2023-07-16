<?php 
namespace Utils;

function getStrAfterBackSlash(string $str){
    return end(explode('\\', $str));
}

function addNumberRegex(string $input): string {
    $pattern = str_replace('/:num', '\/(\d+)', $input);
    return '/^' . $pattern . '$/';
}

function makeRegexRoute(string $route) {
    $escapedString = preg_quote($route, '/');
    return "/^$escapedString$/";
}

function hasNumParam(string $route) {
    return strstr($route, "/:num") == true;
}

function match_(string $str, string $pattern) {
    return preg_match($pattern, $str);
}

function extractParam(string $str, string $pattern) {    
  	$matches = []; 
	$pattern = $newPatt = str_replace("^", "^\/", $pattern);
	if (preg_match($pattern, $str,$matches)) {
        	return $matches[1];
    	}
    	return false;
}
