<?php

/**
* File Uploader
*
* @copyright   Copyright (c) 2018 Gert-Jan Wille (http://www.gert-janwille.com)
* @version     v1.0.0
* @author      Gert-Jan Wille <hello@gert-janwille.com>
*
*/

class fileUploader {

  static function upload($path, $key='file') {
    $errors = array();
    $file = $_FILES[$key];
    $fileId = preg_replace("/[^A-Z0-9._-]/i", "_", pathinfo($file['name'], PATHINFO_FILENAME));

    if (empty($file['size'])) return $errors = ['validation' => 'please provide a file to upload'];
    if (!empty($errors)) return $errors = ['validation' => $errors];

    $isImage = getimagesize($file['tmp_name']);
    if (!$isImage) return $errors = ['validation' => 'file must be an image'];

    $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = $fileId . '_' . uniqid() . '.' . $ext;
    $original = $path . $filename;

    return move_uploaded_file($file['tmp_name'], WWW_ROOT . $original);
  }

}
