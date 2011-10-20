<?php
	define('DB_HOST', '202.190.32.26');
    define('DB_USER', 'root');
    define('DB_PASSWORD', 'xs2mysql');
    define('DB_DATABASE', 'mardilms');
	
    header("Content-Type: application/rss+xml; charset=ISO-8859-1");

    echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
    echo '<rss version="2.0">';
    echo '<channel>';
    echo '<title>Senarai Kursus Berjadual 2010</title>';
    echo '<link>http://elearn.mardi.gov.my</link>';
    echo '<description>Senarai Kursus Berjadual 2010 di bawah kelolaan Program Kursus dan Latihan Teknikal</description>';
    echo '<language>en-us</language>';
    echo '<copyright>Copyright (C) 2009</copyright>';

    $connection = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD)
	or die('Could not connect to database');
    mysql_select_db(DB_DATABASE)
	or die ('Could not select database');

    $query = "SELECT * FROM ts_kursus";
    $result = mysql_query($query) or die ("Could not execute query");

    while($row = mysql_fetch_array($result)) {
        extract($row);

        echo '<item>';
        echo '<title>'.$ts_kursus_nama.'</title>';
        echo '<description>'.$ts_kursus_kategori.'</description>';
        echo '<link>'.$ts_kursus_nama.'</link>';
        echo '<pubDate>'.$ts_kursus_tarikh_mula.'</pubDate>';
        echo '</item>';
    }

    echo '</channel>';
    echo '</rss>';

?>