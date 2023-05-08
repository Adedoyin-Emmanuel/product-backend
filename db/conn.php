<?php
class DBConnection
{
    protected $hostname = 'localhost';
    protected $password = 'ea20gt05*(;A';
    protected $username = 'root';
    protected $database = 'product_app';
    public $conn = "";

    public function __construct()
    {
        try {
            $this->conn = new mysqli($this->hostname, $this->username, $this->password, $this->database);
        } catch (Exception $e) {
            die($e);
        }
    }
}
