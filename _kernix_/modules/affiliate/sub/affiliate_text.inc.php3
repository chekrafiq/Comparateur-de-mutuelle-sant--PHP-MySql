<center><b>Conditions de partenariat</center></b>
<br><br>
Vous �tes sur le site web <?php print("$g_sitename");?> de la soci�t� <?php print("$adm->companyname");?>, identifi�e comme suit :
<br>
<br>
<table bgcolor=#444F5F border=0 cellspacing=1 cellpadding=1 width=100%>

 <tr>
  <td align="center" class=caddiecellname>
   Soci�t� 
  </td>
  <td align="center" class=caddiecellvalue>
   <?php print($adm->companyname); ?><br> 
   <?php print($adm->forme); ?> au capital de <?php print($adm->capital); ?><br> 
   <?php print($adm->siret); ?><br>
 N�TVA: <?php print($adm->num_tva); ?> - APE: <?php print($adm->ape); ?>
  </td>
 </tr>

 <tr>
  <td align="center" class=caddiecellname>
   Adresse
  </td>
  <td align="center" class=caddiecellvalue>
   <?php print($adm->address); ?> 
  </td>
 </tr>

 <tr>
  <td align="center" class=caddiecellname>
   Ville
  </td>
  <td align="center" class=caddiecellvalue>
   <?php print($adm->town); print(" ( $adm->zipcode )");  ?> 
  </td>
 </tr>

 <tr>
  <td align="center" class=caddiecellname>
   Pays
  </td>
  <td align="center" class=caddiecellvalue>
   <?php print($adm->country); ?> 
  </td>
 </tr>

 <tr>
  <td align="center" class=caddiecellname>
   T�l�phone
  </td>
  <td align="center" class=caddiecellvalue>
   <?php print($adm->phone1); ?> <br>
   <?php print($adm->phone2); ?> 
  </td>
 </tr>

 <tr>
  <td align="center" class=caddiecellname>
   Fax
  </td>
  <td align="center" class=caddiecellvalue>
   <?php print($adm->fax); ?> 
  </td>
 </tr>

 <tr>
  <td align="center" class=caddiecellname>
   Email
  </td>
  <td align="center" class=caddiecellvalue>
   <?php print($adm->email); ?> 
  </td>


</table>
<br>
En validant votre affiliation, vous acceptez toutes les clauses des conditions de partenariat d�finies ci-apr�s, et uniquement celles-ci.
<br>
Nous vous engageons donc � en prendre attentivement connaissance.
<br><br>
<b>Article 1: Obligation du partenaire</b>
<br>
Mettre en bonne place sur son site une banni�re fournie par <?php print("$adm->companyname");?> ou un texte de son choix avec le lien d'acc�s au site <?php print("$g_sitename");?> qui est indiqu� au moment de l'inscription online ou via l'interface de suivi de votre compte d'affiliation. 
<br>
Fournir � <?php print("$adm->companyname");?> de bonne foie, toutes les informations demand�es dans le formulaire d'inscription online. 
<br><br>
<b>Article 2 : Obligation de <?php print("$adm->companyname");?></b>
<br>
Fournir trimestriellement au partenaire un �tat des ventes r�alis�es par son interm�diaire (s'il y a eu ventes), avec le r�glement par ch�que correspondant. 
<br><br>
<b>Article 3 :</b>
<br>
<?php print("$adm->companyname");?> reste libre d'accepter ou non un partenariat, ou d'y mettre fin, sans justification.
<br><br>
<b>Article 4 :</b>
<br>
<?php print("$adm->companyname");?> reste propri�taire de l'int�gralit� de son site et le partenaire ne pourra en aucune mani�re avoir acc�s � son contenu ou � sa comptabilit�.
<br><br>
<b>Article 5 :</b>
<br>
Le partenaire peut mettre fin au partenariat quand il le souhaite, apr�s en avoir averti <?php print("$adm->companyname");?> par simple e-mail, huit jours avant. Il en est de m�me pour <?php print("$adm->companyname");?>.
<br><br>
<b>Article 6 :</b>
<br>
Seules les ventes effectives seront r�mun�r�es sur la base de <b><?php print("$adm->affiliaterate");?>%</b> par vente. Les "clics" et les simples visites ne sont pas r�mun�r�s.
<br><br>
<b>Article 7 :</b>
<br>
Les achats directs effectu�s ult�rieurement par le visiteurs ne sont pas r�mun�r�s.
<br>
<center><?php show_back();?></center>

