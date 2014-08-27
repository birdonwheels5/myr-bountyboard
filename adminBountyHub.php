
<!DOCTYPE html>
<html>

	<head>
		<meta charset="ISO-8859-1">
		<title>Admin Panel</title>
		<link rel="stylesheet" type="text/css" href="styles.css" title="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		<?php include "bountyHandler.php";
		
		$fileName = "bounties.dat";
		$bountyCount = countBounties($fileName);
		
		?>
	</head>
	
	<body link="#E2E2E2" vlink="#000000">
		<center><div class="container">
	
		
			<center><header style="background-color:transparent;">
				<table>
					<tr>
						<td><img src="http://i.imgur.com/7JOcOBP.png" style="width:120%;"></img></td>
						<td><h1>&nbsp;	&nbsp; Admin Control Panel</h1></td>
					</tr>
				</table>
			</header></center>
			
			<article>

				<hr/>
			
				<div class="welcome">
					<center><p>Welcome to the Admin Control Panel! (For devs & trusted community members only)</center><br/>
					<center><b>Total Bounties</b>: <?php print $bountyCount; ?></center><br/>
					Please note: You cannot change a bounty's title through the update page. You must first delete the bounty, then recreate it with the new title.<br/>
					Links:<br/>
					<ul>
						<li><a href="bountySubmitForm.php">Submit a New Bounty</a><br/>
						<li><a href="bountyUpdateForm.php">Update an Existing Bounty</a><br/>
						<li><a href="bountyDeleteForm.php">Delete a Bounty</a><br/>
						<li><a href="index.php">Home</a><br/>
					</ul>
					<center>Have fun!</center></p>
				</div>
				
				<div class="welcome"><?php displayTitles("bounties.dat"); ?></div>
				
				
					</article></div></body></html>
