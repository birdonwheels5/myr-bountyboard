<!DOCTYPE html>
<html>

	<head>
	<?php include "bountyManipulator.php";
	?>
	</head>

	<body>
	
	<?php
	
	
	$fileName = "bounties.dat";
	
	// With this, you can pull any aspect of a bounty's data and display it.
	$bounties = array();
	$bounties = readBounties($fileName);
	
	var_dump($bounties);

	removeBounty($fileName, "title: " . $bounties[1]->getTitle());
	
	//print $bounties[2]->getTitle();
	
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
