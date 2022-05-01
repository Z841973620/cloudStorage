<?php
    include('../config.php');
    include('dirSize.php');
    mysql_select_db($dbName, $connect);
    $result = mysql_query("SELECT * FROM user WHERE `userNameSHA256` = '$_COOKIE[encryptedUserName]'");
    $userName = mysql_result($result, 0, 'userName');
    $op = mysql_result($result, 0, 'op');
    mysql_close($connect);
    if ($op == 2)
    {
        $maxSpaceLimit = 134217728;
        $fileSizeLimit = 33554432;
    }
    else if ($op == 1)
    {
        $maxSpaceLimit = 4294967296;
        $fileSizeLimit = 1073741824;
    }
    else if ($op == 0)
    {
        $maxSpaceLimit = 1099511627776;
        $fileSizeLimit = 68719476736;
    }
    else
        $fileSizeLimit = $maxSpaceLimit = 0;

    $dirName = iconv('UTF-8', 'GBK', $_COOKIE[dirName]);
    $fileName = iconv('UTF-8', 'GBK', $_FILES["file"]["name"]);
    if (in_array(end(explode(".", $fileName)), $notAllowedExts))
        echo "Illegal file format.";
    else if($_FILES["file"]["size"] > $fileSizeLimit)
        echo "The uploaded file is too large.";
    else if(dirsize($userName) >= $maxSpaceLimit)
        echo "Maximum folder space limit exceeded.";
    else
    {
	    if ($_FILES["file"]["error"] > 0)
		    echo "Error: " . $_FILES["file"]["error"] . "<br>";
	    else if (file_exists("$dirName/" . $fileName))
			echo $fileName . " File already exists.";
		else
		{
		    move_uploaded_file($_FILES["file"]["tmp_name"], "$dirName/" . $fileName);
		    echo "File uploaded successfully.";
	    }
    }
    setcookie('encryptedUserName', $_COOKIE[encryptedUserName]);
    header("Refresh:2;url=file.php");
?>
