<?php
    function dirsize($file)
    {
        $size = 0;
        $dir = opendir($file);
        while($filename = readdir($dir))
            if($filename!="." && $filename !="..")
            {
               $filename = $file."/".$filename;
               if(is_dir($filename))
                   $size += dirsize($filename);
               else
                  $size += filesize($filename);
            }
        closedir($dir);
        return $size;
    }
?>
