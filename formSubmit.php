<!DOCTYPE HTML> 
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Submit Bounty</title>
		<link rel="stylesheet" type="text/css" href="styles.css" title="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	
	<body link="#E2E2E2" vlink="#000000">
		
<?php

include "bountyHandler.php";

// define variables and set to empty values
$titleErr = $descriptionErr = $myrAddressErr = $userNameErr = "";
$title = $description = $myrAddress = $userName = "";

$WAITING = -1;
$FAILURE = 1;
$SUCCESS = 0;

$fileName = "bounties.dat";
$bounties = array();
$bounties = readBounties($fileName);

$bountyNumber = -1;

$bountySubmitted = $WAITING;
$redirectURL = "updateIndex.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	$bountyNumber = searchBounty($fileName, $_POST["title"]);
	
	if (empty($_POST["title"])) 
	{
		$titleErr = "A title is required";
	} 
    	else 
    	{
    		if ($bountyNumber < 1)
    		{
    			$title = cleanInput($_POST["title"]);
    		}
    		else
    		{
    			if((strcmp(stristr($_POST["title"], $bounties[$bountyNumber]->getTitle()), $_POST["title"])) == 0)
    			{
    				$titleErr = "That bounty already exists. Please specify another name.";
    			}
    			else
    			{
				$title = cleanInput($_POST["title"]);
    			}
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
    	
$fileName = "bounties.dat";
$separator = "qpwoeiruty";
$empty = "";
$active = "true";

if((strcmp($title, $empty) == 0) or (strcmp($description, $empty) == 0) or (strcmp($myrAddress, $empty) == 0) 
				 or (strcmp($userName, $empty) == 0))
{
	$bountySubmitted = $FAILURE;
}
else
{
	$bountySubmitted = $SUCCESS;
	file_put_contents($fileName, "title: " . $title . "\n" . "desc: " . $description  . "\n" . "addr: " . 
			  $myrAddress . "\n" . "user: " . $userName . "\n" . "active: " . $active . "\n" . 
			  $separator . "\n", FILE_APPEND);
}
}

function cleanInput($data) 
{
    $data = trim($data);
    $data = htmlspecialchars($data);
    return $data;
}
?> 
		<header style="background-color:transparent;">
		
			<center><h1>Submit New Bounty Form</h1></center>
			
		</header>
		
			<nav>

		<hr/>
		<center><h2>Submit a New Bounty</h2></center>
		<hr/>
		<p><span class="error">* required field.</span></p>
		
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				Bounty Title:<br>
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
				
				<input type="submit" name="submit" value="Submit"> 
			</form>


<?php
if ($bountySubmitted == $FAILURE)
{
	print "<br/>";
	print "<h3>Status:</h3>";
	print "<hr/>";
	print "Bounty submission failed!";
}
else if ($bountySubmitted == $SUCCESS)
{
	print "<br/>";
	print "<h3>Status:</h3>";
	print "<hr/>";
	print "Bounty submission successful!";
	print "<br>";
	print "Refreshing bounty page and redirecting...";
	header("Refresh: 0, URL = " . $redirectURL);
	exit;
}
?>
			</nav>

			<nav>
				<p><h3>Current Bounties:</h3></p>
				<hr/>
				<p><?php displayTitles($fileName) ?></p>
			</nav>

	</body>
</html>
