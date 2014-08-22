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
		if strpbrk($line,"-") == "-"
		{
			return;
		}
		else // Fetch bounty information line-by-line, then add 1 to bounty count
		{
			if strpbrk($line,"title: ") == "title: "
			{
				str_replace("title: ", "", $title);
			}
			
			if strpbrk($line,"desc: ") == "desc: "
			{
				str_replace("desc: ", "", $description);
			}
			
			if strpbrk($line,"addr: ") == "addr: "
			{
				str_replace("addr: ", "", $myrAddress);
			}
			
			if strpbrk($line,"user: ") == "user: "
			{
				str_replace("user: ", "", $userName);
			}
			
			// bounty.create($title, $description, $myrAddress, $userName)
			
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
