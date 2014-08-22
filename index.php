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
	
	$file = fopen("inputfile.txt", "r");
	if ($file) 
	{
    		while (($line = fgets($file)) !== false) 
    		{
			$index = 0;
			if (strcasecmp(strpbrk($line, "-"),"-") > 0)
			{
			}
			else // Fetch bounty information line-by-line, cunstruct the bounty, then add 1 to bounty count
			{
			if (strpbrk($line,"title: ") == "title: ")
			{
				str_replace("title: ", "", $title);
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
			
			echo $title;
			echo $description;
			echo $myrAddress;
			echo $userName;
		
			// bounty.create($title, $description, $myrAddress, $userName)
		
			$index++;
		}
		else
		{
			print "Error loading bounties!";
		}
	fclose($file);
	}
	
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
