<br>

<?php

if (!include("$g_modulespath/include/sub/check_module.inc.php3")) return 0;

include("$g_classpath/admtablinks.php3");

$tab = new AdmTabLinks();
$tab->startTab("KWO modules");
$tab->addRow("/$g_modulespath/addressbook/adm","Carnet d'adresses","");
$tab->addRow("/$g_modulespath/egroup/adm","Liste de diffusion - Newsletter","");
$tab->addRow("/$g_modulespath/board/adm","Forum - News - FAQ","");
$tab->addRow("/$g_modulespath/theme/adm","Theme","");
$tab->addRow("/$g_modulespath/rating/adm/index.php3","Evaluation","");
$tab->addRow("/$g_modulespath/searchengine/adm","Moteur de recherche","");
$tab->addRow("/$g_modulespath/guestbook/adm","Livre d'or","");
$tab->addRow("/$g_modulespath/poll/adm","Vote","");
$tab->addRow("/$g_modulespath/form/adm","Formulaire","");
$tab->addRow("/$g_modulespath/mail/adm","Mail","");
$tab->addRow("/$g_modulespath/alert/adm","Alerte","");
$tab->addRow("/$g_modulespath/owner/adm","Propriétaire","");
$tab->addRow("/$g_modulespath/msg/adm","Message","");
$tab->addRow("/$g_modulespath/pub/adm","Publicité","");
//$tab->addRow("/$g_modulespath/gallery/adm","Galerie");
$tab->endTab();

?>

<br><br><br>
