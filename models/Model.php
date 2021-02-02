<?php
require_once("Config.php");

/* db connection class
*  performs connection to database
*  singleton
*/
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

    /* 
    * initiate object with values from .env
    */
    protected function __construct()
    {
        self::$_charset = Config::get('charset');
        self::$_host    = Config::get('host');
        self::$_user    = Config::get('user');
        self::$_pass    = Config::get('password');
        self::$_db      = Config::get('db');
    }

    /* get get instance of model class, create instance if needed
    * return instance of model class
    */
    public static function getInstance()
    {
        if(self::$instance == NULL)
            self::$instance = new Model();
        return self::$instance;
    }

    /* creates connection to db
    * return pdo connection object
    */
    protected static function connect(): void
    {
        self::$_charset = Config::get('charset');
        self::$_host    = Config::get('host');
        self::$_user    = Config::get('user');
        self::$_pass    = Config::get('password');
        self::$_db      = Config::get('db');
        
        $_dns = "mysql:host=".self::$_host.";dbname=".self::$_db.";charset=".self::$_charset;
        self::$connection = new PDO($_dns, self::$_user, self::$_pass, self::$_opt);
    }

    /* disconect from db
    * return void
    */
    public static function disconnect():void
    {
        self::$connection = null;
    }

    /* get data from db by given query
    * not secure, better use prepered queries
    * @param string sql query
    * return arrau of ogjects
    */
    protected static function select($sql): array
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