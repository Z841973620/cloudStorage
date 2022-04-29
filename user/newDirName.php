<?php
    $dirName = "$_COOKIE[dirName]/$_GET[newdir]";
    setcookie('dirName', $dirName, time()+300);
    header("Refresh:0;url=file.php");
?>
