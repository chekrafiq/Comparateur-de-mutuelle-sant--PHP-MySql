#!/usr/bin/perl
#----------------------------------------------
# created by Francois-Xavier BOIS <fx@inerd.fr>
#----------------------------------------------

$version = "0.1";
$spool = "/var/spool/mail";
$user = "@ARGV[0]";
$msgid = "@ARGV[1]";

open (FILE,"$spool/$user");
$nbmail = 0;
$i++;
$out = "";
while ($line = <FILE>)
{
    if ($line =~ /$msgid/ig)
    {
#	$out = "$line";
	while (!(($line = <FILE>) =~ /^\n/ig))
	{
#	    print "--> $line";
	}
	while (!(($line = <FILE>) =~ /^From/ig) && $line) 
	{
#	    $line = <FILE>;
	    chop $line;
	    $out .= "<br>" . $line;
#	    print "--> $out\n";
	}
    }
}
close (FILE);

print "$out";

########## F U N C T I O N S #########----------------------------------------

sub find_opt
{
    $opt = @_[0];
    local ($i);
    for ($i = 0; $i <= $#ARGV; $i++)
    {
	if ($ARGV[$i] eq $opt)
	{
	    return $i;
	}
    }
    return -1;
}

sub warning
{
    print "\nCheckmail v$version \n";
    print "----------------------- \n";
    print "Usage :	checkmail.pl compte \n"; 
    print "	[-q 1/2 ] [-ip 79-83] [-check] [-help] \n\n";
    print "Options : \n";
    print "-q val		: set the quota = 1 (little) / 2 (big) (default 1)\n";
    print "-ip 79-83	: site associe a l'@ 212.23.192.79-83 (default 79)\n";
    print "-check		: only checks for problems \n";
    print "-nobdd		: disable bdd access";
    print "-help		: show this \n";
    print "\n [ ex : create_web_account.pl inerd inerd.fr ] \n";
    exit;
}
