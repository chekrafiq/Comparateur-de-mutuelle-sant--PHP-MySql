#!/usr/bin/perl
# ---------------------------------------------
# Concerne: Ht://Dig en VF
#
# Objet: Cr�e un fichier de synonymes non-accentu�s � partir de
# la liste des mots (db.wordlist)
#
# Utilisation: trans.pl <fichier db.wordlist> <fichier de sortie>
#
# Auteur: St�phane Marzloff -> s.marzloff@carif-idf.org
# ---------------------------------------------

my(@tab,%elem);

open(AA,"$ARGV[0]");
open(BB,">$ARGV[1]");

LINE: while(<AA>)
{
	next LINE unless (/�|�|�|�|�|�|�|�|�|�|�|�|�|�/);
	@tab=split(/\t/);
	next LINE if exists $elem{$tab[0]};
	$elem{$tab[0]}=$elem{$tab[0]};
	print BB "$tab[0] ";
	$tab[0] =~ s/�|�/a/g;
	$tab[0] =~ s/�/c/g;
	$tab[0] =~ s/�|�|�|�/e/g;
	$tab[0] =~ s/�|�/i/g;
	$tab[0] =~ s/�/o/g;
	$tab[0] =~ s/�|�|�/u/g;
	print BB "$tab[0]\n";
}
