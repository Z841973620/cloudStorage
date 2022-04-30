<?php
    if ($_COOKIE[encryptedUserName] != NULL)
    {
        echo "You are already logged in.";
        header("Refresh:2;url=user.php");
    }
    else
    {
        include('config.php');

        mysql_select_db($dbName, $connect);
        $result = mysql_query("SELECT * FROM user WHERE `userName` = '$_POST[userName]'");
    
        if(mysql_result($result, 0, 'userName') == NULL)
            echo "Error Username";
        else if ($_POST[pswd] == mysql_result($result, 0, 'pswd'))
        {
            echo "Logined successfully.";
            setcookie('encryptedUserName', hash("sha256", $_POST[userName]), time()+300);
            header("Refresh:2;url=user.php");
        }
        else
            echo "Error Password";

        mysql_close($connect);

        setcookie('dirName', $_POST[userName]);
    }
?>
