This is a simple bounty board written in PHP/HTML/CSS for Myriadcoin (http://myriadplatform.org/). It allows you to create bounties, update and delete them. All bounty data is stored in a simple text file.

Due to long loading times, the bounty list is generated whenever someone modifies the content of the bounties file.

Notes:

In order to make this work, you will need to chown some files in your web directory.

    chown -R www-data bounties.dat
    chown -R www-data tmpDeleteBounty.dat
    php updateIndex.php
    chown -R www-data index.php
    
The third one creates the index.php file, which you need to chown in order to have it properly update when users alter bounties.

If you use this software and it helps you, please consider dropping me a donation!

----------------------------------------------------------------------------------------------------

Donations:

BTC: 15Jqeqcd9j6ftvpid5wQt9jgwCFPwuraSX

MYR: MNYERWCHqrH1EkGNpF4T8o8dGB391A5jmm

XMR: 46ssJmeX4Lc3NbXxzhutFn3RKJkRQx73PQW2Md8PadgqHz7WXGTK1V8hboV6XcceFYJuGppyQCZtw2U4TXvyjk8446XEyRM

VTC: VdTVVEQfUyMQAMgCgpHRqZVyyEm4SoJVAW


----------------------------------------------------------------------------------------------------

PS. After looking at the Monero address length, it will not work with the bounty board. You would need to change the address length requirement in the update and submit forms.
