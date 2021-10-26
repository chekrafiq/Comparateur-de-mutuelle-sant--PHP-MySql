<br>
<table width=90%>
<tr>
 <td class=color3>:: conseils g�n�raux
 </td>
</tr>
<tr>
 <td class=help>
Le langage HTML est un langage informatique tr�s simple. Le conna�tre vous permettra tr�s facilement d'enrichir visuellement votre contenu.
<br><br>
Pour plus de d�tail sur le HTML, vous pouvez t�l�charger un fichier d'aide Windows en <a href="<?=$g_externpath?>/html40hlp.zip" class=link>cliquant ici</a>.<br><br>
 </td>
</tr>
<tr>
 <td class=color3>:: effets sur le texte
 </td>
</tr>
<tr>
 <td class=help>

<table width=98%>
<tr>
 <td class=help width=30% valign=top><img src=/pictures/adm/point.gif>&nbsp;<strong>gras</strong>
 </td>
 <td class=help>pour obtenir un mot (ou une phrase) en gras il suffit de l'entourer des balises suivantes &lt;strong&gt;...&lt;/strong&gt; 
 </td> 
</tr>
<tr>
 <td class=help valign=top><img src=/pictures/adm/point.gif>&nbsp;<i>italique</i>
 </td>
 <td class=help>balises &lt;i&gt;...&lt;/i&gt;
 </td> 
</tr>
<tr>
 <td class=help valign=top><img src=/pictures/adm/point.gif>&nbsp;<strike>barr�</strike>
 </td>
 <td class=help>balises &lt;strike&gt;...&lt;/strike&gt;
 </td> 
</tr>
<tr>
 <td class=help valign=top><img src=/pictures/adm/point.gif>&nbsp;<u>soulign�</u>
 </td>
 <td class=help>balises &lt;u&gt;...&lt;/u&gt;
 </td> 
</tr>
<tr>
 <td class=help valign=top><img src=/pictures/adm/point.gif>&nbsp;<small>petit</small>
 </td>
 <td class=help>balises &lt;small&gt;...&lt;/small&gt;
 </td> 
</tr>
<tr>
 <td class=help valign=top><img src=/pictures/adm/point.gif>&nbsp;texte<sup>exposant</sup>
 </td>
 <td class=help>balises &lt;sup&gt;...&lt;/sup&gt;
 </td> 
</tr>
<tr>
 <td class=help valign=top><img src=/pictures/adm/point.gif>&nbsp;<font size=+1>plus grand</font>
 </td>
 <td class=help>balises &lt;font size=+1&gt;...&lt;/font&gt;
 </td> 
</tr>
<tr>
 <td class=help valign=top><img src=/pictures/adm/point.gif>&nbsp;<font color=red>couleur</font>
 </td>
 <td class=help>balises &lt;font color=red&gt;...&lt;/font&gt;<br>
 autres couleurs : yellow, blue, green ...<br>
 vous pouvez utiliser le mode RGB, ex : #CCCCCC
 </td> 
</tr>
<tr>
 <td class=help valign=top colspan=2><br> <b>ATTENTION</b> : si vous voulez afficher plus d'un espace vous devez utiliser le caract�re sp�ciale : &amp;nbsp;
 </td>
</tr>
</table>
<br>

 </td>
</tr>

<tr>
 <td class=color3>:: exemple
 </td>
</tr>

<tr>
 <td class=help align=center>
<br>
<form>
<textarea cols=65 rows=4 class=text><b>ceci</b> <i>est</i> <font size=+1>un</font>  &amp;nbsp;&amp;nbsp; <small><u>test</u></small></textarea>
</form>
<b>ceci</b> <i>est</i> <font size=+1>un</font> &nbsp;&nbsp;<small><u>test</u></small><br><br>
 </td>
</tr>

<tr>
 <td class=color3>:: ajouter un lien
 </td>
</tr>
<tr>
 <td class=help>
 Pour inclure un lien vers une page au sein d'un texte il suffit de connaitre l'adresse (ou URL) de cette derni�re et d'utiliser les balises suivantes 
&lt;a href=adresse&gt;nom du lien&lt;/a&gt;
<br>
 </td>
</tr>
<tr>
 <td class=help align=center>
<br>
<form>
<textarea cols=65 rows=4 class=text>ceci est un lien sur 
<a href=http://www.lemonde.fr> le site du monde </a></textarea>
</form>
ceci est un lien sur <a href=http://www.lemonde.fr>le site du monde</a>
<br><br>
</td>
</tr>

<tr>
 <td class=help>
pour faire un lien vers une des pages du site KWO, l'adresse ou url s'�crit "/?p_idref=XX" ou XX est le du num�ro de page (valeur indiqu�e dans le back office KWO en haut de chaque onglet de page, apr�s le #).<br>
la commande devient donc &lt;a href="/?p_idref=XX"&gt;nom du lien&lt;/a&gt;<br>
 </td>
</tr>
<tr>
 <td class=help align=center>
<br>
<form>
<textarea cols=65 rows=4 class=text>ceci est un lien vers la page d'accueil de votre site KWO 
<a href=/?p_idref=2> accueil du site </a></textarea>
</form>
ceci est un lien sur <a href=/?p_idref=2> accueil du site </a>
<br><br>
</td>
</tr>

<tr>
 <td class=help>
pour ouvrir le site dans une nouvelle fen�tre la commande devient <br>&lt;a href="adresse" target="fenetre2"&gt;nom du lien&lt;/a&gt;<br>
pour ouvrir d'autres liens dans d'autres fen�tres utilisez un autre mot que fenetre2
<br><br>
 </td>
</tr>
<tr>
 <td class=help>
<a name=TITLE></a>pour avoir une petite <a href=#TITLE title="ceci est un texte contextuel tr�s util pour la navigation">fenetre</a> qd on passe au dessus du lien : <br>&lt;a href="adresse" title="ceci est un texte"&gt;nom du lien&lt;/a&gt;
<br><br>
 </td>
</tr>

<tr>
 <td class=color3>:: ajouter une image
 </td>
</tr>
<tr>
 <td class=help>
 Pour inclure une image les balises sont 
&lt;img src=adresse&gt;
<br>
 </td>
</tr>
<tr>
 <td class=help align=center>
<br>
<form>
<textarea cols=65 rows=4 class=text>ceci est une image 
<img src=/pictures/adm/logo_right.gif></textarea>
</form>
ceci est une image <img src=/pictures/adm/logo_right.gif>
<br><br>
</td>
</tr>
<tr>
 <td class=help>
Si vous voulez inclure une image qui a �t� envoy�e sur le serveur l'adresse est alors : /upload/pictures/nom_de_votre_image
<br><br>
ex : /upload/pictures/logo.gif
<br><br>
 </td>
</tr>

<tr>
 <td class=color3>:: g�rer les alignements
 </td>
</tr>
<tr>
 <td class=help>
 Pour placer un texte ou une image � gauche, au centre ou � droite sur votre page, les balises entourant la partie � placer sont 
&lt;div align=alignement&gt; ... &lt;/div&gt;
<br>
 les "alignements" possibles sont :
 </td>
</tr>
<tr>
 <td class=help>

<table width=98%>
<tr>
 <td class=help valign=top><div align=left><img src=/pictures/adm/point.gif>&nbsp;gauche</div>
 </td>
 <td class=help>balises &lt;div align=left&gt;...&lt;/div&gt;
 </td> 
</tr>
<tr>
 <td class=help valign=top><div align=center><img src=/pictures/adm/point.gif>&nbsp;centr�</div>
 </td>
 <td class=help>balises &lt;div align=center&gt;...&lt;/div&gt;
 </td> 
</tr>
<tr>
 <td class=help valign=top><div align=right><img src=/pictures/adm/point.gif>&nbsp;droite</div>
 </td>
 <td class=help>balises &lt;div align=right&gt;...&lt;/div&gt;
 </td> 
</tr>
</table>
<br>

 </td>
</tr>

</table>


<br><br><br>
