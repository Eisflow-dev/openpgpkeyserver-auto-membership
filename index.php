<?php

include_once('config.inc.php');
include_once('inc/database.inc.php');

include_once('inc/header.inc.php');

if (!empty($_GET)) {

  //echo "we have some data $_GET['page']";

} else {
  echo "<h2>SKS Peering Page</h2>";
  
  $row_count = "0";
  $line_count = "0";
  
  echo "<table><tr><td><table border='0'>";
  $sqlShowBlocked = 'SELECT * FROM servers;';
  $result = $dbHandle->query($sqlShowBlocked);
  while ($entry = $result->fetch()) {
    $row_color = ($row_count % 2) ? $color1 : $color2;
    $server = $entry['server'];
    $description = $entry['description'];
    $active = $entry['active'];
    if ($active == 1) {$active='check';$switch_active='off';} else {$active='del';$switch_active='on';}
  
    $row_count++;
    $line_count++;
    echo "<tr bgcolor='$row_color'><td>$line_count</td><td><a href='index.php?page=server&server=" .$server. "'>$server</a></td><td>$description</td><td><center><div id=$active></div></center></td><td><a href='./bin/del_server.php?server=$server'><div id='del'></div></a></td></tr>";
  }
  echo "</table></pre></td></tr></table>";
}

include_once('inc/footer.inc.php');

?>
