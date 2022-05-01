<?php
    if (file_exists('config.php') == False)
        header("Refresh:0;url=new.html");
    else if ($_COOKIE[encryptedUserName] == NULL)
        header("Refresh:0;url=login.html");
    else
        header("Refresh:0;url=user.php");
?>
