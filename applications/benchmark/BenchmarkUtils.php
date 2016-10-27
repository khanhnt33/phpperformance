<?php

class BenchmarkUtils {
    public static function benchmarkIsSet($time = 1000) {
        $i = 0;
        $start = microtime();
        while ($i < $time) {
            isset($isset);
            $i++;
        }
        return microtime() - $start;
    }
    
    public static function benchmarkToFile($time = 1000, $fileName = "BenchmarkResult") {
        $fh = fopen($fileName.'.txt','w') or die("can't open file.txt: $php_errormsg");
        
        $benchmarkIsset = self::benchmarkIsSet();
        
        fwrite($fh, ": Call function isset() $time times in $benchmarkIsset ms \n");
       
        fclose($fh) or die("can't close: $php_errormsg");
    }
}
BenchmarkUtils::benchmarkToFile();