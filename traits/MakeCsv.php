<?php
trait MakeCsv{
    /* down load given data in csv format
    * @param string file name
    * @param columns assoc array of titles
    * @param data 2d array of assoc arrays
    * return 
    */
    public function download($filename,$columns,$data)
    {
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header("Content-Type: text/csv");   
        ob_end_clean();     // Make sure the headers have been sent to the client.
        
        $title = ''; 

        foreach ($columns as $column) $title.=($title?',':'').'"'.str_replace('"','""', $column).'"'; echo $title."\r\n";

        foreach ($data as $r) {
            $row = '';
            foreach ($columns as $key=>$column) $row.=($row?',':'').'"'.str_replace('"','""', strip_tags($r[$key])).'"'; 
            echo $row."\r\n";
            unset($row);
        }
        flush();
        exit;
    }
}


