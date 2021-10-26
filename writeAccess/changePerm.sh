#!/bin/bash
#
# script quick'n'dirty realise a la demande de Fabrice pour permettre 
# a degallaix de modifier son site via FTP
#
# le script met les droits a degallaix:kernixsw 
# 


function enableFTP()
{
	# backup la liste des fichiers ownes par nobody (typiquement ceux uploades via apache)
	find /home/web/degallaix/www/ -name "*" -group nobody > $PWD/degallaix.nobody.tmp

	# passe tous les fichiers en degallaix:kernixswo pour acces via FTP (sauf mysql!)
	cd /home/web/degallaix/www/ && ls /home/web/degallaix/www/ -1 | grep -vE "mysql|writeAccess" | xargs -i chown -R degallaix: '{}'

	# remet le kexec avec les bons droits
	chown root: /home/web/degallaix/www/_kernix_/bin/kexec
	chmod +s /home/web/degallaix/www/_kernix_/bin/kexec
}

function disableFTP()
{
	cd /home/web/degallaix/www/ && ls /home/web/degallaix/www/ -1 | grep -v mysql | xargs -i chown -R root: '{}'
	cd /home/web/degallaix/www/writeAccess
	cat $PWD/degallaix.nobody.tmp | xargs -i chown nobody: '{}'
	rm  $PWD/degallaix.nobody.tmp >&/dev/null
}

if [ "$1" = "enableFTP" ]; then
	$1
elif [ "$1" = "disableFTP" ]; then
	$1
else
	exit
fi


