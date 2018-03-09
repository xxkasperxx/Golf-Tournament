<?php
$q=$_GET["q"];

include("config.php");


$sql="SELECT * FROM players WHERE name ='".$q."'";
echo $q;
$result = mysql_query($sql);

echo "<table border='1'>
<tr>
<th>Name</th>
<th>paid</th>
<th>club</th>
<th>phone</th>
<th>emal</th>
</tr>";

while($row = mysql_fetch_array($result))
  {
  echo "<tr>";
  echo "<td>" . $row['name'] . "</td>";
  echo "<td>" . $row['paid'] . "</td>";
  echo "<td>" . $row['club'] . "</td>";
  echo "<td>" . $row['phone'] . "</td>";
  echo "<td>" . $row['email'] . "</td>";
  echo "</tr>";
  }
echo "</table>";


?>