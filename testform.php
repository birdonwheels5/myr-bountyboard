<!DOCTYPE HTML> 
<html>
	<head>
		<style>
			.error {color: #FF0000;}
		</style>
	</head>
	
	<body> 

<?php
// define variables and set to empty values
$titleErr = $descriptionErr = $myrAddressErr = $userNameErr = "";
$title = $description = $myrAddress = $userName = "";

$WAITING = -1;
$FAILURE = 1;
$SUCCESS = 0;

$bountySubmitted = WAITING;

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

    	if (empty($_POST["description"])) 
	{
      		$descriptionErr = "A description of your bounty is required";
    	} 
	else 
	{
      		$description = cleanInput($_POST["description"]);
    	}
    
	if (empty($_POST["myrAddress"])) 
	{
		$myrAddressErr = "A Myriadcoin address is required";
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
$separator = "-";
$empty = "";
$active = "true";

if((strcmp($title, $empty) == 0) or (strcmp($description, $empty) == 0) or (strcmp($myrAddress, $empty) == 0) or (strcmp($userName, $empty) == 0))
{
	$bountySubmitted = FAILURE;
}
else
{
	$bountySubmitted = SUCCESS;
	file_put_contents($fileName, "title: " . $title . "\n" . "desc: " . $description  . "\n" . "addr: " . $myrAddress . "\n" . "user: " . $userName . "\n" . "active: " . $active . "\n" . $separator . "\n", FILE_APPEND);
}
}

function cleanInput($data) 
{
    $data = trim($data);
    $data = ltrim($data,"^M");
    $data = htmlspecialchars($data);
    return $data;
}
?> 

			<h2>Submit a New Bounty</h2>
		<p><span class="error">* required field.</span></p>
		
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
				Bounty Title:<br>
				<input type="text" name="title" value="<?php echo $title;?>">
				<span class="error">* <?php echo $titleErr;?></span>
				
				<br><br>
				Bounty Description:<br>
				<textarea name="description" rows="5" cols="40"><?php echo $description;?></textarea>
				<span class="error">* <?php echo $descriptionErr;?></span>

				<br><br>
				
				Myriadcoin Address: <br>
				<input type="text" name="myrAddress" value="<?php echo $myrAddress;?>">
				<span class="error">* <?php echo $myrAddressErr;?></span>
				<br><br>
				
				Username:<br>
				<input type="text" name="userName" value="<?php echo $userName;?>">
				<span class="error">* <?php echo $userNameErr;?></span>
				<br><br>
				
				<input type="submit" name="submit" value="Submit"> 
			</form>

<?php
if ($bountySubmitted == FAILURE)
{
	print "Bounty submission failed!";
	print $description;
}
else if ($bountySubmitted == SUCCESS)
{
	print "Bounty submission successful!";
	print "<br>";
	print "Redirecting to bounty page...";
	header("Refresh: 3, URL = https://birdonwheels5.no-ip.org/myr-bountyboard/");
	exit;
}
?>

	</body>
</html>
