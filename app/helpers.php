<?php

function addItemToArray($array)
{
    //$array = array_values($array);
    $names = array();
    foreach ($array as $item){
        $names[] = $item['slug'];
    }
    return $names;
}
