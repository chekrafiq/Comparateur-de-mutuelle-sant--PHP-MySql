#!/usr/bin/perl
#------------------------------------------------
# created by Francois-Xavier BOIS <fx@kernix.com>
#------------------------------------------------

$version = "0.2";
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

