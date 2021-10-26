<center><b>Conditions de partenariat</center></b>
<br><br>
Vous êtes sur le site web <?php print("$g_sitename");?> de la société <?php print("$adm->companyname");?>, identifiée comme suit :
<br>
<br>
<table bgcolor=#444F5F border=0 cellspacing=1 cellpadding=1 width=100%>

 <tr>
  <td align="center" class=caddiecellname>
   Société 
  </td>
  <td align="center" class=caddiecellvalue>
   <?php print($adm->companyname); ?><br> 
   <?php print($adm->forme); ?> au capital de <?php print($adm->capital); ?><br> 
   <?php print($adm->siret); ?><br>
 N°TVA: <?php print($adm->num_tva); ?> - APE: <?php print($adm->ape); ?>
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
   Téléphone
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
En validant votre affiliation, vous acceptez toutes les clauses des conditions de partenariat définies ci-après, et uniquement celles-ci.
<br>
Nous vous engageons donc à en prendre attentivement connaissance.
<br><br>
<b>Article 1: Obligation du partenaire</b>
<br>
Mettre en bonne place sur son site une bannière fournie par <?php print("$adm->companyname");?> ou un texte de son choix avec le lien d'accès au site <?php print("$g_sitename");?> qui est indiqué au moment de l'inscription online ou via l'interface de suivi de votre compte d'affiliation. 
<br>
Fournir à <?php print("$adm->companyname");?> de bonne foie, toutes les informations demandées dans le formulaire d'inscription online. 
<br><br>
<b>Article 2 : Obligation de <?php print("$adm->companyname");?></b>
<br>
Fournir trimestriellement au partenaire un état des ventes réalisées par son intermédiaire (s'il y a eu ventes), avec le règlement par chèque correspondant. 
<br><br>
<b>Article 3 :</b>
<br>
<?php print("$adm->companyname");?> reste libre d'accepter ou non un partenariat, ou d'y mettre fin, sans justification.
<br><br>
<b>Article 4 :</b>
<br>
<?php print("$adm->companyname");?> reste propriétaire de l'intégralité de son site et le partenaire ne pourra en aucune manière avoir accès à son contenu ou à sa comptabilité.
<br><br>
<b>Article 5 :</b>
<br>
Le partenaire peut mettre fin au partenariat quand il le souhaite, après en avoir averti <?php print("$adm->companyname");?> par simple e-mail, huit jours avant. Il en est de même pour <?php print("$adm->companyname");?>.
<br><br>
<b>Article 6 :</b>
<br>
Seules les ventes effectives seront rémunérées sur la base de <b><?php print("$adm->affiliaterate");?>%</b> par vente. Les "clics" et les simples visites ne sont pas rémunérés.
<br><br>
<b>Article 7 :</b>
<br>
Les achats directs effectués ultérieurement par le visiteurs ne sont pas rémunérés.
<br>
<center><?php show_back();?></center>

