<?php
    $path = "$_COOKIE[dirName]/$_POST[newFolderName]";
    mkdir(iconv("UTF-8", "GBK", $path), true);
    echo "The folder \"$_POST[newFolderName]\" was created successfully.";
    header("Refresh:2;url=file.php");
?>
