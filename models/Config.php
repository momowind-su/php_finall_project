<?php
define("ENV_PATH", ".env");


/*
* read .env / find configuration
*/
class Config{
    private static $file;
    private static $result_array = [];
    private static $line_delimiter = "=";
    private static $comment_delimiter = "#";


    /* read all .env into array
    * return void
    */
    private static function parse_file(): void
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

    /* get needed config from .env by his name
    * @param congig name
    * return cofig value othervise false
    */
    public static function get(string $config): string
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

    /* find many configs by given array
    * @param array of strings names of configs
    * return assoc array of configs
    */
    public static function get_many(array $configs): array
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