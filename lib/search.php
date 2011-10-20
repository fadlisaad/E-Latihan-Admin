<?php 
	// ---------------------------------------------------------------- // 
	// DATABASE CONNECTION PARAMETER 									// 
	// ---------------------------------------------------------------- // 
	// Modify config.php with your DB connection parameters or add them //
	// directly below insted of include('config.php'); 					//
	
	// REQUIRED! Parameters to connect to your DB
	// CHANGE ONLY $db_host, $db_name, $username, $password
	$db_host="202.190.32.26";
	$db_name="mardilms";
	$username="root";
	$password="xs2mysql";

	// DON'T CHANGE THE FOLLOWING CODE!
	$db_con=mysql_connect($db_host,$username,$password);
	$connection_string=mysql_select_db($db_name);
	mysql_connect($db_host,$username,$password);
	mysql_select_db($db_name);
	
	
	// ---------------------------------------------------------------- // 
	// SET PHP VAR - CHANGE THEM										// 
	// ---------------------------------------------------------------- // 
	// You can use these variables to define Query Search Parameters:	//
	
	// $SQL_FROM:	is the FROM clausule, you can add a TABLE or an 	//
	// 				expression: USER INNER JOIN DEPARTMENT...			//
	
	// $SQL_WHERE	is the WHER clausule, you can add an table 	 		//
	// 				attribute for ezample name or an 					//
	
	
	$SQL_FROM = 'ts_kursus';
	$SQL_WHERE = 'ts_kursus_nama';

?>
<?php
	$searchq		=	strip_tags($_GET['q']);
	$getRecord_sql	=	'SELECT * FROM '.$SQL_FROM.' WHERE '.$SQL_WHERE.' LIKE "'.$searchq.'%"';
	$getRecord		=	mysql_query($getRecord_sql);
	if(strlen($searchq)>0){
	// ---------------------------------------------------------------- // 
	// AJAX Response													// 
	// ---------------------------------------------------------------- // 
	
	// Change php echo $row['name']; and $row['department']; with the	//
	// name of table attributes you want to return. For Example, if you //
	// want to return only the name, delete the following code			//
	// You can modify the content of ID element how you prefer			//
	echo '<ul>';
	while ($row = mysql_fetch_array($getRecord)) {?>
		<li><a href="#"><?php echo $row['ts_kursus_nama']; ?> <small><?php echo $row['ts_kursus_kategori']; ?></small></a></li>
	<?php } 
	echo '</ul>';
	?>
<?php } ?>