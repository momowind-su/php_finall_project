<?php
require_once("Config.php");

class Model
{
    protected static $_db;
    protected static $_user;
    protected static $_host;
    protected static $_pass;
    protected static $class;
    protected static $_charset;
    protected static $connection;
    protected static $instance = NULL;

    protected static $_opt = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ];

    protected function __construct()
    {
        self::$_charset = Config::get('charset');
        self::$_host    = Config::get('host');
        self::$_user    = Config::get('user');
        self::$_pass    = Config::get('password');
        self::$_db      = Config::get('db');
    }

    public static function getInstance()
    {
        if(self::$instance == NULL)
            self::$instance = new Model();
        return self::$instance;
    }

    protected static function connect()
    {
        $_dns = "mysql:host=".self::$_host.";dbname=".self::$_db.";charset=".self::$_charset;
        self::$connection = new PDO($_dns, self::$_user, self::$_pass, self::$_opt);
    }

    public static function disconnect()
    {
        self::$connection = null;
    }

    protected static function select($sql)
    {
        self::connect();
        $resultArray = array();
        $result = self::$connection->query($sql);

        while($row = $result->fetchObject(self::$class))
        {
            $resultArray[] = $row;
        }
        
        self::disconnect();
        return $resultArray;
    }

}