<?php
$myfile = fopen("data.txt",'r') or die("Unable to open file!");
$newfile = fopen("dataNew.txt", 'w') or die("Unable to open file!");
$genre = array('alternative', 'blues', 'classical', 'country', 'electronic', 'hip hop', 'jazz', 'R&B', 'rock');
while(($line = fgets($myfile)) !== false) {
	$line = trim($line);
	$line .= '|' . getRandomGenre($genre) . "\n";
	fputs($newfile, $line);
}
echo "finished";
fclose($myfile);
fclose($newfile);

function getRandomGenre(array $genre) {
	$n = count($genre);
	return $genre[rand(0, $n - 1)];
}
?>