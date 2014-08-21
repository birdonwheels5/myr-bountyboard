<!DOCTYPE html>
<html>

	<head>
	</head>

	<body>
	
	<?php
	$bounties = array();
	
	$title = "";
	$description = "";
	$myrAddress = "";
	$userName = "";
	
	$file = fopen("bounties.dat", "r");
	while ($line = fgets($file))
	{
		index = 0;
		if $line == "-"
		{
			return;
		}
		else // Fetch bounty information line-by-line, then add 1 to bounty count
		{
			if $line == "title: "
			{
				$title = $line - "title: ";
			}
			
			if $line == "desc: "
			{
				$description = $line - "desc: ";
			}
			
			if $line == "addr: "
			{
				$myrAddress = $line - "addr: ";
			}
			
			if $line == "user: "
			{
				$userName = $line - "user: ";
			}
			
			bounty.create($title, $description, $myrAddress, $userName)
			
			index++;
		}
	)
	fclose($file);
	
	class bounty
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
			<?php
			
			?>
		<table>
		</article>
	</div
	
	
	</body>

</html>
