<?php

namespace Core\Functions;

/**
 * Return date formated with the given format
 *
 * @param string $date
 * @param string $format
 * @return string
 */
function formatter_date(string $date, string $format = DATE_FORMAT){
    $date = new \DateTime($date);
    return $date->format($format);
}

/**
 * Slugify text
 *
 * @param string $text
 * @return string
 */
function slugify(string $text){
    return $text = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text)));
}

/**
 * Slugify the path of an image but keep the file type at the end
 *
 * @param string $text
 * @return string
 */
function slugifyImagePath(string $text){
    $text = explode(".png", $text);
    return $text = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $text[0]))).".png";
}

/**
 * Cut text at the given limit
 *
 * @param string $text
 * @param int $numbChar
 * @return string
 */
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

/**
 * Verify if the image is a png or jpg and if it's smaller than 5mb
 *
 * @param array $image
 * @return bool
 */
function verifyImage(array $image){
    $isCorrectImage = true;

    $filepath = $image['tmp_name'];
    $fileSize = filesize($filepath);
    $fileinfo = finfo_open(FILEINFO_MIME_TYPE);
    $filetype = finfo_file($fileinfo, $filepath);

    $allowedTypes = [
        'image/png' => 'png',
        'image/jpeg' => 'jpg'
    ];

    if($fileSize === 0 || $fileSize > 5242880) {
        $isCorrectImage = false;
    }

    if (!in_array($filetype, array_keys($allowedTypes))) {
        $isCorrectImage = false;
    }

    return $isCorrectImage;
}

/**
 * Upload the image to the given folder
 *
 * @param array $image
 * @param string $image_target_dir
 * @return void
 */
function saveImage(array $image, string $image_target_dir){
    $target_file = $image_target_dir . slugifyImagePath(basename($image["name"]));
    if (move_uploaded_file($image["tmp_name"], $target_file)) {
        echo "The file ". htmlspecialchars(basename($image["name"])). " has been uploaded.";
    } 
    else {
        echo "Sorry, there was an error uploading your file.";
        var_dump($image['error']);
    }
}