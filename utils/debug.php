<?php 
namespace Utils ;

function dd(array $args){
    echo '<pre>';
    print_r([...$args]);
    echo '</pre>';
}

function dd_($args){
    echo '<pre>';
    print_r($args);
    echo '</pre>';
}