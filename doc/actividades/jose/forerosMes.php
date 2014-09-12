<?php
include("../utiles/conexionFA.php");			
include("../utiles/common.php"); 
$linkFA = ConectarseFA();
include('../utiles/conexion.php');
$link = Conectarse();
include("securityAdmin.php");
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Liga Deportiva - Admin</title>
<script type="text/javascript" src="/js/jquery-1.4.2.min.js"></script>
<link href="/css/styles.css" rel="stylesheet" type="text/css" />
</head>
<body>
<center>
<img alt="logoTAP" src="/images/LogoTAPadmin.png"/>
<div align="left" style="width:950px;margin-top:30px;">
<?php include('menu.php');?>
<br/>
<?php
		$year = date(Y);
		$numberMonth = date(n) - 1;
		if(strlen($numberMonth) == 1)
			$month = "0". $numberMonth;
		else
			$month = $numberMonth;
			
		if($month == "00"){
			$month = "12";
			$year = $year - 1;
		}
		$yearmonth = $year . $month;					
?>
<p>Foreros del mes <?php echo $month?> del año <?php echo $year?></p>
<center>
<table border="1px" bordercolor="#FFD000">
<?php 
	$query = "select * from foreros_mes where yearmonth = ". $yearmonth;
		$result = mysql_query($query, $linkFA);
		$i = 1;
		while($row = mysql_fetch_array($result)){		
?>
<tr>
	<td width="50px"><?php echo $i?></td><td width="300px"><?php echo $row['username']?></td>
</tr>
<?php
	$i++;
 }?>
</table>
</center>
</div>

</center>

</body>
</html>