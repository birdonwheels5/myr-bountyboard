<!DOCTYPE html>
<html>

	<head>
	</head>

	<body>
	
	<?php
	// $bounties = array();
	
	$title = "";
	$description = "";
	$myrAddress = "";
	$userName = "";
	$active = "";
	
	$fileName = "bounties.dat";
	$handle = fopen($fileName, "r") or print ("Error loading bounties!");
    	while (($line = fgets($handle)) !== false) 
    	{
		$index = 0;
		
		// Fetch bounty information line-by-line, construct the bounty, then add 1 to bounty count
		if (strcmp(stristr($line,"title: "), $line) == 0)
		{
			$title = str_ireplace("title: ", "", $line);
		}
		
		if (strcmp(stristr($line,"desc: "), $line) == 0)
		{
			$line = str_ireplace("desc: ", "", $line);
			
			// Check for Enter keystrokes and concatenate new lines to the Description.
			while ((strcmp(stristr($line,"^M"), $line) == 0) and (strcmp(stristr($line,"addr: "), $line) != 0))
			{
				if (strcmp(stristr($line,$description), $line) != 0)
				{
					$line = str_ireplace("^M", "", $line);
					$description = $description . "\n" . "<br>" . "\n" . $line;
				}
			}
		}
	
		if (strcmp(stristr($line,"addr: "), $line) == 0)
		{
			$myrAddress = str_ireplace("addr: ", "", $line);
		}
	
		if (strcmp(stristr($line,"user: "), $line) == 0)
		{
			$userName = str_ireplace("user: ", "", $line);
		}

		// Check the current line for "-" which separates bounties, and create bounties
		if (strcmp(stristr($line, "-"), $line) == 0)
		{
			echo $title;
    			echo "<br>";
			echo $description;
			echo "<br>";
			echo $myrAddress;
			echo "<br>";
			echo $userName;
			echo "<br>";
			echo $active;
			echo "<br>";
			echo $index;
			echo "<br>";
			echo "---------";
			echo "<br>";
			//$array[index] = new bounty($title, $description, $myrAddress, $userName, $active);
			$index++;
		}
	}
    	
	fclose($file);
	
	// class bounty
	?>
	
	
	<center><div class="container">
		<center><div class="centerPadding">
		</div>
		
		<article>
		
		<h1>Myriadcoin Community Bounty Board</h1>
		<hr/>
		<br/><br/>
		
		<table>
			<tr>
				<td>hi</td>
				<td>MYR</td>
			</tr>
		<table>
		</article>
	</div
	
	
	</body>

</html>
