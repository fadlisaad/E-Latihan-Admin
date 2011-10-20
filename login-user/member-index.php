<?php
	require_once('auth.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Member Index</title>
<link href="loginmodule.css" rel="stylesheet" type="text/css" />
</head>
<body>
<h1>Selamat datang,<?php echo $_SESSION['SESS_FULLNAME'];?></h1>
<h2><a href="member-profile.php">Biodata</a> | <a href="logout.php">Log Keluar</a>
</h2>
<ol>
  <li>Nama: <?php echo $_SESSION['SESS_FULLNAME']; ?></li>
  <li>No Kad Pengenalan: <?php echo $_SESSION['SESS_USERNAME']; ?></li>
</ol>
<h3>Senarai Kursus</h3>
<ol>
  <li></li>
</ol>
</body>
</html>