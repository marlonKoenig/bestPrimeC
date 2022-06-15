<?php
$root = '../';
$folderRoot = $root . '/media/users/';
$directory = $folderRoot . '123456';
$documents = $directory . '/documents';
mkdir($directory);
mkdir($documents);
$data = $directory . '/testDaten.txt';
$datei = fopen($data, "w");
echo fwrite($datei, "Hallo Welt", 100);
fclose($datei);
echo 'Erledigt 04';
