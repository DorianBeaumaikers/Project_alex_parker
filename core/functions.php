<?php

namespace Core\Functions;

function formatter_date(string $date, string $format = DATE_FORMAT){
    $date = new \DateTime($date);
    return $date->format($format);
}

function slugify(string $text){
    return $text = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
}

function truncate(string $text, int $numbChar = TRUNCATE_LIMIT){
    if(strlen($text) < $numbChar){
        return $text;
    }
    else{
        $wr = wordwrap($text, $numbChar, '*');
        $result = explode('*', $wr);
        return $result[0] . "...";
    }
}