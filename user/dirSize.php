<?php

    function getSize($FILE)
    {
        $SIZE = filesize($FILE);
        if ($SIZE <= 0)
            if (!(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN'))
                $SIZE = trim(`stat -c%s $FILE`);
            else
            {
                $fsobj = new COM("Scripting.FileSystemObject");
                $f = $fsobj->GetFile($FILE);
                $SIZE = $f->Size;
            }
        return $SIZE;
    }

    function dirsize($file)
    {
        $size = 0;
        $dir = opendir($file);
        while ($filename = readdir($dir))
            if ($filename!="." && $filename !="..")
            {
                $filename = $file."/".$filename;
                if (is_dir($filename))
                    $size += dirsize($filename);
                else
                    $size += getSize($filename);
            }
        closedir($dir);
        return $size;
    }

    function getFormatedSize($inSize)
    {
        if ($inSize >= 10737418240)
            $outSize = '' . sprintf("%.3f", $inSize / 1073741824) . 'GB';
        else if ($inSize >= 10485760)
            $outSize = '' . sprintf("%.3f", $inSize / 1048576) . 'MB';
        else if ($inSize >= 10240)
            $outSize = '' . sprintf("%.3f", $inSize / 10240) . 'KB';
        else
            $outSize = '' . $inSize . 'B';
        return $outSize;
    }

?>
