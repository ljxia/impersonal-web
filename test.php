<?php
echo "Page OK\r\n";

echo count($_POST)." POST params\r\n";
echo count($_GET)." GET params\r\n";
echo json_encode(compact("_GET","_POST"));