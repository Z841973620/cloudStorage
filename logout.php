<?php
    setcookie('encryptedUserName', NULL, time()-1, "/");
    setcookie('encryptedUserName', NULL, time()-1, "/user");
    setcookie('dirName', NULL, time()-1, "/");
    setcookie('dirName', NULL, time()-1, "/user");
    header("Refresh:0;url=index.php");
?>
