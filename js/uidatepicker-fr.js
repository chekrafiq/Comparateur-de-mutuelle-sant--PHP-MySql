/* French initialisation for the jQuery UI date picker plugin. */
/* Written by Keith Wood (kbwood@iprimus.com.au) and St�phane Nahmani (sholby@sholby.net). */

jQuery(function($){
	$.datepicker.regional['fr'] = {clearText: 'Effacer', clearStatus: '',
		closeText: 'Fermer', closeStatus: 'Fermer sans modifier',
		prevText: '&lt;Pr�c', prevStatus: 'Voir le mois pr�c�dent',
		nextText: 'Suiv&gt;', nextStatus: 'Voir le mois suivant',
		currentText: 'Courant', currentStatus: 'Voir le mois courant',
		monthNames: ['janvier','f�vrier','mars','avril','mai','juin',
		'juillet','ao�t','septembre','octobre','novembre','d�cembre'],
		monthNamesShort: ['Jan','F�v','Mar','Avr','Mai','Jun',
		'Jul','Ao�','Sep','Oct','Nov','D�c'],
		monthStatus: 'Voir un autre mois', yearStatus: 'Voir un autre ann�e',
		weekHeader: 'Sm', weekStatus: '',
		dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
		dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
		dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
		dayStatus: 'Utiliser DD comme premier jour de la semaine', dateStatus: 'Choisir le DD, MM d',
		dateFormat: 'dd/mm/yy', firstDay: 0, 
		initStatus: 'Choisir la date', isRTL: false};
	$.datepicker.setDefaults($.datepicker.regional['fr']);
});
