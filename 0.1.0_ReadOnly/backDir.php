<?php
    $dirName = "$_COOKIE[dirName]";
	while (substr($dirName, -1) != '/' && $dirName != NULL)
		$dirName = substr_replace($dirName ,"", -1);
	$dirName = substr_replace($dirName ,"", -1);
	setcookie('dirName', $dirName, time()+300);
	header("Refresh:0;url=index.php");
?>
