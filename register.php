<?php
    if (!preg_match("/^[a-zA-Z ]*$/", $_POST[userName]))
    {
	echo "Illegal user name.";
        header("Refresh:2;url=register.html");
    }
    else if ($_POST[userName] == NULL || $_POST[pswd] == NULL)
    {
	echo "Password cannot be empty.";
        header("Refresh:2;url=register.html");
    }
    else if($_POST[pswd] != $_POST[confirm])
        echo "The passwords entered are inconsistent.";
    else
    {
        include('config.php');

        $userNameSHA256 = hash("sha256", $_POST[userName]);
        mysql_select_db($dbName, $connect);
        $sql = mysql_query("INSERT INTO user (userName, userNameSHA256, pswd, op) VALUES ('$_POST[userName]', '$userNameSHA256', '$_POST[pswd]', '2')");

        if ($sql == 1)
        {
	    $path = "user/$_POST[userName]";
	    mkdir(iconv("UTF-8", "GBK", $path), true);
	    echo "New account created successfully.";
	    header("Refresh:2;url=index.php");
        }
        else
            die('Error: ' . mysql_error());

        mysql_close($connect);
    }
?>
