<?php
session_start();
unset($_SESSION['user_shell']);
//echo '<script>alert("恭喜您，注销成功！"); window.location.href=document.referrer; </script>';
echo '<script>alert("恭喜您，注销成功！"); window.location.href="index.php"; </script>';
?>