<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="UTF-8">
<title>记账多用户版 - 安装</title>


<p align="center">
<?php
include("config.php");
echo "创建数据库.....";
if(indatabase($db_dbname,$conn)){
	echo "已经存在数据库，跳过<br />";
}else{
	$sql = "create database ".$db_dbname." default character SET utf8 COLLATE utf8_general_ci";
	$query=mysql_query($sql);
	if($query){
		echo "成功<br />";
	}else{
		echo "失败<br /><font color='red'>恭喜你，安装完毕，赶紧记账吧。</font></body></html>";
		
	}
}
echo "创建表 ".$qianzui."account .....";
if(intable($db_dbname,$qianzui."account",$conn)){
	echo "已存在<br /><font color='red'>已经安装过啦，表前缀已经存在。</font></body></html>";
	
}else{
	$sql = "CREATE TABLE `$db_dbname`.`".$qianzui."account` (`acid` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, `acmoney` DECIMAL(10,2) NOT NULL, `acclassid` INT(8) NOT NULL, `actime` INT(11) NOT NULL, `acremark` VARCHAR(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `jiid` INT(8) NOT NULL, `zhifu` INT(8) NOT NULL) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci";
	$query=mysql_query($sql);
	if($query){
	echo "成功<br />";
	}else{
		echo $sql;
		echo "<br />失败<br /><font color='red'>安装失败啦，请检查config.php相关配置。</font></body></html>";
		
	}
}
echo "创建表 ".$qianzui."account_class .....";
if(intable($db_dbname,$qianzui."account_class",$conn)){
	echo "已存在<br /><font color='red'>已经安装过啦，表前缀已经存在。</font></body></html>";
	
}else{
	$sql = "CREATE TABLE `$db_dbname`.`".$qianzui."account_class` (`classid` INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, `classname` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `classtype` INT(1) NOT NULL, `ufid` INT(8) NOT NULL) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
	$query=mysql_query($sql);
	if($query){
	echo "成功<br />";
	}else{
		echo "失败<br /><font color='red'>安装失败啦，请检查config.php相关配置。</font></body></html>";
	}
}
echo "<br />加入默认分类.....";
$sql="insert into ".$qianzui."account_class (classname, classtype,ufid) values ('默认收入', '1','1'),('默认支出', '2','1')";
$query=mysql_query($sql);

echo "创建表 ".$qianzui."user .....";
if(intable($db_dbname,$qianzui."user",$conn)){
	echo "已存在<br /><font color='red'>已经安装过啦，表前缀已经存在。</font></body></html>";
	
}else{
	$sql = "CREATE TABLE `$db_dbname`.`".$qianzui."user` (`uid` INT(5) NOT NULL AUTO_INCREMENT PRIMARY KEY, `username` VARCHAR(15) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `password` VARCHAR(35) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `email` VARCHAR(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL, `utime` INT(11) NOT NULL) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;";
	$query=mysql_query($sql);
	if($query){
	echo "成功<br />";
	}else{
		echo "失败<br /><font color='red'>安装失败啦，请检查config.php相关配置。</font></body></html>";
	}
}

echo "<br />加入默认用户.....";
$sql="select * from ".$qianzui."user where username='admin'";
	$query=mysql_query($sql);
	$attitle=is_array($row=mysql_fetch_array($query));
	if($attitle){
		echo "默认用户已存在！<br /><a href='login.php'>点这里立即登录</a>";
		exit();
	}else{
	$utime=strtotime("now");
	
$sql="insert into ".$qianzui."user (username, password,email,utime) values ('admin', '098f6bcd4621d373cade4e832627b4f6','salitt@qq.com','$utime')";
$query=mysql_query($sql);



if($query){
	echo "Ok了！<br />使用用户名：admin 密码：test 即可登录<br />";
}else{
	echo "失败<br /><font color='red'>安装OK了。</font></body></html>";
}

}
?>
<br /><a href="login.php">点这里立即登录</a>
</p>

</body>
</html>