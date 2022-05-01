<?php
    if ($_COOKIE[encryptedUserName] != NULL)
    {
        include('../config.php');
        include('dirSize.php');
        mysql_select_db($dbName, $connect);
        $result = mysql_query("SELECT * FROM user WHERE `userNameSHA256` = '$_COOKIE[encryptedUserName]'");
        $userName = mysql_result($result, 0, 'userName');
        mysql_close($connect);
        setcookie('encryptedUserName', $_COOKIE[encryptedUserName], time()+300, "/");

        if ($_COOKIE[dirName] == NULL)
            setcookie('dirName', $userName, time()+300, "/user");
        $cut = substr($_COOKIE[dirName], 0, strlen($userName));
        if ($cut != $userName)
        {
            setcookie('dirName', $userName, time()+300, "/user");
            header("Refresh:0;url=file.php");
        }
        else
        {
            $dirName = iconv('UTF-8', 'GBK', $_COOKIE[dirName]);
            $dir_handle = opendir($dirName);
            echo '<table border="1" align="center" width="960px" cellspacing="0" cellpadding="0">';
            echo '<caption><h2>Contents in the directory "' . iconv('GBK', 'UTF-8', $dirName) . '"</h2>';
            if ($userName != "Guest")
            {
                echo 'Create Folder: <form action="newFolder.php" method="post""><input type="text" name="newFolderName"><input type="submit"  value="Create"></form><br>';
                echo 'Upload File: <form action="upload.php" method="post" enctype="multipart/form-data"><input type="file" name="file"><input type="submit" value="Upload"></form></caption>';
            }
            echo '<tr align="left" bgcolor="#cccccc">';
            echo '<th>No.</th><th>File Name</th><th>Size</th><th>Type</th><th>Modify Time</th></tr>';
            echo '<tr bgcolor="#ffffff"></td><td><td><a href="backDir.php">..</a></td><td></td><td></td><td></td></tr></tr>';
            while ($file = readdir($dir_handle)) {
                if ($file != "." && $file != "..") {
                    $dirFile = $dirName . "/" . $file;
                    if ($num++ % 2 == 0)
                       $bgcolor = "#cccccc";
                    else
                       $bgcolor = "#ffffff";
                    echo '<tr bgcolor=' . $bgcolor . '>';
                    echo '<td>' . $num . '</td>';
                    $file = iconv('GBK', 'UTF-8', $file);
                    if (filetype($dirFile) == 'dir')
                        echo '<td><a href="newDirName.php?newdir=' . $file . '">' . $file . '</a></td>';
                    else
                        echo '<td><a href="' . iconv('GBK', 'UTF-8', $dirName) . '/' . $file . '" target="_blank">' . $file . '</a></td>';
                    if (filesize($dirFile) == 0)
                        echo '<td></td>';
                    else
                        echo '<td>' . sprintf("%.3f", filesize($dirFile) / 1024) . 'KB</td>';
                    echo '<td>' . filetype($dirFile) . '</td>';
                    echo '<td>' . date("Y/n/t", filemtime($dirFile)) . '</td>';
                    echo '</tr>';
                }
            }
            echo '</table>';
            closedir($dir_handle);
            $dirSize = dirsize($dirName);
            if ( $dirSize>= 1073741824)
                $totalSize = '' . sprintf("%.3f", $dirSize / 1073741824) . 'GB';
            else if ($dirSize >=1048576)
                $totalSize = '' . sprintf("%.3f", $dirSize / 1048576) . 'MB';
            else if ($dirSize >=1024)
                $totalSize = '' . sprintf("%.3f", $dirSize / 1024) . 'KB';
            else
                $totalSize = '' . $dirSize . 'B';
            if ($num > 1)
                echo "<p align='center'>There are $num subdirectories and files in this directory, $totalSize in total.</p>";
            else
                echo "<p align='center'>There are $num subdirectory and file in this directory, $totalSize in total.</p>";
        }
    }
    else
        header("Refresh:0;url=/login.html");
?>
