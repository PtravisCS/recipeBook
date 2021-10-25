<?php

$date = "2021-01-02";
$dayofweek = date('w', strtotime($date));
$result = date('Y-m-d', strtotime(($day - $dayofweek).' day', strtotime($date)));


echo "<p>dayofweek: " . $dayofweek . "</p>";
echo "<p>resule: " . $result . "</p>";

?>
