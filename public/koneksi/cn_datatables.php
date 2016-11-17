<?php
$hostname_cn_datatables = "localhost:3307";
$database_cn_datatables = "apuppt";
$username_cn_datatables = "root";
$password_cn_datatables = "mmsPNMonl1n3";
$cn_datatables = mysql_pconnect($hostname_cn_datatables,
$username_cn_datatables, $password_cn_datatables)
or trigger_error(mysql_error(),E_USER_ERROR);
?>