<?php
$db = mysql_connect("202.190.32.26", "root", "xs2mysql");
mysql_select_db("data_ts", $db) or die(mysql_errno() . ": " . mysql_error() . "<br>");

$sql = "SELECT * FROM ts_files ";
$sql .= "ORDER BY name ASC";
$result = mysql_query($sql, $db);
$rows = mysql_num_rows($result);

echo "<table>\n";
echo " <tr>\n";
echo "  <td>Filename</td>\n";
echo "  <td>Type</td>\n";
echo "  <td>Size</td>\n";
echo "  <td> </td>\n";
echo " </tr>\n";

for ($i = 0; $i < $rows; $i++) {
  $data = mysql_fetch_object($result);
  // since our script is very small, i'm not going to escape out to html mode here
  echo " <tr>\n";
  echo "  <td>$data->name</td>\n";
  echo "  <td>$data->type</td>\n";
  echo "  <td>$data->size</td>\n";
  echo "  <td>( <a href='download-files.php?id=$data->id'>Download</a> )</td>\n";
  echo " </tr>\n";
}
mysql_free_result($result);
mysql_close($db);
?>