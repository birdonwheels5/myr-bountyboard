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
$titleErr = "";
$title = $description = $myrAddress = $userName = $active =  "";

$WAITING = -1;
$FAILURE = 1;
$SUCCESS = 0;
$CONFIRM = 100;

$fileName = "bounties.dat";
$bountyDeleted = $WAITING;
$redirectURL = "https://birdonwheels5.no-ip.org/myr-bountyboard/";

$bounties = array();
$bounties = readBounties($fileName);

$confirmFlag = false;


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	if (empty($_POST["title"])) 
	{
		$titleErr = "A title is required";
	}
    	else 
    	{
		$title = cleanInput($_POST["title"]);
    	}
    	
$fileName = "bounties.dat";
$separator = "qpwoeiruty";
$empty = "";

$bountyNumber = searchBounty($fileName, $title);

if ((strcmp(stristr($_POST["title"],$bounty[$bountyNumber]->getTitle()), $_POST["title"]) == 0) and $confirmFlag == true)
{
	$bountyDeleted = $SUCCESS;
	removeBounty($fileName, $bounty[$bountyNumber]->getTitle());
}
else
{
	$bountyDeleted = $FAILURE;
}

if ($confirmFlag == false)
{
	$bountyDeleted = $CONFIRM;
	$confirmFlag = true;
	
	$description = $bounty[$bountyNumber]->getDescription();
	$myrAddress = $bounty[$bountyNumber]->getMyrAddress();
	$userName = $bounty[$bountyNumber]->getUserName();
	$active = $bounty[$bountyNumber]->getActive();
}

function cleanInput($data) 
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

}
?> 

			<h2>Submit a New Bounty</h2>
		<p><span class="error">Enter the title of the bounty you wish to delete.</span></p>
		
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				Bounty Title:<br>
				<input type="text" name="title" value="<?php echo $title;?>">
				<span class="error">* <?php echo $titleErr;?></span>
				
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
				
				Is active?:<br>
				<input type="text" name="active" value="<?php echo $active;?>">
				<br><br>
				
				<input type="submit" name="submit" value="Delete"> 
			</form>

<?php

if ($bountyDeleted == $CONFIRM)
{
	print "Please confirm that this is the bounty that you wish to delete! Click \"delete\" once you are sure.";
}

if ($bountyDeleted == $FAILURE)
{
	print "Bounty deletion failed! (Could not find bounty)";
}

if ($bountyDeleted == $SUCCESS)
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
