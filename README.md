This is a simple bounty board written in PHP/HTML/CSS for Myriadcoin (http://myriadplatform.org/). It allows you to create bounties, update and delete them. All bounty data is stored in a simple text file.

Due to long loading times, the bounty list is generated whenever someone modifies the content of the bounties file.

Notes:

In order to make this work, you will need to chown some files in your web directory.

    chown -R www-data bounties.dat
    chown -R www-data tmpDeleteBounty.dat
    php updateIndex.php
    chown -R www-data index.php
    
The third one creates the index.php file, which you need to chown in order to have it properly update when users alter bounties.

In order to get the address information to display for other coins, you'll either need to set up an ABE block explorer for the coin, or find an existing explorer and modify the "bountyHandler.php" file accordingly to reflect the new URLs.

Cryptonote coins will not work with the bounty board as it currently is (due to their long public addresses). You would need to change the address length requirement in the update and submit forms to make a working bountyboard for them.

If you like/use this software, please consider dropping a donation!

----------------------------------------------------------------------------------------------------

Donations:

BTC: 15Jqeqcd9j6ftvpid5wQt9jgwCFPwuraSX

MYR: MNYERWCHqrH1EkGNpF4T8o8dGB391A5jmm

XMR: 46ssJmeX4Lc3NbXxzhutFn3RKJkRQx73PQW2Md8PadgqHz7WXGTK1V8hboV6XcceFYJuGppyQCZtw2U4TXvyjk8446XEyRM

VTC: VdTVVEQfUyMQAMgCgpHRqZVyyEm4SoJVAW


----------------------------------------------------------------------------------------------------
