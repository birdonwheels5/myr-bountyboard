<!DOCTYPE HTML> 
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Delete Bounty</title>
		<link rel="stylesheet" type="text/css" href="styles.css" title="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	
	<body> 
	
	


<?php

include "bountyManipulator.php";


// define variables and set to empty values
$titleErr = "";
$title = $description = $myrAddress = $userName = $active = "";

$WAITING = -1;
$FAILURE = 1;
$SUCCESS = 0;
$CONFIRM = 100;

$fileName = "bounties.dat";
$bountyDeleted = $WAITING;
$redirectURL = "https://birdonwheels5.no-ip.org/myr-bountyboard/";

$bounties = array();
$bounties = readBounties($fileName);

$separator = "qpwoeiruty";
$empty = "";

global $bountyNumber;
$bountyNumber = -1;


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
if($_POST["submit"] and $_POST["submit"] == "Continue")
{
	if (empty($_POST["title"])) 
	{
		$titleErr = "A title is required";
	} 


$bountyNumber = searchBounty($fileName, $_POST['title']);
	
if ($bountyNumber < 0)
{
	$titleErr = "Title not found.";
	$bountyDeleted = $FAILURE;
}

if ($bountyNumber > 0)
{
	$title = $bounties[$bountyNumber]->getTitle();

	$description = $bounties[$bountyNumber]->getDescription();
	$myrAddress = $bounties[$bountyNumber]->getMyrAddress();
	$userName = $bounties[$bountyNumber]->getUserName();
	$active = $bounties[$bountyNumber]->getActive();
	
	$bountyDeleted = $CONFIRM;
	
	/* This is a very bad way of persisting the $bountyNumber variable because if another user clicks
	the "delete" button on a bounty *before* this user clicks "confirm", this user will have the wrong
	$bountyNumber, and thus delete the wrong bounty.For now it is fine because we won't 
	have a large volume of users doing this.*/
	file_put_contents("tmpDeleteBounty.dat", $bountyNumber);
	
}
}
	if ($_POST["submit"] and $_POST["submit"] == "Confirm")
	{
		// Load the bounty number when the user clicks on the "confirm" button
		$bountyNumber = (int)file_get_contents("tmpDeleteBounty.dat");
		
		$title = $bounties[$bountyNumber]->getTitle();
		$bountyDeleted = $SUCCESS;
		removeBounty($fileName, $bountyNumber);
	}


function cleanInput($data) 
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}


}
?> 
		<header>
		
			<center><h1>Delete Bounty Form</h1></center>
			
		</header>
		
			<nav>

			<hr/>
			<center><h2>Delete a Bounty</h2></center>
			<hr/>
		<p><span class="error">Enter the title of the bounty you wish to delete.</span></p>
		
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				Bounty Title: (You only need to type the first few letters)<br>
				<input type="text" name="title" value="<?php echo $title;?>">
				<span class="error">* <?php echo $titleErr;?></span>
				
				<br><br>
				Bounty Description:<br>
				<textarea name="description" rows="5" cols="35"><?php echo $description;?></textarea>
				<br><br>
				
				Myriadcoin Address: <br>
				<textarea name="myrAddress" rows="1" cols="35"><?php echo $myrAddress;?></textarea>
				<br><br>
				
				Username:<br>
				<input type="text" name="userName" value="<?php echo $userName;?>">
				<br><br>
				
				Is active?:<br>
				<input type="text" name="active" value="<?php echo $active;?>">
				<br><br>
				
				<input type="submit" name="submit" value="Continue">
			</form>
			</nav>

			<div class="status">
				<p><h3>Available Bounties:</h3></p>
				<hr/>
				<p><?php displayTitles($fileName) ?></p>

<?php

if ($bountyDeleted == $CONFIRM)
{
	print "<hr/>";
	print "<h3>Status:</h3><br>";
	print "Please confirm that this is the bounty that you wish to delete!";
	print "<form method=\"post\" action=\"";
	echo $_SERVER["PHP_SELF"];
	print "\">";
	print "<input type=\"submit\" name=\"submit\" value=\"Confirm\">";
	print "</form>";
}

if ($bountyDeleted == $FAILURE)
{
	print "<hr/>";
	print "<h3>Status:</h3><br>";
	print "Bounty deletion failed!";
}

if ($bountyDeleted == $SUCCESS)
{
	print "<hr/>";
	print "<h3>Status:</h3><br>";
	print "Bounty deleted!";
	print "<br>";
	print "Redirecting to bounty page...";
	header("Refresh: 3, URL = " . $redirectURL);
	exit;
}

?>

			</div>

	</body>
</html>
