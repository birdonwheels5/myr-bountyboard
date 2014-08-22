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
	
	$fileName = "bounties.dat";
	$handle = fopen($fileName, "r") or print ("Error loading bounties!");
    	while (($line = fgets($handle)) !== false) 
    	{
		$index = 0;
		
		// Fetch bounty information line-by-line, construct the bounty, then add 1 to bounty count
		if (strcmp(stristr($line,"title: "), $line) == 0)
		{
			$line = str_ireplace("title: ", "", $line);
			$title = $line;
		}
		
		if (strcmp(stristr($line,"desc: "), $line) == 0)
		{
			str_ireplace("desc: ", "", $line);
			$description = $line;
		}
	
		if (strcmp(stristr($line,"addr: "), $line) == 0)
		{
			str_ireplace("addr: ", "", $line);
			$myrAddress = $line;
		}
	
		if (strcmp(stristr($line,"user: "), $line) == 0)
		{
			str_ireplace("user: ", "", $line);
			$userName = $line;
		}

		// Check the current line for "-" which separates bounties
		if (strcmp(stristr($line, "-"), $line) == 0)
		{
			// bounty.create($title, $description, $myrAddress, $userName)
			$index++;
		}
	}
    	
    	echo $title;
	echo $description;
	echo $myrAddress;
	echo $userName;
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
