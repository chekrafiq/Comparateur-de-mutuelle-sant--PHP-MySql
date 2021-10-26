#!/usr/bin/perl
#------------------------------------------------
# created by Francois-Xavier BOIS <fx@kernix.com>
#------------------------------------------------

$version = "0.3";
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
	if ($line =~ /DONT DELETE THIS MESSAGE/)
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

