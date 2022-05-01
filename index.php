<?php
    if ($_COOKIE[encryptedUserName] == NULL)
        header("Refresh:0;url=login.html");
    else
        header("Refresh:0;url=user.php");
?>
