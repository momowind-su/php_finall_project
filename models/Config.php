<?php
define("ENV_PATH", ".env");

class Config{
    private static $file;
    private static $result_array = [];
    private static $line_delimiter = "=";
    private static $comment_delimiter = "#";
    
    private static function parse_file()
    {
        while(!feof(self::$file))
        {
            $line = fgets(self::$file);
            if(strpos($line, self::$line_delimiter) && $line[0] != self::$comment_delimiter){
                list($key, $val) = explode(self::$line_delimiter, $line);
                self::$result_array[$key] = $val;
            }
        }
        fclose(self::$file);
    }

    public static function get($config)
    {
        if(is_file(ENV_PATH))
        {
            self::$file = fopen(ENV_PATH, 'r');
            self::parse_file();
            return isset(self::$result_array[strtoupper($config)]) ? trim(self::$result_array[strtoupper($config)]) : false;
        }
        else
        {
            throw new Exception("File .env not exist");
        }
    }

    public static function get_many($configs)
    {
        if(is_file(ENV_PATH))
        {
            self::$file = fopen(ENV_PATH, 'r');
            self::parse_file();
            $result = [];
            foreach($configs as $name => $config)
            {
                $result[$name] = isset(self::$result_array[strtoupper($config)]) ? trim(self::$result_array[strtoupper($config)]) : false;
            }
            return $result;
        }
        else
        {
            throw new Exception("File .env not exist");
        }
    }
}