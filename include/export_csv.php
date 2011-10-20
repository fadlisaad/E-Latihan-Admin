<?
// Connect database
$database="data_ts";
$table="ts_kursus";
mysql_connect("localhost","root","nazira");
mysql_select_db("data_ts");

$result=mysql_query("select * from $table");

$out = '';

// Get all fields names in table "name_list" in database "tutorial".
$fields = mysql_list_fields(data_ts,$table);

// Count the table fields and put the value into $columns.
$columns = mysql_num_fields($fields);


// Put the name of all fields to $out.
for ($i = 0; $i < $columns; $i++) {
$l=mysql_field_name($fields, $i);
$out .= '"'.$l.'",';
}
$out .="n";

// Add all values in the table to $out.
while ($l = mysql_fetch_array($result)) {
for ($i = 0; $i < $columns; $i++) {
$out .='"'.$l["$i"].'",';
}
$out .="n";
}

// Open file export.csv.
$f = fopen ('export.csv','w');

// Put all values from $out to export.csv.
fputs($f, $out);
fclose($f);

header('Content-type: application/csv');
header('Content-Disposition: attachment; filename="export.csv"');
readfile('export.csv');
?>