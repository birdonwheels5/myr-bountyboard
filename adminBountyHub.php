
<!DOCTYPE html>
<html>

	<head>
		<meta charset="ISO-8859-1">
		<title>Admin Panel</title>
		<link rel="stylesheet" type="text/css" href="styles.css" title="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		<?php include "bountyHandler.php";
		
		$fileName = "bounties.dat"
		$bountyCount = countBounties($fileName);
		
		?>
	</head>
	
	<body link="#E2E2E2" vlink="#000000">
		<center><div class="container">
	
		
			<center><header style="background-color:transparent;">
				<table>
					<tr>
						<td><img src="http://i.imgur.com/7JOcOBP.png" style="width:120%;"></img></td>
						<td><h1>&nbsp;	&nbsp;	Bounty Admin Panel</h1></td>
					</tr>
				</table>
			</header></center>
			
			<article>

				<hr/>
			
				<div class="welcome">
					<center><p>Welcome to the Admin Control Panel!</center><br/>
					<center><b>Total Bounties</b>: <?php print $bountyCount ?></center><br/>
					A few things to note before getting started...<br/>
					<ul>
						<li>The green bounties indicate bounties that are up for grabs, while the gray bounties are already claimed.<br/>
						<li>Please contact a moderator on our <a href="http://www.reddit.com/r/myriadcoin">subreddit</a> if you are interested in taking up a bounty, and then again once you have completed it to claim your reward. They can also be found on <a href="http://webchat.freenode.net/?nick=myriad%7C...&channels=%23%23myriadcoin&uio=OT10cnVlJjExPTEyMyYxMj10cnVl38"> our IRC channel</a>. You may wish to keep them in the loop with your progress.<br/>
						<li>Because of long loading times when there are numerous bounties, the list is compiled hourly. So any new (or edited) bounties will appear then.<br/>
						<li>Whenever a new bounty is added or an old one is updated, that bounty will drop to the bottom of the page. Be sure to check the bottom!<br/>
						<li>The block explorer may report a different amount than the amount raised for the bounty, but be assured that the amount displayed on this page will be paid out upon the bounty's completion.<br/>
					</ul>
					<center>Good luck, brave Bounty Hunters!</center></p>
				</div>
				
				
					</article><div class="paddingBottom"></div>
		     <footer>Bounty page by birdonwheels5. Want to show some love? Donate some MYR: MNYERWCHqrH1EkGNpF4T8o8dGB391A5jmm</footer></div></body></html>
