<!DOCTYPE HTML> 
<html>
	<head>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	
	<body> 

<?php

include "bountyManipulator.php";


// define variables and set to empty values
$titleErr = $descriptionErr = $myrAddressErr = $userNameErr = "";
$title = $description = $myrAddress = $userName = "";

$WAITING = -1;
$FAILURE = 1;
$SUCCESS = 0;

$fileName = "bounties.dat";
$bountyDeleted = WAITING;
$redirectURL = "https://birdonwheels5.no-ip.org/myr-bountyboard/";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$_POST["title"] = bounties[x]
    	
//TODO Implement title search and throw error if title already exists

    	
$fileName = "bounties.dat";
$separator = "&-$";
$empty = "";
$active = "true";

if((strcmp($title, $empty) == 0) or (strcmp($description, $empty) == 0) or (strcmp($myrAddress, $empty) == 0) or (strcmp($userName, $empty) == 0))
{
	$bountyDeleted = FAILURE;
}
else
{
	$bountyDeleted = SUCCESS;
	file_put_contents($fileName, "title: " . $title . "\n" . "desc: " . $description  . "\n" . "addr: " . $myrAddress . "\n" . "user: " . $userName . "\n" . "active: " . $active . "\n" . $separator . "\n", FILE_APPEND);
}
}
?> 

			<h2>Submit a New Bounty</h2>
		<p><span class="error">Review bounty before deleting it!</span></p>
		
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				Bounty Title:<br>
				<input type="text" name="title" value="<?php echo $title;?>">

				<br><br>
				Bounty Description:<br>
				<textarea name="description" rows="5" cols="40"><?php echo $description;?></textarea>

				<br><br>
				
				Myriadcoin Address: <br>
				<input type="text" name="myrAddress" value="<?php echo $myrAddress;?>">
				<br><br>
				
				Username:<br>
				<input type="text" name="userName" value="<?php echo $userName;?>">
				<br><br>
				
				<input type="submit" name="submit" value="Submit"> 
			</form>

<?php
if ($bountyDeleted == FAILURE)
{
	print "Bounty deletion failed! (Could not find bounty)";
	print $description;
}
else if ($bountyDeleted == SUCCESS)
{
	print "Bounty deleted!";
	print "<br>";
	print "Redirecting to bounty page...";
	header("Refresh: 3, URL = " . $redirectURL);
	exit;
}
?>

	</body>
</html>
