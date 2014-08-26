<!DOCTYPE HTML> 
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Update Bounty</title>
		<link rel="stylesheet" type="text/css" href="styles.css" title="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	
	<body> 
	
	


<?php

// This doesn't work yet!

include "bountyHandler.php";


// define variables and set to empty values
$titleErr = $descriptionErr = $myrAddressErr = $userNameErr = $activeErr = "";
$title = $description = $myrAddress = $userName = $active = "";

$WAITING = -1;
$FAILURE = 1;
$SUCCESS = 0;

$fileName = "bounties.dat";
$bountyUpdated = $WAITING;
$redirectURL = "https://birdonwheels5.no-ip.org/myr-bountyboard/";

$bounties = array();
$bounties = readBounties($fileName);

$separator = "qpwoeiruty";
$empty = "";

$bountyNumber = -1;


if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$bountyNumber = searchBounty($fileName, $_POST["title"]);
	
	if (empty($_POST["title"])) 
	{
		$titleErr = "A title is required";
	}
	else 
    	{
    		if ($bountyNumber > 0)
    		{
    				$title = $bounties[$bountyNumber]->getTitle();
    		}
    		else
    		{
    			$titleErr = "That bounty could not be found";
    		}
    	}

    	if (empty($_POST["description"])) 
	{
      		$descriptionErr = "A description of your bounty is required";
    	} 
	else 
	{
      		$description = cleanInput($_POST["description"]);
    	}
    
	if (empty($_POST["myrAddress"]) or trim(strlen($_POST["myrAddress"])) != 34 ) 
	{
		$myrAddressErr = "A valid Myriadcoin address is required";
    	} 
	else 
	{
      		$myrAddress = cleanInput($_POST["myrAddress"]);
    	}
   
    	if (empty($_POST["userName"])) 
	{
      		$userNameErr = "Your username is required";
    	} 
	else 
	{
      		$userName = cleanInput($_POST["userName"]);
    	}
    	
    	if (empty($_POST["active"]))
    	{
    		$active = "true";
    	}
    	else
    	{
    		$active = cleanInput($_POST["active"]);
    	}


if ((strcmp($title, $empty) == 0) or (strcmp($description, $empty) == 0) or (strcmp($myrAddress, $empty) == 0) 
				  or (strcmp($userName, $empty) == 0))
{
	$bountyUpdated = $FAILURE;
}
else
{
	removeBounty($fileName, $bountyNumber);
	file_put_contents($fileName, "title: " . $title . "\n" . "desc: " . $description  . "\n" . "addr: " . 
			  $myrAddress . "\n" . "user: " . $userName . "\n" . "active: " . $active . "\n" . 
			  $separator . "\n", FILE_APPEND);

	$bountyUpdated = $SUCCESS;
}
}


function cleanInput($data) 
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}

?> 
		<header style="color:#fff;">
		
			<center><h1>Update Bounty Form</h1></center>
			
		</header>
		
			<nav>

			<hr/>
			<center><h2>Update a Bounty</h2></center>
			<hr/>
		<p><span class="error">Enter the information for the bounty you wish to update.<br/><br/>
					Unfortunately, for now you will need to paste description/address/username<br/>
					in from the side, then edit it.<br/><br/>
					(Title autocompletes if you hit enter)</span></p>
		
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				Bounty Title: (You only need to type the first few letters)<br>
				<input type="text" name="title" value="<?php echo $title;?>">
				<span class="error">* <?php echo $titleErr;?></span>
				
				<br><br>
				Bounty Description:<br>
				<textarea name="description" rows="5" cols="35"><?php echo $description;?></textarea>
				<span class="error">* <?php echo $descriptionErr;?></span>
				<br><br>
				
				Myriadcoin Address: <br>
				<textarea name="myrAddress" rows="1" cols="35"><?php echo $myrAddress;?></textarea>
				<span class="error">* <?php echo $myrAddressErr;?></span>
				<br><br>
				
				Username:<br>
				<input type="text" name="userName" value="<?php echo $userName;?>">
				<span class="error">* <?php echo $userNameErr;?></span>
				<br><br>
				
				Is active?: (Set to <b>false</b> if someone is working on the bounty, otherwise leave it alone)<br>
				<input type="text" name="active" value="<?php echo $active;?>">
				<br><br>
				
				<input type="submit" name="submit" value="Update">
			</form>
			

<?php

if ($bountyUpdated == $FAILURE)
{
	print "<hr/>";
	print "<h3>Status:</h3><br>";
	print "<hr/>";
	print "Bounty update failed!";
}

if ($bountyUpdated == $SUCCESS)
{
	print "<hr/>";
	print "<h3>Status:</h3>";
	print "<hr/>";
	print "Bounty updated!";
	print "The updated bounty will appear the next time the bounty page is refreshed. (Refreshed on the hour)";
	print "<br>";
	print "Redirecting to bounty page...";
	header("Refresh: 0, URL = " . $redirectURL);
	exit;
}

?>
			</nav>
			
			<nav>
				<p><h3>Current Bounties:</h3></p>
				<hr/>
				<p><?php displayBountyInfo($fileName) ?></p>
			</nav>

	</body>
</html>
