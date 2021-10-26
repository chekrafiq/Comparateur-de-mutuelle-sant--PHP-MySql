#!/usr/bin/perl
#
# wget -O - http://boutique.fimatex.fr/extern/cron/daily.php3?p_action=yes

print "\nKerniX CRON \n\n";

$basedir = "/var/web";

chdir "$basedir";

@tab_rep = <*>;

for ( $i=0; $i<=$#tab_rep; $i++)
{
    $accountname = $tab_rep[$i];
    print " - performing [$accountname] ... ";
    if (-e "$basedir/$accountname/www/_kernix_/bin/CRON/cron.php")
    {
	print " + cron\n";
	chdir "$basedir/$accountname/www/_kernix_/bin/CRON";
	`cron.php`;
    }
    if (-e "/var/web/bin/htdig/dig$accountname") 
    {
	print " + htdig\n";
	chdir "/var/web/bin/htdig";
#	`dig$accountname`;
    }
    print "\n";
}

exit 0;
