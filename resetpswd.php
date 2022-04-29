<?php

    include('config.php');

    mysql_select_db($dbName, $connect);

	$encryptedUserName = $_COOKIE[encryptedUserName];
    $result = mysql_query("SELECT * FROM user WHERE `userNameSHA256` = '$encryptedUserName'");
    $userName = mysql_result($result, 0, 'userName');

	if ($userName == "Guest" || $userName == "guest")
	{
		echo "The password cannot be changed for this account!";
		header("Refresh:2;url=user.php");
	}
    else if ($_POST[newPswd] == NULL || $_POST[confirmPswd] == NULL)
    {
        echo "Password cannot be empty.";
		header("Refresh:2;url=resetpswd.html");
    }
	else if($_POST[newPswd] != $_POST[confirmPswd])
        echo "The passwords entered are inconsistent.";
    else
    {
        if ($_POST[oldPswd] == mysql_result($result, 0, 'pswd'))
        {
            $sql = mysql_query("UPDATE `user` SET `pswd` = '$_POST[newPswd]' WHERE (`userName` = '$userName')");
            if ($sql == 1)
            {
                echo "New password updated successfully.";
                header("Refresh:2;url=user.php");
            }
            else
                die('Error: ' . mysql_error());
        }
        else
            echo "Error Password";

        mysql_close($connect);
    }

?>
