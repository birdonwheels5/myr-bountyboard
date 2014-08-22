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
		
		// Check the current line for "-" which separates bounties
		if (strcasecmp(strpbrk($line, "-"),"-") > 0)
		{
		}
		// Fetch bounty information line-by-line, construct the bounty, then add 1 to bounty count
		else
		{
			if (strpbrk($line,"title: ") == "title: ")
			{
				str_replace("title: ", "", $line);
				$title = $line;
			}
			
			if (strpbrk($line,"desc: ") == "desc: ")
			{
					str_replace("desc: ", "", $description);
			}
		
			if (strpbrk($line,"addr: ") == "addr: ")
			{
				str_replace("addr: ", "", $myrAddress);
			}
		
			if (strpbrk($line,"user: ") == "user: ")
			{
				str_replace("user: ", "", $userName);
			}
		
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
