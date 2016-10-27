<?php

class ArrayUtils {
    public static function createFileReturnArray($length = 10000, $fileName = "ArrayFile") {
        $fh = fopen('file/'.$fileName.'.php','w') or die("can't open file.txt: $php_errormsg");
        fwrite($fh, "<?php \n");
        fwrite($fh, "return array( \n");
        for ($i = 0; $i < $length; $i++) {
            fwrite($fh, "    " . $i . ' => ' . rand(0, 10000) . ", \n");
        }
        fwrite($fh, ");\n");
        fwrite($fh, "\n ?>");
        fclose($fh) or die("can't close: $php_errormsg");
    }
}

ArrayUtils::createFileReturnArray();