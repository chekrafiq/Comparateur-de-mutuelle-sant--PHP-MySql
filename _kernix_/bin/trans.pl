#!/usr/bin/perl
# ---------------------------------------------
# Concerne: Ht://Dig en VF
#
# Objet: Crée un fichier de synonymes non-accentués à partir de
# la liste des mots (db.wordlist)
#
# Utilisation: trans.pl <fichier db.wordlist> <fichier de sortie>
#
# Auteur: Stéphane Marzloff -> s.marzloff@carif-idf.org
# ---------------------------------------------

my(@tab,%elem);

open(AA,"$ARGV[0]");
open(BB,">$ARGV[1]");

LINE: while(<AA>)
{
	next LINE unless (/à|â|â|é|ç|è|ê|ë|î|ï|ô|ù|û|ü/);
	@tab=split(/\t/);
	next LINE if exists $elem{$tab[0]};
	$elem{$tab[0]}=$elem{$tab[0]};
	print BB "$tab[0] ";
	$tab[0] =~ s/à|â/a/g;
	$tab[0] =~ s/ç/c/g;
	$tab[0] =~ s/é|è|ê|ë/e/g;
	$tab[0] =~ s/î|ï/i/g;
	$tab[0] =~ s/ô/o/g;
	$tab[0] =~ s/ù|û|ü/u/g;
	print BB "$tab[0]\n";
}
