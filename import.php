<?php

include('opengraph.php');

$metaData = OpenGraph::fetch($url);

echo "<pre>";
//print_r($graph);
//echo $graph->title;
echo "</pre>";

?>