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
$bountyTitleErr = $descriptionErr $myrAddressErr = $userNameErr = "";
$bountyTitle = $description = $myrAddress = $userName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	if (empty($_POST["bountyTitle"])) 
	{
		$bountyTitleErr = "A title is required";
    } 
    else 
    {
		$bountyTitle = cleanInput($_POST["bountyTitle"]);
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
		$myrAddress = "A Myriadcoin address is required";
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
}

function cleanInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?> 

		<h2>Submit a New Bounty</h2>
		<p><span class="error">* required field.</span></p>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
			Bounty Title: <input type="text" name="bountyTitle" value="<?php echo $bountyTitle;?>">
			<span class="error">* <?php echo $bountyTitleErr;?></span>
			<br><br>
			Bounty Description: <textarea name="description" rows="5" cols="40"><?php echo $description;?></textarea>
			<br><br>
			Myriadcoin Address: <input type="text" name="myrAddress" value="<?php echo $myrAddress;?>">
			<span class="error"><?php echo $myrAddressErr;?></span>
			<br><br>
			Username: <input type="text" name="userName" value="<?php echo $userName;?>">
			<span class="error">* <?php echo $userNameErr;?></span>
			<br><br>
			<input type="submit" name="submit" value="Submit"> 
	</form>

<?php
echo "<h2>Your Input:</h2>";
echo $bountyTitle;
echo "<br>";
echo $myrAddress;
echo "<br>";
echo $description;
echo "<br>"
echo $userName;
?>

	</body>
</html>
