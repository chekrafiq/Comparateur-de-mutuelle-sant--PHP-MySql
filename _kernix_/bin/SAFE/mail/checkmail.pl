#!/usr/bin/perl
#----------------------------------------------
# created by Francois-Xavier BOIS <fx@inerd.fr>
#----------------------------------------------

$version = "0.2";
$spool = "/var/spool/mail";
$user = "@ARGV[0]";

open (FILE,"$spool/$user");
$nbmail = 0;
$i++;
$out = "";
while ($line = <FILE>)
{
    if ($line =~ /^From: /ig)
    {
	$from = substr($line,5);
	chop $from;
	$nbmail++;
    }
    if ($line =~ /^Date: /ig)
    {
	$date = substr($line,5);
	chop $date;
    }
    if ($line =~ /^Message-Id: /ig)
    {
	$msgid = substr($line,13);
	chop $msgid;
	chop $msgid;
	($msgid,$null) = split(/\@/,$msgid) 
    }
    if ($line =~ /^Subject: /ig)
    {
	if ($line =~ /DON'T DELETE THIS MESSAGE/)
	{
	#    print "pb\n";
	    $nbmail--;
	}
	else
	{
	    $subject = substr($line,8);
	    chop $subject;
	    $tab[$i][0] = $from;
	    $tab[$i][1] = $subject;
	    $tab[$i][2] = $date;
            $tab[$i][3] = $msgid;
	    $out = "$tab[$i][0];;$tab[$i][1];;$tab[$i][2];;$tab[$i][3]||" . $out;
            $i++;
	}
    }
    
}
close (FILE);

$out = "OK||$nbmail##" . $out;
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
