<?php
$start = microtime(true);
$asd = 100000000;
for($i=0;$i<$asd;++$i) echo "";
$end = microtime(true);
 
$laufzeit = $end - $start;
echo "Laufzeit ++".'$i'.": ".$laufzeit." Sekunden!\n";

$start = microtime(true);
$asd = 100000000;
for($i=0;$i<$asd;$i++) echo "";
$end = microtime(true);
 
$laufzeit = $end - $start;
echo "Laufzeit ".'$i'."++: ".$laufzeit." Sekunden!";
?>