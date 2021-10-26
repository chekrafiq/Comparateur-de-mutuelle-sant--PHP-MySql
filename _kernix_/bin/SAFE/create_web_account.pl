#!/usr/bin/perl
#---------------------------------------------------------------------
# created by Francois-Xavier BOIS <fx@inerd.fr> <fxbois@cybercable.fr>
#---------------------------------------------------------------------

$version = "0.5";
$password_file = "/root/my_passwd";
$date_command = "/bin/date";
$big_quota = "gymnasium";
$little_quota = "trajectoire";
$quota = $little_quota;
$ip = "212.23.192.79";


if ($#ARGV < 1)
{
    warning();
    exit;
}

if (($n = find_opt("-help")) != -1)
{
    warning();
}

if ((substr($ARGV[0],0,1) eq '-') || (substr($ARGV[1],0,1) eq '-'))
{
    print "ERROR : mauvais noms. \n";
    exit;
}

if ($#ARGV >= 3)
{
    if (!(($ARGV[2]  eq '-q') || ($ARGV[2] eq '-ip') || ($ARGV[2] eq '-check') || ($ARGV[2] eq '-help') || ($ARGV[2] eq '-nobdd')))
    {
	print "ERROR : option unexpected : $ARGV[2] \n";
	exit;
    }
}

if (($n = find_opt("-q")) != -1)
{
    if ($n == $#ARGV)
    {
	warning();
    }
    $n++;
    if (($ARGV[$n] != 1) && ($ARGV[$n] != 2))
    {
	print "ERROR : parametre unexpected : $ARGV[$n] \n";
	exit;
    }
    if ($ARGV[$n] == 2)
    {
	$quota = $big_quota;
    }
}

if (($n = find_opt("-ip")) != -1)
{
    if ($n == $#ARGV)
    {
	warning();
    }
    $n++;
    if (($ARGV[$n] != 79) && ($ARGV[$n] != 80) && ($ARGV[$n] != 81) && ($ARGV[$n] != 82) && ($ARGV[$n] != 83))
    {
	print "ERROR : parametre unexpected : $ARGV[$n] \n";
	exit;
    }
    $ip = "212.23.192." . $ARGV[$n];
}


#--- VARIABLES -------

$user = "@ARGV[0]";
$userbdd = uc @ARGV[0];
$domain = "@ARGV[1]";
$homedir = "/var/web/".$user;
$wwwdir = $homedir."/www";
$uid = get_good_uid();

#---------------------



#--- VARIOUS CHECKS ----

@val = split(/\./,$domain);
if (!(($val[1] eq "fr") || ($val[1] eq "com") || ($val[1] eq "net") || ($val[1] eq "org")  || ($val[1] eq "tm") || ($val[1] eq "uk") || ($val[1] eq "es")))
{
    print "ERROR : le domaine [ $val[1] ] n'est pas valide.\n";
    exit;
}


unless  ( -e "/var/web" )
{
    print "ERROR : Le repertoire [ /var/web ] n'existe pas.\n";
    print "Il doit etre en 755!\n";
    exit;
}

unless  ( -e "/root/.my.cnf" )
{
    print " Enter your db root password : ( be careful, only one chance !) \n";
    system("stty -echo");
    chop($p = <STDIN>);
    system("stty -echo");
    open (FILE,">/root/.my.cnf");
    print FILE "[client]\n";
    print FILE "host=localhost\n";
    print FILE "user=root\n";
    print FILE "password=$p\n";
    close (FILE);
    print " + le fichier de conf mysql a ete cree.\n";
}

unless  ( -e "$password_file" )
{
    open (FILE,">$password_file");
    print FILE "Fichier Password\n";
    close (FILE);
    `chmod 600 $password_file`;
    print " + le fichier password a ete cree [$password_file].\n";
}

open (FILE,"/etc/passwd");
while (<FILE>)
{
    @val = split(/:/,$_);
    if ($val[0] eq $user)
    {
	print "ERROR : le compte $user existe deja.\n";
	exit;
    }
}
close (FILE);

if (($n = find_opt("-check")) != -1)
{
    print "\nThis seems OK.\n";
    exit;
}

#--- Virer cet exit pour activer le script !!
#exit;

#--------------------------------------------

print " o  creation du compte [$user : $uid].\n";
`useradd -c "compte $user" -d $homedir -g users -s /bin/false -u $uid $user;`;

print " o  generation du passwd.\n";
$password = generate_pwd();
$date = `$date_command`;
chop $date;
open (FILE,">>$password_file");
print FILE "$user:$password:$date:$ip\n";
close (FILE);
print " => passwd : $password \n";
#while (($r = `passwd $user`) != 0){}
`(sleep 1 ; echo $password ; sleep 1 ; echo $password ; sleep 1) | passwd $user`;

print " o  creation des sous-repertoires [$wwwdir].\n";
`mkdir $wwwdir;mkdir $wwwdir/cgi-bin;mkdir $wwwdir/adm;mkdir $wwwdir/logs;`;

print " o  creation du fichier welcome.msg.\n";
open (FILE,">$wwwdir/welcome.msg");
print FILE <<END_OF_TEXT;
---------------------------------------

          Welcome to $domain
         ====FTP server======
only Authorized people are welcome here
          all IP are logged

---------------------------------------
END_OF_TEXT
close (FILE);

print " o  changement des droits [755].\n";
`chmod -R 755  $homedir ;`;

print " o  changement de proprietaire [$user].\n";
`chown -R $user $homedir ;`;

print " o  creation du fichier .htaccess + .htpasswd .\n";
open (FILE,">$wwwdir/adm/.htaccess");
print FILE <<END_OF_TEXT;
AuthUserFile $wwwdir/adm/.htpasswd
AuthGroupFile /dev/null  
AuthName "Vous devez vous identifiez"   
AuthType Basic
require valid-user
END_OF_TEXT
close (FILE);
`htpasswd -b -c $wwwdir/adm/.htpasswd $user $passwd;`;
open (FILE,">$wwwdir/adm/readme");
print FILE <<END_OF_TEXT;
---------------------------------------

          Welcome to $domain
         ====FTP server======
only Authorized people are welcome here
          all IP are logged

---------------------------------------
END_OF_TEXT
close (FILE);

print " o  creation d'un index.html.\n";
open (FILE,">$wwwdir/index.html");
print FILE <<END_OF_TEXT;
<html>
<head></head>
<body>
<h1>$domain</h1>
</body>
</html>
END_OF_TEXT
close (FILE);
`chown $user $wwwdir/index.html;`;

print " o  creation du repertoire bdd [mysql/$userbdd].\n";
`mkdir $wwwdir/mysql; mkdir $wwwdir/mysql/$userbdd;`;

print " o  changement des droits des repertoires bdd [mysql].\n";
`chown mysql $wwwdir/mysql; chown mysql $wwwdir/mysql/$userbdd;`;

print " o  creation du lien mysql [$userbdd]. \n";
`ln -s $wwwdir/mysql/$userbdd /var/lib/mysql/$userbdd;`;
`chown mysql /var/lib/mysql/$userbdd;`;

print " o  creation de la base [$userbdd]. \n";
`echo "INSERT INTO user VALUES ('%','$user',password('$password'),'N','N','N','N','N','N','N','N','N','N','N','N','N','N');" | mysql mysql;`;
`echo "INSERT INTO db VALUES ('%','$userbdd','$user','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y');" | mysql mysql ;`;
`echo "INSERT INTO db VALUES ('%','$userbdd\\%','$user','Y','Y','Y','Y','Y','Y','Y','Y','Y','Y');" | mysql mysql ;`;

if (($n = find_opt("-nobdd")) != -1)
{
    print " o  empeche l'usage de la base. \n";
    `rm /var/lib/mysql/$userbdd;`;
}

print " o  mise en place du mail.\n";
$virtfile = "/etc/mail/virtusertable";
$cwfile = "/etc/sendmail.cw";
$tmpfile = "/etc/mail/virtusertable-$user";
$indic = 0;
open (MAILFILE,"$virtfile");
open (FILE,">$tmpfile");
while (<MAILFILE>)
{
        chop $_;
        print FILE "$_\n";
        if (/\#(\w*)$domain/)
        {
            print "virtusertable contient deja $domain !\n";
            $indic = 1;
        }
}
if ($indic == 0)
{
    print FILE "\#\n\#$domain\n\#\n";
    print FILE "$user\@$domain\t$user\n"; 
    print FILE "infos\@$domain\t$user\n";
    print FILE "info\@$domain\t$user\n";
    print FILE "www\@$domain\t$user\n";
    print FILE "webmaster\@$domain\t$user\n";
    print FILE "\@$domain\t$user\n";
}
close (FILE);
close (MAILFILE);
if (indic == 0)
{
    `cp $tmpfile $virtfile;`;
    `echo "$domain" >> $cwfile;`;
    `makemap hash $virtfile < $virtfile;`;
    `/etc/rc.d/init.d/sendmail restart;`;
}



print " o  update du fichier httpd.conf.\n";
open (FILE,">>/etc/httpd/conf/httpd.conf");
print FILE <<END_OF_TEXT;

#
# $domain
#
<VirtualHost $ip>
        ServerAdmin $user\@$domain
        NameVirtualHost $ip
        ServerName $domain
        DocumentRoot $wwwdir
        ScriptAlias /cgi-bin $wwwdir/cgi-bin
        ServerAlias www.$domain
        php3_engine On
        php3_open_basedir $wwwdir
        php3_include_path .
        php3_doc_root $wwwdir
        php3_user_dir .
        ErrorLog $wwwdir/logs/error.log
        RefererLog $wwwdir/logs/refer.log
        TransferLog $wwwdir/logs/transfer.log
        AgentLog $wwwdir/logs/agent.log
</VirtualHost>   
END_OF_TEXT
close (FILE);

print " o  restart apache.\n";
`/etc/rc.d/init.d/httpd reload;`;

print " o  set the quota [type : $quota].\n";
`edquota -p $quota $user ;`;

print " o  E.N.D.\n";

########## F U N C T I O N S #########----------------------------------------

sub get_good_uid
{
    open (FILE,"/etc/passwd");
    $i = 0;
    while (<FILE>)
    {
	@val = split(/:/,$_);
	if (($val[2] >= 500) && ($val[2] < 600))
	{
	    $tab[$i] = $val[2];
	    $i++;
	}
    }
    sort @tab;
    $tmp = $tab[$#tab] + 1;
    close (FILE);
    return $tab[$#tab] + 1;
}

sub generate_pwd
{
#    @chars = ( "A" .. "Z", "a" .. "z", 0 .. 9, qw(! @ $ % ^ & *) ); 
    @chars = ( "A" .. "Z", "a" .. "z", 0 .. 9 );
    $tmp = join("", @chars[ map { rand @chars } ( 1 .. 8 ) ]); 
    return $tmp;
}

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
    print "\nCreate Web Account v$version \n";
    print "----------------------- \n";
    print "Usage :	create_web_account.pl nom_du_compte nom_du_site\n"; 
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









