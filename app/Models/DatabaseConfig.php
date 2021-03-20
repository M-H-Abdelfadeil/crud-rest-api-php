<?php
namespace App\Models;
use Dcblogdev\PdoWrapper\Database;
class DatabaseConfig{
    private $host      = DB_HOST;
    private $database  = DB_DATABASE;
    private $username  = DB_USERNAME;
    private $password  = DB_PASSWOR;


    public $db;

    public function __construct()
    {
        $config=$this->config_database();
        $this->db=new Database($config);
    }


    private function config_database(){
        return [
            'host'     =>$this->host,
            'database' =>$this->database,
            'username' =>$this->username,
            'password' =>$this->password,
            
        ];
    }
    
    

}