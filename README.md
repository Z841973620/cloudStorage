# cloudStorage

一个基于PHP的云盘，此版本可实现用户注册、登录、修改密码，列出用户目录下文件，新建文件夹和上传文件，并加入了用户限制

修正了读取2GB以上文件大小出错的bug，并以KB，MB，GB代替字节显示文件大小

用户权限分为0，1，2三种；0无限制；1最大空间4G，单次上传文件最大1G；2最大空间128M，单次上传文件最大32M

默认禁止上传格式为`php`, `html`, `js`, `css`, `htm`的文件

[演示地址][1]

## 前置条件

- Windows (Linux也可以
- IIS (Nginx或者Apache当然可以
- PHP 5.6
- MySQL 5.7 或更高版本

## 使用方式

1. 访问首页(index.html)，按要求输入数据库连接方式
2. 可以正常使用啦

## 备注

请修改`php.ini`中的`upload_max_filesize`项，最好不少于4G

请向`php.ini`中的`[ExtensionList]`添加`extension=php_com_dotnet.dll`

用户权限目前仍需手动进数据库修改

Linux端部署注意：需修改 `register.php`、`user/newFolder.php` 新建文件夹部分的代码

[1]: https://841973620.net:8080/
