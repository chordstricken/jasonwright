<?php
namespace controllers;

use \Exception;
use \ZipArchive;

/**
 * This class is responsible for compressing, then saving a cert file
 * @author Jason Wright <jason.dee.wright@gmail.com>
 * @since December 13, 2013
 */

class CertFile
{

    /**
     * @var string - directory for images to be saved in
     */
    const DIRECTORY = '/share/inventory_certs';

    /**
     * @param string $filename
     * @return string $path
     */
    private static function _get_path($filename)
    {
        return ROOTPATH . '/' . self::DIRECTORY . "/$filename.zip";
    }

    /**
     * saves the cert
     * @param  string $product_id
     * @param  array $_FILES['file']
     * @throws Exception
     */
    public static function save($product_id, $file) {

        $zip      = new ZipArchive();
        $filepath = self::_get_path($product_id);
        // print_r($this->file);
        // die();
        // $tmp_file = '/tmp/' . $this->file['tmp_name'];

        // // move the uploaded file to a temp location
        // if (!move_uploaded_file($this->file['tmp_name'], $tmp_file)) {
        //     error_log(error_get_last() . PHP_EOL);
        //     throw new Exception("Failed to upload the file.");
        // }

        // create a new archive
        if (!$zip->open($filepath, ZipArchive::OVERWRITE)) {
            error_log(var_export(error_get_last(), true) . PHP_EOL);
            throw new Exception('Failed to create new zip archive');
        }

        // add the temp file to the archive
        if (!$zip->addFile($file['tmp_name'], $file['name'])) {
            error_log(var_export(error_get_last(), true) . PHP_EOL);
            throw new Exception('Failed to add file to zip archive');
        }

        // close the archive
        if (!$zip->close()) {
            error_log(var_export(error_get_last(), true) . PHP_EOL);
            throw new Exception('Failed to close zip archive');
        }


    }

    /**
     * deletes the image
     * @param string $product_id
     */
    public static function delete($product_id) {
        @unlink(self::_get_path($product_id));
    }

}