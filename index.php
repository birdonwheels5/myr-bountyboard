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
			str_ireplace("title: ", "", $line);
			$title = $line;
		}
		else
		{
			
		}
		
		if (strpbrk($line,"desc: ") == "desc: ")
		{
			str_ireplace("desc: ", "", $line);
			$description = $line;
		}
		else
		{
			
		}
	
		if (strpbrk($line,"addr: ") == "addr: ")
		{
			str_ireplace("addr: ", "", $line);
			$myrAddress = $line;
		}
		else
		{
			
		}
	
		if (strpbrk($line,"user: ") == "user: ")
		{
			str_ireplace("user: ", "", $line);
			$userName = $line;
		}
		else
		{
			
		}
		// Check the current line for "-" which separates bounties
		if (strcmp(strpbrk($line, "-"),"-") == 0)
		{
			// bounty.create($title, $description, $myrAddress, $userName)
			$index++;
		}
		else
		{
			
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
