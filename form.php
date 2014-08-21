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
$bountyTitleErr = $myrAddressErr = $userNameErr = "";
$bountyTitle = $description = $myrAddress = $userName = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
	if (empty($_POST["bountyTitle"])) 
	{
		$bountyTitleErr = A title is required";
    } 
    else 
    {
		$bountyTitle = cleanInput($_POST["bountyTitle"]);
    }
     
    if (empty($_POST["myrAddress"])) 
	{
		$myrAddress = "A Myriadcoin address is required";
    } 
	else 
	{
      $myrAddress = cleanInput($_POST["myrAddress"]);
    }

    if (empty($_POST["description"])) 
	{
      $descriptionErr = "A description of your bounty is required";
    } 
	else 
	{
      $description = cleanInput($_POST["description"]);
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
    $data = htmlspecialchars($data);
    return $data;
}
?> 

		<h2>PHP Form Validation Example</h2>
		<p><span class="error">* required field.</span></p>
			<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
			userName: <input type="text" userName="userName" value="<?php echo $userName;?>">
			<span class="error">* <?php echo $userNameErr;?></span>
			<br><br>
			E-mail: <input type="text" userName="bountyTitle" value="<?php echo $bountyTitle;?>">
			<span class="error">* <?php echo $bountyTitleErr;?></span>
			<br><br>
			myrAddress: <input type="text" userName="myrAddress" value="<?php echo $myrAddress;?>">
			<span class="error"><?php echo $myrAddressErr;?></span>
			<br><br>
			description: <textarea userName="description" rows="5" cols="40"><?php echo $description;?></textarea>
			<br><br>
			<input type="submit" userName="submit" value="Submit"> 
	</form>

<?php
echo "<h2>Your Input:</h2>";
echo $userName;
echo "<br>";
echo $bountyTitle;
echo "<br>";
echo $myrAddress;
echo "<br>";
echo $description;
?>

	</body>
</html>
