# MySQL dump 8.10
#
# Host: localhost    Database: patchenka
#--------------------------------------------------------
# Server version	3.23.27-beta

#
# Table structure for table 'addressbook'
#

CREATE TABLE addressbook (
  idaddressbook int(10) unsigned NOT NULL auto_increment,
  firstname varchar(20),
  lastname varchar(20),
  address varchar(20),
  town varchar(20),
  zipcode varchar(20),
  country varchar(20),
  phone varchar(20),
  cellphone varchar(20),
  workphone varchar(20),
  email varchar(50),
  url varchar(60),
  company varchar(30),
  note text,
  date datetime,
  PRIMARY KEY (idaddressbook)
);

#
# Table structure for table 'adm'
#

CREATE TABLE adm (
  idadm tinyint(3) unsigned NOT NULL auto_increment,
  email varchar(50) DEFAULT '' NOT NULL,
  PRIMARY KEY (idadm)
);

#
# Table structure for table 'adm_shop'
#

CREATE TABLE adm_shop (
  idadmshop tinyint(3) unsigned NOT NULL auto_increment,
  commandwarningflag tinyint(3) unsigned DEFAULT '1' NOT NULL,
  commandwarningemail blob,
  caddieflag tinyint(3) unsigned DEFAULT '1' NOT NULL,
  idcurrency tinyint(3) unsigned DEFAULT '1' NOT NULL,
  idtaxes tinyint(3) unsigned DEFAULT '1' NOT NULL,
  idcurrencyviewmode tinyint(3) unsigned DEFAULT '1' NOT NULL,
  idport tinyint(3) unsigned DEFAULT '0' NOT NULL,
  idpriceentermode tinyint(3) unsigned DEFAULT '1' NOT NULL,
  tpe_num varchar(20) DEFAULT '000000' NOT NULL,
  tpe_name varchar(50),
  tpe_langue varchar(20),
  sitebddname varchar(20),
  tpe_serveurflag tinyint(4) DEFAULT '0' NOT NULL,
  tpe_backurl varchar(150),
  tpe_testflag tinyint(4) DEFAULT '1' NOT NULL,
  paiemodeflag tinyint(4) DEFAULT '0' NOT NULL,
  stockmodeflag tinyint(4) DEFAULT '0' NOT NULL,
  affiliatemode tinyint(4) DEFAULT '2' NOT NULL,
  affiliatevalue float DEFAULT '5' NOT NULL,
  affiliatemax int(11) DEFAULT '200' NOT NULL,
  bank_interface_login varchar(15) DEFAULT '0' NOT NULL,
  bank_interface_password varchar(10) DEFAULT '0' NOT NULL,
  PRIMARY KEY (idadmshop)
);

#
# Table structure for table 'adm_site'
#

CREATE TABLE adm_site (
  idadmsite tinyint(3) unsigned NOT NULL auto_increment,
  companyname varchar(50),
  address varchar(100),
  zipcode varchar(10),
  town varchar(50),
  country varchar(30),
  phone1 varchar(20),
  phone2 varchar(20),
  fax varchar(20),
  siret varchar(40),
  ape varchar(10),
  capital varchar(20),
  forme varchar(20),
  num_tva varchar(30),
  PRIMARY KEY (idadmsite)
);

#
# Table structure for table 'affiliate'
#

CREATE TABLE affiliate (
  idaffiliate int(10) unsigned NOT NULL auto_increment,
  login varchar(20) DEFAULT '' NOT NULL,
  password varchar(20) DEFAULT '' NOT NULL,
  firstname varchar(20) DEFAULT '' NOT NULL,
  lastname varchar(20) DEFAULT '' NOT NULL,
  address text DEFAULT '' NOT NULL,
  email varchar(40) DEFAULT '' NOT NULL,
  url varchar(100) DEFAULT '' NOT NULL,
  currentaccount double(16,4) DEFAULT '0.0000' NOT NULL,
  totalaccount double(16,4) DEFAULT '0.0000' NOT NULL,
  currentorder int(11) DEFAULT '0' NOT NULL,
  date datetime,
  lastvisitordate datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  totalorder int(11) DEFAULT '0' NOT NULL,
  payableto varchar(100) DEFAULT '' NOT NULL,
  nbpayment int(10) unsigned DEFAULT '0' NOT NULL,
  nbvisitor int(11) DEFAULT '0' NOT NULL,
  affiliatemode tinyint(4) DEFAULT '0' NOT NULL,
  affiliatevalue float DEFAULT '0' NOT NULL,
  affiliatemax int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (idaffiliate)
);

#
# Table structure for table 'alert'
#

CREATE TABLE alert (
  idalert int(10) unsigned NOT NULL auto_increment,
  idvisitor int(10) unsigned DEFAULT '0' NOT NULL,
  idref int(11) DEFAULT '0' NOT NULL,
  email varchar(30) DEFAULT '' NOT NULL,
  lastmailingdate datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY (idalert),
  KEY idalert (idalert)
);

#
# Table structure for table 'client'
#

CREATE TABLE client (
  idclient int(10) unsigned NOT NULL auto_increment,
  firstname char(50) DEFAULT '' NOT NULL,
  lastname char(50) DEFAULT '' NOT NULL,
  address char(100) DEFAULT '' NOT NULL,
  zipcode char(15) DEFAULT '' NOT NULL,
  town char(50) DEFAULT '' NOT NULL,
  phone char(20) DEFAULT '' NOT NULL,
  workphone char(20) DEFAULT '' NOT NULL,
  cellphone char(20) DEFAULT '' NOT NULL,
  fax char(20) DEFAULT '' NOT NULL,
  email1 char(50) DEFAULT '' NOT NULL,
  email2 char(50) DEFAULT '' NOT NULL,
  login char(10) DEFAULT '' NOT NULL,
  password char(10) DEFAULT '' NOT NULL,
  job char(50) DEFAULT '' NOT NULL,
  company char(50) DEFAULT '' NOT NULL,
  url char(100) DEFAULT '' NOT NULL,
  nbpurchase int(11) DEFAULT '0' NOT NULL,
  date datetime,
  idportzone int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (idclient)
);

#
# Table structure for table 'command'
#

CREATE TABLE command (
  idcommand int(11) unsigned NOT NULL auto_increment,
  idcurrency tinyint(3) unsigned DEFAULT '1' NOT NULL,
  idnumsession int(11) unsigned DEFAULT '0' NOT NULL,
  idclient int(11) unsigned DEFAULT '0' NOT NULL,
  price float unsigned DEFAULT '0' NOT NULL,
  description text,
  date datetime,
  status int(11) unsigned DEFAULT '0' NOT NULL,
  pricettc float unsigned DEFAULT '0' NOT NULL,
  port float unsigned DEFAULT '0' NOT NULL,
  idaffiliate int(10) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idcommand)
);

#
# Table structure for table 'command_status'
#

CREATE TABLE command_status (
  idcommand_status tinyint(3) unsigned NOT NULL auto_increment,
  status tinyint(3) unsigned DEFAULT '0' NOT NULL,
  name char(50) DEFAULT '' NOT NULL,
  PRIMARY KEY (idcommand_status)
);

#
# Table structure for table 'content'
#

CREATE TABLE content (
  idcontent int(11) unsigned NOT NULL auto_increment,
  title varchar(30),
  title_1 varchar(30),
  t_fontclass_1 varchar(20),
  t_align_1 varchar(20),
  body_1 text,
  b_fontclass_1 varchar(20),
  b_align_1 varchar(20),
  pictureleft_1 varchar(100),
  il_align_1 varchar(20),
  pictureright_1 varchar(100),
  ir_align_1 varchar(20),
  titre_2 varchar(30),
  t_fontsize_2 varchar(10),
  t_fontweight_2 varchar(10),
  t_fontname_2 varchar(20),
  t_align_2 varchar(10),
  corps_2 text,
  c_fontsize_2 varchar(10),
  c_fontweight_2 varchar(10),
  c_fontname_2 varchar(20),
  c_align_2 varchar(10),
  imageleft_2 varchar(100),
  il_align_2 varchar(10),
  imageright_2 varchar(100),
  ir_align_2 varchar(10),
  titre_3 varchar(30),
  t_fontsize_3 varchar(10),
  t_fontweight_3 varchar(10),
  t_fontname_3 varchar(20),
  t_align_3 varchar(10),
  corps_3 text,
  c_fontsize_3 varchar(10),
  c_fontweight_3 varchar(10),
  c_fontname_3 varchar(20),
  c_align_3 varchar(10),
  imageleft_3 varchar(100),
  il_align_3 varchar(10),
  imageright_3 varchar(100),
  ir_align_3 varchar(10),
  titre_4 varchar(30),
  t_fontsize_4 varchar(10),
  t_fontweight_4 varchar(10),
  t_fontname_4 varchar(20),
  t_align_4 varchar(10),
  corps_4 text,
  c_fontsize_4 varchar(10),
  c_fontweight_4 varchar(10),
  c_fontname_4 varchar(20),
  c_align_4 varchar(10),
  imageleft_4 varchar(100),
  il_align_4 varchar(10),
  imageright_4 varchar(100),
  ir_align_4 varchar(10),
  PRIMARY KEY (idcontent)
);

#
# Table structure for table 'currency'
#

CREATE TABLE currency (
  idcurrency tinyint(3) unsigned NOT NULL auto_increment,
  name varchar(30),
  value float unsigned DEFAULT '0' NOT NULL,
  baseid tinyint(3) unsigned DEFAULT '1' NOT NULL,
  acronymtxt varchar(10),
  acronymhtml varchar(10),
  PRIMARY KEY (idcurrency)
);

#
# Table structure for table 'currency_viewmode'
#

CREATE TABLE currency_viewmode (
  idcurrencyviewmode tinyint(4) NOT NULL auto_increment,
  label varchar(100) DEFAULT '' NOT NULL,
  PRIMARY KEY (idcurrencyviewmode),
  KEY idcurrencyviewmode (idcurrencyviewmode)
);

#
# Table structure for table 'egroup'
#

CREATE TABLE egroup (
  idegroup int(10) unsigned NOT NULL auto_increment,
  name char(30),
  subject char(100),
  description char(200),
  idowner int(10) unsigned DEFAULT '0' NOT NULL,
  nbrmsg int(10) unsigned DEFAULT '0' NOT NULL,
  creationdate datetime,
  lastmsgdate datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  nbremail int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (idegroup)
);

#
# Table structure for table 'email'
#

CREATE TABLE email (
  idemail int(10) unsigned NOT NULL auto_increment,
  idegroup int(10) unsigned DEFAULT '0' NOT NULL,
  idvisitor int(10) unsigned DEFAULT '0' NOT NULL,
  email char(100) DEFAULT '' NOT NULL,
  creationdate datetime,
  status tinyint(4) DEFAULT '1' NOT NULL,
  PRIMARY KEY (idemail)
);

#
# Table structure for table 'faq'
#

CREATE TABLE faq (
  idfaq int(10) unsigned NOT NULL auto_increment,
  name varchar(50) DEFAULT '' NOT NULL,
  subject text DEFAULT '' NOT NULL,
  nbentries int(10) unsigned DEFAULT '0' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY (idfaq)
);

#
# Table structure for table 'faqentries'
#

CREATE TABLE faqentries (
  idfaqentries int(10) unsigned NOT NULL auto_increment,
  idfaq int(11) DEFAULT '0' NOT NULL,
  subject text DEFAULT '' NOT NULL,
  body text DEFAULT '' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY (idfaqentries),
  KEY idfaqentries (idfaqentries)
);

#
# Table structure for table 'form'
#

CREATE TABLE form (
  idform tinyint(3) unsigned NOT NULL auto_increment,
  name varchar(20),
  subject varchar(200),
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  email varchar(100),
  emailflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  nbresults int(10) unsigned DEFAULT '0' NOT NULL,
  fieldstring varchar(200),
  PRIMARY KEY (idform),
  KEY idform (idform)
);

#
# Table structure for table 'formresult'
#

CREATE TABLE formresult (
  idformresult int(10) unsigned NOT NULL auto_increment,
  idvisitor int(10) unsigned DEFAULT '0' NOT NULL,
  idform int(10) unsigned DEFAULT '0' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  result tinytext DEFAULT '' NOT NULL,
  PRIMARY KEY (idformresult),
  KEY idformresult (idformresult)
);

#
# Table structure for table 'forum'
#

CREATE TABLE forum (
  idforum int(10) unsigned NOT NULL auto_increment,
  title varchar(30),
  description tinytext,
  nbposts int(10) unsigned DEFAULT '0' NOT NULL,
  creationdate datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  replyflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  subjectflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  mediatoremail varchar(100),
  newsflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  idowner int(10) unsigned DEFAULT '0' NOT NULL,
  nbtopics int(10) unsigned DEFAULT '0' NOT NULL,
  updatedate datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  mediatorflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idforum)
);

#
# Table structure for table 'forum_articles'
#

CREATE TABLE forum_articles (
  idarticles int(11) unsigned NOT NULL auto_increment,
  title varchar(30),
  author varchar(30),
  date datetime,
  abstract tinytext,
  body text,
  email varchar(50),
  url varchar(50),
  replyflag tinyint(4) unsigned DEFAULT '0' NOT NULL,
  idsubject int(11) unsigned DEFAULT '0' NOT NULL,
  viewflag tinyint(4) unsigned DEFAULT '0' NOT NULL,
  nbrview int(11) unsigned DEFAULT '0' NOT NULL,
  idforum int(10) unsigned DEFAULT '0' NOT NULL,
  keywords varchar(200),
  link varchar(100),
  nbreply int(10) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idarticles)
);

#
# Table structure for table 'forum_reply'
#

CREATE TABLE forum_reply (
  idreply int(11) unsigned NOT NULL auto_increment,
  idarticles int(11) unsigned DEFAULT '0' NOT NULL,
  idreplyarticles int(11) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idreply)
);

#
# Table structure for table 'forum_subject'
#

CREATE TABLE forum_subject (
  idsubject int(11) unsigned NOT NULL auto_increment,
  description varchar(100),
  picture varchar(100),
  title varchar(30),
  idforum int(10) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idsubject)
);

#
# Table structure for table 'gb_articles'
#

CREATE TABLE gb_articles (
  idarticles int(11) unsigned NOT NULL auto_increment,
  author varchar(30),
  date datetime,
  body text,
  email varchar(50),
  url varchar(50),
  id int(10) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idarticles)
);

#
# Table structure for table 'hash'
#

CREATE TABLE hash (
  idhash int(10) unsigned NOT NULL auto_increment,
  idref int(10) unsigned DEFAULT '0' NOT NULL,
  name varchar(50) DEFAULT '' NOT NULL,
  value text DEFAULT '' NOT NULL,
  uname varchar(50) DEFAULT '' NOT NULL,
  uvalue text DEFAULT '' NOT NULL,
  idproperty int(10) unsigned DEFAULT '0' NOT NULL,
  propertyname varchar(50) DEFAULT '' NOT NULL,
  refname varchar(50) DEFAULT '' NOT NULL,
  refdescription varchar(200) DEFAULT '' NOT NULL,
  up int(10) unsigned DEFAULT '0' NOT NULL,
  nodekey varchar(250) DEFAULT '' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY (idhash),
  KEY idhash (idhash)
);

#
# Table structure for table 'keywords'
#

CREATE TABLE keywords (
  idkeyword int(10) unsigned NOT NULL auto_increment,
  idvisitor int(10) unsigned DEFAULT '0' NOT NULL,
  keyword varchar(100) DEFAULT '' NOT NULL,
  configfile varchar(50) DEFAULT '' NOT NULL,
  date datetime,
  PRIMARY KEY (idkeyword)
);

#
# Table structure for table 'log'
#

CREATE TABLE log (
  idlog int(11) unsigned NOT NULL auto_increment,
  idglobal int(11) unsigned,
  idsession varchar(12) DEFAULT '0' NOT NULL,
  idlocal int(11) unsigned,
  idsite int(11) unsigned,
  pagefrom tinytext,
  page varchar(100),
  date datetime,
  numvis int(11) unsigned,
  skin varchar(10),
  design varchar(10),
  bringer tinyint(3) unsigned DEFAULT '0' NOT NULL,
  newvis tinyint(3) unsigned DEFAULT '0' NOT NULL,
  idbringer int(10) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idlog),
  KEY idsession (idsession)
);

#
# Table structure for table 'mailingarchive'
#

CREATE TABLE mailingarchive (
  idmailingarchive int(10) unsigned NOT NULL auto_increment,
  mailingname varchar(30) DEFAULT '' NOT NULL,
  subject varchar(100) DEFAULT '' NOT NULL,
  body text DEFAULT '' NOT NULL,
  nbremail tinyint(4) DEFAULT '0' NOT NULL,
  nbrfollow int(11) DEFAULT '0' NOT NULL,
  date datetime,
  idegroup int(10) unsigned DEFAULT '0' NOT NULL,
  nbvisitor int(10) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idmailingarchive)
);

#
# Table structure for table 'news'
#

CREATE TABLE news (
  idnews int(10) unsigned NOT NULL auto_increment,
  name varchar(100) DEFAULT '' NOT NULL,
  subject varchar(200) DEFAULT '' NOT NULL,
  archiveflag tinyint(4) DEFAULT '0' NOT NULL,
  commentflag tinyint(4) DEFAULT '0' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY (idnews),
  KEY idnews (idnews)
);

#
# Table structure for table 'owner'
#

CREATE TABLE owner (
  idowner int(10) unsigned NOT NULL auto_increment,
  login varchar(10) DEFAULT '' NOT NULL,
  password varchar(10) DEFAULT '' NOT NULL,
  idproperty int(10) unsigned DEFAULT '0' NOT NULL,
  description text DEFAULT '' NOT NULL,
  data text DEFAULT '' NOT NULL,
  nbvis int(10) unsigned DEFAULT '0' NOT NULL,
  lastvisdate datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY (idowner),
  KEY idowner (idowner)
);

#
# Table structure for table 'poll'
#

CREATE TABLE poll (
  idpoll int(10) unsigned NOT NULL auto_increment,
  name char(50) DEFAULT '' NOT NULL,
  owner char(50) DEFAULT '' NOT NULL,
  label char(60) DEFAULT '' NOT NULL,
  option1 char(40),
  option2 char(40),
  option3 char(40),
  option4 char(40),
  option5 char(40),
  option6 char(40),
  option7 char(40),
  option8 char(40),
  option9 char(40),
  option10 char(40),
  viewable tinyint(3) unsigned DEFAULT '0' NOT NULL,
  nbclick int(10) unsigned DEFAULT '0' NOT NULL,
  date datetime,
  nbclick1 int(10) unsigned DEFAULT '0' NOT NULL,
  nbclick2 int(10) unsigned DEFAULT '0' NOT NULL,
  nbclick3 int(10) unsigned DEFAULT '0' NOT NULL,
  nbclick4 int(10) unsigned DEFAULT '0' NOT NULL,
  nbclick5 int(10) unsigned DEFAULT '0' NOT NULL,
  nbclick6 int(10) unsigned DEFAULT '0' NOT NULL,
  nbclick7 int(10) unsigned DEFAULT '0' NOT NULL,
  nbclick8 int(10) unsigned DEFAULT '0' NOT NULL,
  nbclick9 int(10) unsigned DEFAULT '0' NOT NULL,
  nbclick10 int(10) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idpoll)
);

#
# Table structure for table 'pollresult'
#

CREATE TABLE pollresult (
  idresponse int(10) unsigned NOT NULL auto_increment,
  idpoll int(10) unsigned DEFAULT '0' NOT NULL,
  choice int(10) unsigned DEFAULT '0' NOT NULL,
  idvisitor int(10) unsigned DEFAULT '0' NOT NULL,
  date datetime,
  PRIMARY KEY (idresponse)
);

#
# Table structure for table 'port'
#

CREATE TABLE port (
  idport int(11) unsigned NOT NULL auto_increment,
  name varchar(30),
  description varchar(200),
  price double(16,4) unsigned DEFAULT '0.0000' NOT NULL,
  idchange tinyint(3) unsigned DEFAULT '0' NOT NULL,
  priceexpress double(16,4) DEFAULT '0.0000' NOT NULL,
  zone_id int(11) DEFAULT '0' NOT NULL,
  weight int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (idport)
);

#
# Table structure for table 'port_zone'
#

CREATE TABLE port_zone (
  id_portzone int(4) NOT NULL auto_increment,
  zone_id tinyint(4) DEFAULT '0' NOT NULL,
  zone_name varchar(50) DEFAULT '' NOT NULL,
  zone_name_us varchar(40) DEFAULT '' NOT NULL,
  zone_code varchar(5) DEFAULT '' NOT NULL,
  PRIMARY KEY (id_portzone),
  KEY id_portzone (id_portzone),
  UNIQUE id_portzone_2 (id_portzone)
);

#
# Table structure for table 'price_entermode'
#

CREATE TABLE price_entermode (
  idpriceentermode tinyint(4) NOT NULL auto_increment,
  label varchar(100) DEFAULT '' NOT NULL,
  PRIMARY KEY (idpriceentermode),
  KEY idpricentermode (idpriceentermode)
);

#
# Table structure for table 'product'
#

CREATE TABLE product (
  idproduct int(10) unsigned NOT NULL auto_increment,
  idtaxes tinyint(3) unsigned DEFAULT '0' NOT NULL,
  idcurrency tinyint(3) unsigned DEFAULT '0' NOT NULL,
  idport tinyint(10) unsigned DEFAULT '0' NOT NULL,
  stock int(11) DEFAULT '0' NOT NULL,
  price float unsigned DEFAULT '0' NOT NULL,
  realref varchar(20),
  oldprice float unsigned DEFAULT '0' NOT NULL,
  weight tinyint(3) unsigned DEFAULT '0' NOT NULL,
  state tinyint(3) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idproduct)
);

#
# Table structure for table 'profile'
#

CREATE TABLE profile (
  idprofile int(10) unsigned NOT NULL auto_increment,
  name varchar(30),
  emailfrom varchar(30),
  emailreply varchar(30),
  emailrequest varchar(30),
  signature tinytext,
  PRIMARY KEY (idprofile)
);

#
# Table structure for table 'property'
#

CREATE TABLE property (
  idproperty tinyint(3) unsigned NOT NULL auto_increment,
  propertyname varchar(50) DEFAULT '' NOT NULL,
  structure text DEFAULT '' NOT NULL,
  propertyflag varchar(20) DEFAULT '' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY (idproperty)
);

#
# Table structure for table 'pub'
#

CREATE TABLE pub (
  idpub int(10) unsigned NOT NULL auto_increment,
  name varchar(20) DEFAULT '' NOT NULL,
  image varchar(200) DEFAULT '' NOT NULL,
  url varchar(100) DEFAULT '' NOT NULL,
  media varchar(5) DEFAULT '' NOT NULL,
  type tinyint(4) unsigned DEFAULT '1' NOT NULL,
  description text DEFAULT '' NOT NULL,
  nbclick int(11) unsigned DEFAULT '0' NOT NULL,
  nbview int(11) unsigned DEFAULT '0' NOT NULL,
  nbmax int(11) unsigned DEFAULT '0' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  infos text DEFAULT '' NOT NULL,
  PRIMARY KEY (idpub),
  KEY idpub (idpub)
);

#
# Table structure for table 'publog'
#

CREATE TABLE publog (
  idpublog int(10) unsigned NOT NULL auto_increment,
  idvisitor int(11) unsigned DEFAULT '0' NOT NULL,
  remotehost char(100) DEFAULT '' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  idpub int(10) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idpublog)
);

#
# Table structure for table 'rating'
#

CREATE TABLE rating (
  idrating int(10) unsigned NOT NULL auto_increment,
  rate1 char(30) DEFAULT '' NOT NULL,
  rate2 char(30) DEFAULT '' NOT NULL,
  rate3 char(30) DEFAULT '' NOT NULL,
  rate4 char(30) DEFAULT '' NOT NULL,
  rate5 char(30) DEFAULT '' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY (idrating),
  KEY idrating (idrating)
);

#
# Table structure for table 'ratingresult'
#

CREATE TABLE ratingresult (
  idresult int(10) unsigned NOT NULL auto_increment,
  idref int(10) unsigned DEFAULT '0' NOT NULL,
  idvisitor int(10) unsigned DEFAULT '0' NOT NULL,
  value tinyint(3) unsigned DEFAULT '0' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY (idresult),
  KEY idrating (idresult)
);

#
# Table structure for table 'ref'
#

CREATE TABLE ref (
  idref int(11) unsigned NOT NULL auto_increment,
  idcontent int(11) unsigned DEFAULT '0' NOT NULL,
  name varchar(50),
  creationdate datetime,
  updatedate datetime,
  picture varchar(100),
  description varchar(100),
  longdescription text,
  keywords varchar(150),
  skin varchar(30),
  design varchar(20),
  icon varchar(30),
  template varchar(30),
  data longtext,
  idproperty tinyint(3) unsigned DEFAULT '0' NOT NULL,
  idowner int(10) unsigned DEFAULT '0' NOT NULL,
  up int(10) unsigned DEFAULT '0' NOT NULL,
  down int(10) unsigned DEFAULT '0' NOT NULL,
  next int(10) unsigned DEFAULT '0' NOT NULL,
  prev int(10) unsigned DEFAULT '0' NOT NULL,
  islink tinyint(3) unsigned DEFAULT '0' NOT NULL,
  link varchar(100),
  nbsubcat int(10) unsigned DEFAULT '0' NOT NULL,
  nbref int(10) unsigned DEFAULT '0' NOT NULL,
  idproduct int(10) unsigned DEFAULT '0' NOT NULL,
  productflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  idpoll tinyint(3) unsigned DEFAULT '0' NOT NULL,
  idfaq tinyint(3) unsigned DEFAULT '0' NOT NULL,
  logflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  idegroup tinyint(3) unsigned DEFAULT '0' NOT NULL,
  gbflag int(10) unsigned DEFAULT '0' NOT NULL,
  idforum tinyint(3) unsigned DEFAULT '0' NOT NULL,
  idform tinyint(3) unsigned DEFAULT '0' NOT NULL,
  caddieflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  pagenotifierflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  printableflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  ratingflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  alertflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  script varchar(30),
  idorder int(10) unsigned DEFAULT '0' NOT NULL,
  idpub tinyint(3) unsigned DEFAULT '0' NOT NULL,
  nodekey varchar(250) DEFAULT '0' NOT NULL,
  cut_flag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  copy_flag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  val1 varchar(50) DEFAULT '' NOT NULL,
  val2 varchar(50) DEFAULT '' NOT NULL,
  val3 varchar(50) DEFAULT '' NOT NULL,
  val4 varchar(50) DEFAULT '' NOT NULL,
  val5 varchar(50) DEFAULT '' NOT NULL,
  PRIMARY KEY (idref),
  KEY nodekey (nodekey)
);

#
# Table structure for table 'session'
#

CREATE TABLE session (
  idsession int(11) unsigned NOT NULL auto_increment,
  idnumsession int(11) unsigned DEFAULT '0' NOT NULL,
  idref int(11) unsigned DEFAULT '0' NOT NULL,
  description tinytext,
  quantity int(11) unsigned DEFAULT '1' NOT NULL,
  date datetime,
  price float unsigned DEFAULT '0' NOT NULL,
  status tinyint(3) unsigned DEFAULT '1' NOT NULL,
  taxes float DEFAULT '0' NOT NULL,
  currency float unsigned DEFAULT '0' NOT NULL,
  idport tinyint(4) unsigned DEFAULT '0' NOT NULL,
  idcurrency tinyint(3) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idsession)
);

#
# Table structure for table 'showcase'
#

CREATE TABLE showcase (
  idshowcase int(10) unsigned NOT NULL auto_increment,
  idref int(10) unsigned DEFAULT '0' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY (idshowcase),
  KEY idshowcase (idshowcase)
);

#
# Table structure for table 'taxes'
#

CREATE TABLE taxes (
  idtaxes int(11) unsigned NOT NULL auto_increment,
  name varchar(30),
  description varchar(100),
  rate float(10,2) unsigned DEFAULT '0.00' NOT NULL,
  PRIMARY KEY (idtaxes)
);

#
# Table structure for table 'theme'
#

CREATE TABLE theme (
  idtheme int(10) unsigned NOT NULL auto_increment,
  name varchar(100) DEFAULT '' NOT NULL,
  subject varchar(200) DEFAULT '' NOT NULL,
  image varchar(100) DEFAULT '' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY (idtheme),
  KEY idtheme (idtheme)
);

#
# Table structure for table 'users'
#

CREATE TABLE users (
  idusers int(10) unsigned NOT NULL auto_increment,
  login varchar(20),
  password varchar(20),
  power tinyint(4) DEFAULT '0' NOT NULL,
  lastname varchar(20),
  firstname varchar(20),
  creationdate datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  updatedate datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  lastsessiondate datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  email varchar(30),
  creator tinyint(4) DEFAULT '0' NOT NULL,
  nbconnect int(10) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idusers),
  KEY idusers (idusers),
  UNIQUE idusers_2 (idusers)
);

#
# Table structure for table 'visitor'
#

CREATE TABLE visitor (
  idvisitor int(11) unsigned NOT NULL auto_increment,
  nbrvis int(11) unsigned DEFAULT '0' NOT NULL,
  lang varchar(4) DEFAULT 'fr' NOT NULL,
  remotehost varchar(200),
  remoteaddr varchar(200),
  remoteuser varchar(200),
  system varchar(200),
  firstvis datetime,
  cookie tinyint(3) unsigned DEFAULT '1' NOT NULL,
  flash tinyint(3) unsigned DEFAULT '0' NOT NULL,
  lastvis datetime,
  idcsp tinyint(3) unsigned DEFAULT '0' NOT NULL,
  skin varchar(20),
  design varchar(20),
  urlfromfirstvis varchar(200),
  screen varchar(30),
  major varchar(30),
  idclient int(11) DEFAULT '0' NOT NULL,
  purchase_flag tinyint(4) DEFAULT '0' NOT NULL,
  urlfromlastvis varchar(200) DEFAULT '' NOT NULL,
  PRIMARY KEY (idvisitor)
);

