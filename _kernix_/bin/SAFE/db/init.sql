# initialisation de la base kernix lors de la création du compte
#
# (22/12/200) : complement port-zone
#
# (22/11/2000) : ajout affiliate
#  - ajout adm
#  - ajout portzone


INSERT INTO adm (email) VALUES ('test@kernix.com');
INSERT INTO adm_site (companyname) VALUES ('XXX');
INSERT INTO adm_shop (commandwarningemail) VALUES ('shop@kernix.com,');

INSERT INTO affiliate (email,login,password,firstname,lastname,address,payableto) VALUES ('affiliation@kernix.com','kernix','kernix','kernix','kernix','22 rue de Vouille 75015 PARIS','KerniX software');

INSERT INTO affiliate_mode (label) VALUES ('pourcentage');
INSERT INTO affiliate_mode (label) VALUES ('forfait');

INSERT INTO command_status VALUES ('1', '4', 'Règlée par carte bleue en ligne');
INSERT INTO command_status VALUES ('2', '20', 'Traitée et réglée Finalisé');
INSERT INTO command_status VALUES ('3', '5', 'En attente du règlement par chèque');

INSERT INTO content (title) VALUES('root');
INSERT INTO content (title) VALUES('accueil');

INSERT INTO currency (name, value, acronymtxt, acronymhtml) VALUES ('Franc Français', '1', 'FF', 'FF');
INSERT INTO currency (name, value, acronymtxt, acronymhtml) VALUES ('Euro', '6.5596', 'E', '&euro;');
INSERT INTO currency (name, value, acronymtxt, acronymhtml) VALUES ('Dollars', '7.4', '$', '$');
INSERT INTO currency (name, value, acronymtxt, acronymhtml) VALUES ('Livre', '10.8', 'L', '£');
INSERT INTO currency (name, value, acronymtxt, acronymhtml) VALUES ('Franc Suisse', '4.3', 'FS', 'FS');

INSERT INTO currency_viewmode (label) VALUES ('monnaie du site');
INSERT INTO currency_viewmode (label) VALUES ('francs - euros');
INSERT INTO currency_viewmode (label) VALUES ('euros - dollars');
INSERT INTO currency_viewmode (label) VALUES ('francs - euros - dollars');


INSERT INTO forum VALUES('1', 'News', 'La rubrique News du site...', '0','', '0', '0', '', '1', '1', '0', '', '0');

INSERT INTO port (name) VALUES ('fixe');
INSERT INTO port (name) VALUES ('poids');
INSERT INTO port (name) VALUES ('nombre d\'article');
INSERT INTO port (name) VALUES ('montant de la commande');

INSERT INTO price_entermode (label) VALUES ('H.T.');
INSERT INTO price_entermode (label) VALUES ('T.T.C.');

INSERT INTO profile (signature) VALUES ('');

INSERT INTO property VALUES('1', 'DEFAULT', '', 'category', '0');
INSERT INTO property VALUES('2', 'DEFAULT', '', 'ref', '0');
INSERT INTO property VALUES('3', 'EMPTY', '', 'category', '0');
INSERT INTO property VALUES('4', 'EMPTY', '', 'ref', '0');

INSERT INTO pub VALUES ( '1', 'KERNIX STATIQUE', '/pictures/kernix/pub_kernix.jpg', 'http://www.kernix.com', 'PICT', '1', 'Kernix WEB OFFICE (KMO) est une solution avancée de gestion de sites portails et d\'ecommerce.

Cette solution a été développée par la société KERNIX. KERNIX est spécialisée dans les technologies avancées dans les domaines du web et de Linux. 
', '0', '0', '0', '2001-01-26 10:29:27', '');
INSERT INTO pub VALUES ( '2', 'KERNIX FLASH', '/pictures/kernix/pub_kernix.swf', 'http://www.kernix.com', 'FLASH', '1', 'Kernix WEB OFFICE (KMO) est une solution avancée de gestion de sites portails et d\'ecommerce.

Cette solution a été développée par la société KERNIX. KERNIX est spécialisée dans les technologies avancées dans les domaines du web et de Linux. 
', '0', '0', '0', '2001-01-26 11:52:04', '');
INSERT INTO pub VALUES ( '3', 'KERNIX HTML', '/extern/pub.php3', 'http://www.kernix.com', 'HTML', '1', 'Kernix WEB OFFICE (KMO) est une solution avancée de gestion de sites portails et d\'ecommerce.

Cette solution a été développée par la société KERNIX. KERNIX est spécialisée dans les technologies avancées dans les domaines du web et de Linux. 
', '0', '0', '0', '2001-01-26 13:21:44', '');

INSERT INTO rating (rate1,rate2,rate3) VALUES ('bien','moyen','nul');

INSERT INTO ref (idcontent,name,longdescription,idproperty,keywords,logflag, nodekey) VALUES('1','root','','3','kernix','0','00');
INSERT INTO ref (idcontent,name,longdescription,idproperty,keywords,logflag, nodekey) VALUES('2', 'Bienvenue', 'Home Page', '3', 'kernix', '1', '01');

INSERT INTO taxes (name, description, rate) VALUES('Aucune', 'Aucune', '0');
INSERT INTO taxes (name, description, rate) VALUES('TVA 19.6%', 'TVA 19.6%', '19.60');
INSERT INTO taxes (name, description, rate) VALUES('TVA 5.5%', 'TVA 5.5%', '5.50');

INSERT INTO users ( login, password, power, email ) VALUES ( 'kernix', 'admin', '1', 'contact@kernix.com' );
INSERT INTO users ( login, password, power, email ) VALUES ( 'test', 'test', '1', 'test@kernix.com' );

#------- PORTZONE ---------------------------------------------------------------------------------------------------

INSERT INTO port_zone VALUES ( '1', '1', ' FRANCE - NATIONALE', 'France - nationale', 'fr');
INSERT INTO port_zone VALUES ( '2', '2', ' FRANCE - PARIS ET ILE DE FRANCE', 'France - Paris et Ile de France', 'fr');
INSERT INTO port_zone VALUES ( '3', '3', 'ACORES', 'Azores', 'pt');
INSERT INTO port_zone VALUES ( '4', '5', 'AFRIQUE DU SUD', 'South Africa', 'za');
INSERT INTO port_zone VALUES ( '5', '4', 'ALBANIE', 'Albania', 'al');
INSERT INTO port_zone VALUES ( '6', '4', 'ALGERIE', 'Algeria', 'dz');
INSERT INTO port_zone VALUES ( '7', '3', 'ALLEMAGNE', 'Germany, Federal Republic of', 'de');
INSERT INTO port_zone VALUES ( '8', '5', 'ANGOLA', 'Angola', 'ao');
INSERT INTO port_zone VALUES ( '9', '6', 'ANGUILLA', 'Anguilla', 'ai');
INSERT INTO port_zone VALUES ( '10', '6', 'ANTIGUA & BARBUDA', 'Antigua and Barbuda', 'ag');
INSERT INTO port_zone VALUES ( '11', '6', 'ANTILLES NEERLANDAISES', 'Netherlands Antilles', 'an');
INSERT INTO port_zone VALUES ( '12', '5', 'ARABIE SAOUDITE', 'Saudi Arabia', 'sa');
INSERT INTO port_zone VALUES ( '13', '6', 'ARGENTINE', 'Argentina', 'ar');
INSERT INTO port_zone VALUES ( '14', '4', 'ARMENIE', 'Armenia', 'am');
INSERT INTO port_zone VALUES ( '15', '5', 'ASCENTION', '', '');
INSERT INTO port_zone VALUES ( '16', '6', 'AUSTRALIE', 'Australia', 'au');
INSERT INTO port_zone VALUES ( '17', '3', 'AUTRICHE', 'Austria', 'at');
INSERT INTO port_zone VALUES ( '18', '4', 'AZERBAIDJAN', 'Azerbaijan', 'az');
INSERT INTO port_zone VALUES ( '19', '6', 'BAHAMAS', 'Bahamas', 'bs');
INSERT INTO port_zone VALUES ( '20', '5', 'BAHRAIN', 'Bahrain', 'bh');
INSERT INTO port_zone VALUES ( '21', '6', 'BANGLADESH', 'Bangladesh', 'bd');
INSERT INTO port_zone VALUES ( '22', '6', 'BARBADE', 'Barbados', 'bb');
INSERT INTO port_zone VALUES ( '23', '4', 'BELARUS', 'Belarus', 'by');
INSERT INTO port_zone VALUES ( '24', '3', 'BELGIQUE', 'Belgium', 'be');
INSERT INTO port_zone VALUES ( '25', '6', 'BELIZE', 'Belize', 'bz');
INSERT INTO port_zone VALUES ( '26', '6', 'BERMUDES', 'Bermuda', 'bm');
INSERT INTO port_zone VALUES ( '27', '6', 'BHOUSTAN', 'Bhutan', 'bt');
INSERT INTO port_zone VALUES ( '28', '6', 'BOLIVIE', 'Bolivia', 'bo');
INSERT INTO port_zone VALUES ( '29', '4', 'BOSNIE-HERZEGOVINE', 'Bosnia-Herzegovina', 'ba');
INSERT INTO port_zone VALUES ( '30', '5', 'BOTSWANA', 'Botswana', 'bw');
INSERT INTO port_zone VALUES ( '31', '6', 'BRESIL', 'Brazil', 'br');
INSERT INTO port_zone VALUES ( '32', '6', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'bn');
INSERT INTO port_zone VALUES ( '33', '4', 'BULGARIE', 'Bulgaria', 'bg');
INSERT INTO port_zone VALUES ( '34', '5', 'BURKINA FASO', 'Burkina', 'bf');
INSERT INTO port_zone VALUES ( '35', '5', 'BURUNDI', 'Burundi', 'bi');
INSERT INTO port_zone VALUES ( '37', '6', 'CAMBODGE', 'Cambodia', 'kh');
INSERT INTO port_zone VALUES ( '38', '5', 'CAMEROUN', 'Cameroon', 'cm');
INSERT INTO port_zone VALUES ( '39', '5', 'CANADA', 'Canada', 'ca');
INSERT INTO port_zone VALUES ( '40', '5', 'CAP VERT', 'Cape Verde', 'cv');
INSERT INTO port_zone VALUES ( '41', '6', 'CAYMAN', 'Cayman Islands', 'ky');
INSERT INTO port_zone VALUES ( '42', '5', 'CENTRAFRIQUE', 'Central African Republic', 'cf');
INSERT INTO port_zone VALUES ( '43', '6', 'CHILI', 'Chile', 'cl');
INSERT INTO port_zone VALUES ( '44', '6', 'CHINE(REPUBLIQUE POPULAIRE DE)', 'China', 'cn');
INSERT INTO port_zone VALUES ( '45', '4', 'CHYPRE', 'Cyprus', 'cy');
INSERT INTO port_zone VALUES ( '46', '6', 'COLOMBIE', 'Colombia', 'co');
INSERT INTO port_zone VALUES ( '47', '5', 'COMORES', 'Comoros', 'km');
INSERT INTO port_zone VALUES ( '48', '5', 'CONGO(REPUBLIQUE DU)', 'Congo (Kinshasa)', 'cd');
INSERT INTO port_zone VALUES ( '49', '6', 'COOK(ILES)', 'Cook Islands', 'ck');
INSERT INTO port_zone VALUES ( '50', '6', 'COREE(REPUBLIQUE DE)', 'Korea', 'kr');
INSERT INTO port_zone VALUES ( '51', '6', 'COSTA RICA', 'Costa Rica', 'cr');
INSERT INTO port_zone VALUES ( '52', '5', 'COTE D IVOIRE(REPUBLIQUE DE LA)', 'Cote d\'Ivoire', 'ci');
INSERT INTO port_zone VALUES ( '53', '5', 'CROATIE', 'Croatia', 'hr');
INSERT INTO port_zone VALUES ( '54', '6', 'CUBA', 'Cuba', 'cu');
INSERT INTO port_zone VALUES ( '55', '3', 'DANEMARK', 'Denmark', 'dk');
INSERT INTO port_zone VALUES ( '56', '5', 'DJIBOUTI', 'Djibouti', 'dj');
INSERT INTO port_zone VALUES ( '57', '6', 'DOMINICAINE(REPUB)', 'Dominican Republic', 'do');
INSERT INTO port_zone VALUES ( '58', '6', 'DOMINIQUE(ILE DE LA)', 'Dominica', 'dm');
INSERT INTO port_zone VALUES ( '59', '5', 'EGYPTE', 'Egypt', 'eg');
INSERT INTO port_zone VALUES ( '60', '6', 'EL SALVADOR', 'El Salvador', 'sv');
INSERT INTO port_zone VALUES ( '61', '5', 'EMIRATS ARABE UNIS', 'United Arab Emirates', 'ae');
INSERT INTO port_zone VALUES ( '62', '6', 'EQUATEUR', 'Ecuador', 'ec');
INSERT INTO port_zone VALUES ( '63', '5', 'ERYTRHREE', 'Eritrea', 'er');
INSERT INTO port_zone VALUES ( '64', '3', 'ESPAGNE', 'Spain', 'es');
INSERT INTO port_zone VALUES ( '65', '4', 'ESTONIE', 'Estonia', 'ee');
INSERT INTO port_zone VALUES ( '66', '5', 'ETATS-UNIS D\'AMERIQUE', 'United States of America', 'us');
INSERT INTO port_zone VALUES ( '67', '5', 'ETHIOPIE', 'Ethiopia', 'et');
INSERT INTO port_zone VALUES ( '68', '6', 'FALKAND & GEORGIE DU SUD', 'Falkland Islands (Malvinas)', 'fk');
INSERT INTO port_zone VALUES ( '69', '6', 'FIDJI', 'Fiji', 'fj');
INSERT INTO port_zone VALUES ( '70', '3', 'FINLANDE', 'Finland', 'fi');
INSERT INTO port_zone VALUES ( '71', '5', 'GABON', 'Gabon', 'ga');
INSERT INTO port_zone VALUES ( '72', '5', 'GAMBIE', 'Gambia', 'gm');
INSERT INTO port_zone VALUES ( '73', '4', 'GEORGIE', 'Georgia', 'ge');
INSERT INTO port_zone VALUES ( '74', '5', 'GHANA', 'Ghana', 'gh');
INSERT INTO port_zone VALUES ( '75', '3', 'GIBRALTAR', 'Gibraltar', 'gi');
INSERT INTO port_zone VALUES ( '76', '3', 'GRAND BRETAGNE', 'United Kingdom', 'gb');
INSERT INTO port_zone VALUES ( '77', '3', 'GRECE', 'Greece', 'gr');
INSERT INTO port_zone VALUES ( '78', '6', 'GRENADE', 'Grenada', 'gd');
INSERT INTO port_zone VALUES ( '79', '6', 'HAITI', 'Haiti', 'ht');
INSERT INTO port_zone VALUES ( '80', '6', 'HONDURAS', 'Honduras', 'hn');
INSERT INTO port_zone VALUES ( '81', '4', 'HONGRIE', 'Hungary', 'hu');
INSERT INTO port_zone VALUES ( '82', '6', 'HONK-KONG', 'Hong Kong', 'hk');
INSERT INTO port_zone VALUES ( '83', '6', 'INDE', 'India', 'in');
INSERT INTO port_zone VALUES ( '84', '6', 'INDONESIE', 'Indonesia', 'id');
INSERT INTO port_zone VALUES ( '85', '5', 'IRAK', 'Iraq', 'iq');
INSERT INTO port_zone VALUES ( '86', '5', 'IRAN', 'Iran', 'ir');
INSERT INTO port_zone VALUES ( '87', '3', 'IRLANDE', 'Ireland', 'ie');
INSERT INTO port_zone VALUES ( '88', '4', 'ISLANDE', 'Iceland', 'is');
INSERT INTO port_zone VALUES ( '89', '4', 'ISRAEL', 'Israel', 'il');
INSERT INTO port_zone VALUES ( '90', '3', 'ITALIE', 'Italy', 'it');
INSERT INTO port_zone VALUES ( '92', '6', 'JAMAIQUE', 'Jamaica', 'jm');
INSERT INTO port_zone VALUES ( '93', '6', 'JAPON', 'Japan', 'jp');
INSERT INTO port_zone VALUES ( '94', '5', 'JORDANIE', 'Jordan', 'jo');
INSERT INTO port_zone VALUES ( '95', '6', 'KAZAKHSTAN', 'Kazakhstan', 'kz');
INSERT INTO port_zone VALUES ( '96', '5', 'KENYA', 'Kenya', 'ke');
INSERT INTO port_zone VALUES ( '97', '6', 'KIRGHIZISTAN', 'Kyrgyzstan', 'kg');
INSERT INTO port_zone VALUES ( '98', '6', 'KIRIBATI', 'Kiribati', 'ki');
INSERT INTO port_zone VALUES ( '99', '5', 'KOWEIT', 'Kuwait', 'kw');
INSERT INTO port_zone VALUES ( '100', '6', 'LAO(REP DEM POP DU)', 'Laos', 'la');
INSERT INTO port_zone VALUES ( '101', '5', 'LESOTHO', 'Lesotho', 'ls');
INSERT INTO port_zone VALUES ( '102', '4', 'LETTONIE', 'Latvia', 'lv');
INSERT INTO port_zone VALUES ( '103', '5', 'LIBAN', 'Lebanon', 'lb');
INSERT INTO port_zone VALUES ( '104', '5', 'LIBERIA', 'Liberia', 'lr');
INSERT INTO port_zone VALUES ( '105', '3', 'LIECHTENSTEIN', 'Liechtenstein', 'li');
INSERT INTO port_zone VALUES ( '106', '4', 'LITHUANIE', 'Lithuania', 'lt');
INSERT INTO port_zone VALUES ( '107', '3', 'LUXEMBOURG', 'Luxembourg', 'lu');
INSERT INTO port_zone VALUES ( '108', '6', 'MACAO', 'Macau', 'mo');
INSERT INTO port_zone VALUES ( '109', '4', 'MACEDOINE', 'Macedonia', 'mk');
INSERT INTO port_zone VALUES ( '110', '5', 'MADAGASCAR', 'Madagascar', 'mg');
INSERT INTO port_zone VALUES ( '111', '3', 'MADERE', 'Madiera Island', 'pt');
INSERT INTO port_zone VALUES ( '112', '6', 'MALAISIE', 'Malaysia', 'my');
INSERT INTO port_zone VALUES ( '113', '5', 'MALAWI', 'Malawi', 'mw');
INSERT INTO port_zone VALUES ( '114', '6', 'MALDIVES', 'Maldives', 'mv');
INSERT INTO port_zone VALUES ( '115', '5', 'MALI', 'Mali', 'ml');
INSERT INTO port_zone VALUES ( '116', '4', 'MALTE', 'Malta', 'mt');
INSERT INTO port_zone VALUES ( '117', '4', 'MAROC', 'Morocco', 'ma');
INSERT INTO port_zone VALUES ( '118', '6', 'MARSHALL(ILES)', 'Marshall Islands', 'mh');
INSERT INTO port_zone VALUES ( '119', '5', 'MAURICE', 'Mauritius', 'mu');
INSERT INTO port_zone VALUES ( '120', '5', 'MAURITANIE', 'Mauritania', 'mr');
INSERT INTO port_zone VALUES ( '121', '6', 'MEXIQUE', 'Mexico', 'mx');
INSERT INTO port_zone VALUES ( '122', '4', 'MOLDAVIE', 'Moldova', 'md');
INSERT INTO port_zone VALUES ( '123', '6', 'MONGOLIE', 'Mongolia', 'mn');
INSERT INTO port_zone VALUES ( '124', '6', 'MONTESERRAT', 'Montserat', 'ms');
INSERT INTO port_zone VALUES ( '125', '6', 'MYANMAR', 'Myanmar (See Burma)', '');
INSERT INTO port_zone VALUES ( '126', '5', 'NAMBIE', 'Namibia', 'na');
INSERT INTO port_zone VALUES ( '127', '6', 'NAURU', 'Nauru', 'nr');
INSERT INTO port_zone VALUES ( '128', '6', 'NEPAL', 'Nepal', 'np');
INSERT INTO port_zone VALUES ( '129', '6', 'NICARAGUA', 'Nicaragua', 'ni');
INSERT INTO port_zone VALUES ( '130', '5', 'NIGER', 'Niger', 'ne');
INSERT INTO port_zone VALUES ( '131', '5', 'NIGERIA', 'Nigeria', 'ng');
INSERT INTO port_zone VALUES ( '132', '4', 'NORVEGE', 'Norway', 'no');
INSERT INTO port_zone VALUES ( '133', '6', 'NOUVELLE-ZELANDE', 'New Zealand', 'nz');
INSERT INTO port_zone VALUES ( '134', '5', 'OMAN', 'Oman', 'om');
INSERT INTO port_zone VALUES ( '135', '5', 'OUGANDA', 'Uganda', 'ug');
INSERT INTO port_zone VALUES ( '136', '6', 'OUZBEKISTAN', '', '');
INSERT INTO port_zone VALUES ( '137', '6', 'PAKISTAN', 'Pakistan', 'pk');
INSERT INTO port_zone VALUES ( '138', '6', 'PANAMA', 'Panama', 'pa');
INSERT INTO port_zone VALUES ( '139', '6', 'PAPOUASIE ET NOUVELLE GUINEE', 'Papua New Guinea', 'pg');
INSERT INTO port_zone VALUES ( '140', '6', 'PARAGUAY', 'Paraguay', 'py');
INSERT INTO port_zone VALUES ( '141', '3', 'PAYS-BAS', 'Netherlands', 'nl');
INSERT INTO port_zone VALUES ( '142', '6', 'PEROU', 'Peru', 'pe');
INSERT INTO port_zone VALUES ( '143', '6', 'PHILIPPINES', 'Philippines', 'ph');
INSERT INTO port_zone VALUES ( '144', '6', 'PITCAIRN', 'Pitcairn Island', 'pn');
INSERT INTO port_zone VALUES ( '145', '4', 'POLOGNE', 'Poland', 'pl');
INSERT INTO port_zone VALUES ( '146', '5', 'PORTO-RICO', 'Puerto Rico', 'pr');
INSERT INTO port_zone VALUES ( '147', '3', 'PORTUGAL', 'Portugal', 'pt');
INSERT INTO port_zone VALUES ( '148', '5', 'QUATAR', 'Qatar', 'qa');
INSERT INTO port_zone VALUES ( '149', '4', 'ROUMANIE', 'Romania', 'ro');
INSERT INTO port_zone VALUES ( '150', '4', 'RUSSIE(FEDERATION DE)', 'Russia', 'ru');
INSERT INTO port_zone VALUES ( '151', '5', 'RWANDA', 'Rwanda', 'rw');
INSERT INTO port_zone VALUES ( '152', '6', 'SAINT CHRISTOPHE ET NUVIS', 'St. Christopher', 'kn');
INSERT INTO port_zone VALUES ( '153', '3', 'SAINT MARTIN', 'st maarten', '');
INSERT INTO port_zone VALUES ( '154', '6', 'SAINT VINCENT ET GRENADINES', 'Saint Vincent and The Grenadines', 'vc');
INSERT INTO port_zone VALUES ( '155', '5', 'SAINTE HELENE', 'St. Helena', 'sh');
INSERT INTO port_zone VALUES ( '156', '6', 'SAINTE LUCIE', 'Saint Lucia', 'lc');
INSERT INTO port_zone VALUES ( '157', '6', 'SALOMON', 'Solomon Islands', 'sb');
INSERT INTO port_zone VALUES ( '158', '6', 'SAMOA ET GUAM', 'Samoa', 'ws');
INSERT INTO port_zone VALUES ( '159', '5', 'SAO TOME ET PRINCIPE', 'Sao Tome and Principe', 'st');
INSERT INTO port_zone VALUES ( '160', '5', 'SENEGAL', 'Senegal', 'sn');
INSERT INTO port_zone VALUES ( '161', '5', 'SEYCHELLES', 'Seychelles', 'sc');
INSERT INTO port_zone VALUES ( '162', '5', 'SIERRA LEONE', 'Sierra Leone', 'sl');
INSERT INTO port_zone VALUES ( '163', '6', 'SINGAPOUR', 'Singapore', 'sg');
INSERT INTO port_zone VALUES ( '164', '4', 'SLOVAQUIE', 'Slovakia', 'sk');
INSERT INTO port_zone VALUES ( '165', '4', 'SLOVENIE', 'Slovenia', 'si');
INSERT INTO port_zone VALUES ( '166', '5', 'SOMALIE', 'Somalia', 'so');
INSERT INTO port_zone VALUES ( '167', '5', 'SOUDAN', 'Sudan', 'sd');
INSERT INTO port_zone VALUES ( '168', '6', 'SRI LANKA', 'Sri Lanka', 'lk');
INSERT INTO port_zone VALUES ( '169', '3', 'SUEDE', 'Sweden', 'se');
INSERT INTO port_zone VALUES ( '170', '3', 'SUISSE', 'Switzerland', 'ch');
INSERT INTO port_zone VALUES ( '171', '4', 'SURINAME', 'Suriname', 'sr');
INSERT INTO port_zone VALUES ( '172', '5', 'SWAZILAND', 'Swaziland', 'sz');
INSERT INTO port_zone VALUES ( '173', '5', 'SYRIENNE(REPUBLIQUE ARABE)', 'Syria', 'sy');
INSERT INTO port_zone VALUES ( '174', '6', 'TADJIKISTAN', 'Tajikistan', 'tj');
INSERT INTO port_zone VALUES ( '175', '6', 'TAIWAN', 'Taiwan', 'tw');
INSERT INTO port_zone VALUES ( '176', '5', 'TANZANIE', 'Tanzania', 'tz');
INSERT INTO port_zone VALUES ( '177', '5', 'TCHAD', 'Chad', 'td');
INSERT INTO port_zone VALUES ( '178', '4', 'TCHEQUE(REPUBLIQUE)', 'Czech Republic, The', 'cz');
INSERT INTO port_zone VALUES ( '179', '6', 'THAILANDE', 'Thailand', 'th');
INSERT INTO port_zone VALUES ( '180', '6', 'TIMOR ORIENTAL', '', '');
INSERT INTO port_zone VALUES ( '181', '5', 'TOGO', 'Togo', 'tg');
INSERT INTO port_zone VALUES ( '182', '6', 'TONGA', 'Tonga', 'to');
INSERT INTO port_zone VALUES ( '183', '6', 'TRINITE ET TOBAGO', 'Trinidad and Tobago', 'tt');
INSERT INTO port_zone VALUES ( '184', '6', 'TRISTAN DA CUNHA', '', '');
INSERT INTO port_zone VALUES ( '185', '4', 'TUNISIE', 'Tunisia', 'tn');
INSERT INTO port_zone VALUES ( '186', '6', 'TURKMENISTAN', 'Turkmenistan', 'tm');
INSERT INTO port_zone VALUES ( '187', '4', 'TURQUIE', 'Turkey', 'tr');
INSERT INTO port_zone VALUES ( '188', '6', 'TUVALU', 'Tuvalu', 'tv');
INSERT INTO port_zone VALUES ( '189', '4', 'UKRAINE', 'Ukraine', 'ua');
INSERT INTO port_zone VALUES ( '190', '6', 'URUGUAY', 'Uruguay', 'uy');
INSERT INTO port_zone VALUES ( '191', '6', 'VANUATU', 'Vanuatu', 'vu');
INSERT INTO port_zone VALUES ( '192', '3', 'VATICAN', 'Vatican City', 'va');
INSERT INTO port_zone VALUES ( '193', '6', 'VENEZUELA', 'Venezuela', 've');
INSERT INTO port_zone VALUES ( '194', '6', 'VIERGE(ILES)', 'Virgin Islands of the US', 'vi');
INSERT INTO port_zone VALUES ( '195', '6', 'VIETNAM', 'Vietnam', 'vn');
INSERT INTO port_zone VALUES ( '196', '5', 'YEMEN', 'Yemen, Republic of', 'ye');
INSERT INTO port_zone VALUES ( '197', '4', 'YOUGOSLAVIE', 'Yugoslavia', 'yu');
INSERT INTO port_zone VALUES ( '198', '5', 'ZAMBIE', 'Zambia', 'zm');
INSERT INTO port_zone VALUES ( '199', '5', 'ZIMBABWE', 'Zimbabwe', 'zw');
