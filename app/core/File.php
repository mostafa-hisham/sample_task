<?php

/**
 * Created by PhpStorm.
 * User: mostafa
 * Date: 04/02/2017
 * Time: 04:29 Õ
 */

class File
{
    /**
     * @param $file_data
     * @param $save_location
     * @return array
     * uploads image in specific path
     */
    public function uploadImg($file_data, $save_location)
    {
        if (isset($file_data["type"])) {
            $valid_extensions = array("jpeg", "jpg", "png");
            $temporary = explode(".", $file_data["name"]);
            $file_extension = end($temporary);
            if (($file_data["size"] <= 1000000) && in_array(strtolower($file_extension), $valid_extensions)) {
                if ($file_data["error"] > 0) {
                    return array("error" => $file_data["error"]);
                } else {
                    if (file_exists($save_location . $file_data["name"])) {
                        return array("error" => "File Exists");
                    } else {
                        // Storing source path of the file in a variable
                        $sourcePath = $file_data['tmp_name'];
                        // Target path where file is to be stored
                        $targetPath = $save_location . time() . "." . $file_extension;
                        // Moving Uploaded file
                        move_uploaded_file($sourcePath, "../" . $targetPath);
                        return array('location' => $targetPath);
                    }
                }
            } else {
                return array("error" => "Invalid file");
            }
        }
    }
}