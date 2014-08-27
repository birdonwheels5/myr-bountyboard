// Display all bounties formatted for the home page (includes Myriadcoin address from block explorer).
function displayBounties($fileName)
{
	$bounties = array();
	$bounties = readBounties($fileName);
	
	$bountyCount = countBounties($fileName);
	
	for($i = 1; $i <= $bountyCount; $i++)
	{
		if ((strcmp(stristr($bounties[$i]->getActive(), "true"), $bounties[$i]->getActive()) == 0))
		{
			print "<div class=\"activeBounty\" style=\"color:black;\"><div class=\"box\"><p>" . $bounties[$i]->getTitle() . "</p>";
			print "</div><div class=\"descBox\" style=\"color:black;\"><p>" . $bounties[$i]->getDescription() . "</p>";
			$addressTotal = getAddressTotal($bounties[$i]->getMyrAddress());
			print "</div><div class=\"box\" style=\"color:black;\"><center><p>" . $addressTotal . "</p></center>";
			print "</div><div class=\"addressBox\" style=\"color:black;\"><p><a href=\"http://birdonwheels5.no-ip.org:3000/address/" . $bounties[$i]->getMyrAddress() . "\">" . $bounties[$i]->getMyrAddress() . "</a></p>";
			$donationCount = getDonationCount($bounties[$i]->getMyrAddress());
			print "</div><div class=\"numberBox\" style=\"color:black;\"><center><p>" . $donationCount . "</p></center>";
			print "</div><div class=\"box\" style=\"color:black;\"><p>" . $bounties[$i]->getUserName() . "</p>";
			print "</div></div>";
		}
		else
		{
			print "<div class=\"inActiveBounty\" style=\"color:black;\"><div class=\"box\"><p>" . $bounties[$i]->getTitle() . "</p>";
			print "</div><div class=\"descBox\" style=\"color:black;\"><p>" . $bounties[$i]->getDescription() . "</p>";
			$addressTotal = getAddressTotal($bounties[$i]->getMyrAddress());
			print "</div><div class=\"box\" style=\"color:black;\"><center><p>" . $addressTotal . "</p></center>";
			print "</div><div class=\"addressBox\" style=\"color:black;\"><p><a href=\"http://birdonwheels5.no-ip.org:3000/address/" . $bounties[$i]->getMyrAddress() . "\">" . $bounties[$i]->getMyrAddress() . "</a></p>";
			$donationCount = getDonationCount($bounties[$i]->getMyrAddress());
			print "</div><div class=\"numberBox\" style=\"color:black;\"><center><p>" . $donationCount . "</p></center>";
			print "</div><div class=\"box\" style=\"color:black;\"><p>" . $bounties[$i]->getUserName() . "</p>";
			print "</div></div>";
		}
	}
}
