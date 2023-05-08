<?php
require_once("controllers/image-upload.controller.php");
class DBConnection extends FileUploadHandler
{
    protected $hostname = 'localhost';
    protected $password = '';
    protected $username = 'root';
    protected $database = 'product_app';
    
    public $conn;

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        } catch (Exception $e) {
            die($e);
        }
    }
}
