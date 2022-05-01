<?php
    include('config.php');
    if ($_COOKIE[encryptedUserName] == NULL)
        header("Refresh:0;url=login.html");

    mysql_select_db($dbName, $connect);
    $result = mysql_query("SELECT * FROM user WHERE `userNameSHA256` = '$_COOKIE[encryptedUserName]'");
    $userName = mysql_result($result, 0, 'userName');
?>

<html>

<head>
    <title>Storage</title>
</head>

<body align="center">

    <div>
        <br><p>Hello, <?php echo $userName; ?></p>
    </div>
    <div>
        <a href="resetpswd.html">Reset Password</a><br>
        <a href="logout.php">Log Out</a>
    </div>

    <div>
        <br><br>
        <iframe src="user/file.php" width=100% height=80% scrolling="Yes"  noresize="noresize" frameborder="0" id="fileList"></iframe>
    </div>
    
</body>

</html>