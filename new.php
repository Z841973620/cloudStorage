<?php
    if (file_exists('config.php'))
        header("Refresh:0;url=index.php");
    else
    {
        $connect = mysql_connect($_POST[dbServerName], $_POST[dbUserName], $_POST[dbPassword], "storage");
        if (!$connect)
            die('Could not connect: ' . mysql_error());
        mysql_query("CREATE SCHEMA `storage`");
        mysql_select_db("storage", $connect);
        mysql_query("CREATE TABLE `storage`.`user` ( `userName` VARCHAR(16) NOT NULL, `userNameSHA256` VARCHAR(256) NOT NULL, `pswd` VARCHAR(32) NULL, `op` VARCHAR(1) NOT NULL, PRIMARY KEY (`userName`), UNIQUE INDEX `userNamw_UNIQUE` (`userName` ASC), UNIQUE INDEX `userNameSHA256_UNIQUE` (`userNameSHA256` ASC))");
        $sql = mysql_query("INSERT INTO `storage`.`user` (`userName`, `userNameSHA256`, `op`) VALUES ('Guest', '5ed8944a85a9763fd315852f448cb7de36c5e928e13b3be427f98f7dc455f141', '2')");
        if ($sql != 1)
            die('Error: ' . mysql_error());
        else
        {
            mkdir(iconv("UTF-8", "GBK", "user/Guest"), true);
            $file = fopen("config.php", "w") or die("Unable to open file!");
            $txt = "<?php\n    \$dbServerName = \"$_POST[dbServerName]\";\n    \$dbUserName = \"$_POST[dbUserName]\";\n    \$dbPassword = \"$_POST[dbPassword]\";\n    \$dbName = \"storage\";\n    \$notAllowedExts = array(\"php\", \"html\", \"js\", \"css\", \"htm\");\n    \$connect = mysql_connect(\$dbServerName, \$dbUserName, \$dbPassword, \$dbName);\n    if (!\$connect)\n        die('Could not connect: ' . mysql_error());\n?>\n";
            fwrite($file, $txt);
            fclose($file);
            unlink('new.html');
            echo "Succeed";
            header("Refresh:2;url=index.php");
        }
        mysql_close($connect);
    }
?>
