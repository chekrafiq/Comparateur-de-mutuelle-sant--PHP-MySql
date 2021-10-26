
#
# Table structure for table 'command'
#
DROP TABLE IF EXISTS command;
CREATE TABLE command (
  idcommand int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
  idchange int(11) unsigned DEFAULT '0' NOT NULL,
  idtva int(11),
  idnumsession int(11) unsigned DEFAULT '0' NOT NULL,
  idclient int(11) unsigned DEFAULT '0' NOT NULL,
  price double(16,4) unsigned DEFAULT '0.0000' NOT NULL,
  description text,
  date datetime,
  status int(11) unsigned DEFAULT '0' NOT NULL,
  pricettc double(16,4) unsigned DEFAULT '0.0000' NOT NULL,
  idport tinyint(3) unsigned DEFAULT '0' NOT NULL,
  idaffiliate int(10) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idcommand)
);

#
# Table structure for table 'content'
#
DROP TABLE IF EXISTS content;
CREATE TABLE content (
  idcontent int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
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
# Table structure for table 'hash'
#
DROP TABLE IF EXISTS hash;
CREATE TABLE hash (
  idhash int(10) unsigned DEFAULT '0' NOT NULL auto_increment,
  idref int(10) unsigned DEFAULT '0' NOT NULL,
  name varchar(50) DEFAULT '' NOT NULL,
  value text NOT NULL,
  uname varchar(50) DEFAULT '' NOT NULL,
  uvalue text NOT NULL,
  idproperty int(10) unsigned DEFAULT '0' NOT NULL,
  propertyname varchar(50) DEFAULT '' NOT NULL,
  refname varchar(50) DEFAULT '' NOT NULL,
  refdescription varchar(200) DEFAULT '' NOT NULL,
  up int(10) unsigned DEFAULT '0' NOT NULL,
  date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  PRIMARY KEY (idhash),
  KEY idhash (idhash)
);

#
# Table structure for table 'keywords'
#
DROP TABLE IF EXISTS keywords;
CREATE TABLE keywords (
  idkeyword int(10) unsigned DEFAULT '0' NOT NULL auto_increment,
  idvisitor int(10) unsigned DEFAULT '0' NOT NULL,
  keyword varchar(100) DEFAULT '' NOT NULL,
  configfile varchar(50) DEFAULT '' NOT NULL,
  date datetime,
  PRIMARY KEY (idkeyword)
);

#
# Table structure for table 'product'
#
DROP TABLE IF EXISTS product;
CREATE TABLE product (
  idproduct int(10) unsigned DEFAULT '0' NOT NULL auto_increment,
  idtva int(10) unsigned DEFAULT '0' NOT NULL,
  idchange int(10) unsigned DEFAULT '0' NOT NULL,
  idport int(10) unsigned DEFAULT '0' NOT NULL,
  stock int(11) DEFAULT '0' NOT NULL,
  price double(16,4) unsigned DEFAULT '0.0000' NOT NULL,
  realref varchar(20),
  oldprice double(16,4) unsigned DEFAULT '0.0000' NOT NULL,
  weight int(11) DEFAULT '0' NOT NULL,
  state tinyint(3) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idproduct)
);

#
# Table structure for table 'ref'
#
DROP TABLE IF EXISTS ref;
CREATE TABLE ref (
  idref int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
  idcontent int(11) unsigned DEFAULT '0' NOT NULL,
  name varchar(50),
  creationdate datetime,
  updatedate datetime,
  picture varchar(100),
  description varchar(100),
  longdescription text,
  keywords varchar(150),
  skin varchar(30),
  associatepageflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  design varchar(20),
  icon varchar(30),
  template varchar(30),
  data longtext,
  idproperty int(10) unsigned DEFAULT '0' NOT NULL,
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
  idpoll int(10) unsigned DEFAULT '0' NOT NULL,
  idfaq int(11) unsigned DEFAULT '0' NOT NULL,
  logflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  idegroup int(10) unsigned DEFAULT '0' NOT NULL,
  gbflag int(10) unsigned DEFAULT '0' NOT NULL,
  idforum int(10) unsigned DEFAULT '0' NOT NULL,
  idform int(10) unsigned DEFAULT '0' NOT NULL,
  caddieflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  pagenotifierflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  printableflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  ratingflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  cutflag tinyint(3) unsigned DEFAULT '0' NOT NULL,
  script varchar(30),
  idorder int(10) unsigned DEFAULT '0' NOT NULL,
  idpub int(10) unsigned DEFAULT '0' NOT NULL,
  PRIMARY KEY (idref)
);

#
# Table structure for table 'session'
#
DROP TABLE IF EXISTS session;
CREATE TABLE session (
  idsession int(11) unsigned DEFAULT '0' NOT NULL auto_increment,
  idnumsession int(11) unsigned DEFAULT '0' NOT NULL,
  idref int(11) unsigned DEFAULT '0' NOT NULL,
  description tinytext,
  quantity int(11) unsigned DEFAULT '1' NOT NULL,
  date datetime,
  price double(16,4),
  status int(11) DEFAULT '1' NOT NULL,
  idtaxes tinyint(3) unsigned DEFAULT '0' NOT NULL,
  idchange tinyint(4) unsigned DEFAULT '0' NOT NULL,
  weight int(11) DEFAULT '0' NOT NULL,
  PRIMARY KEY (idsession)
);

INSERT INTO content (title) VALUES('root');
INSERT INTO content (title) VALUES('accueil');

INSERT INTO ref (idcontent,name,longdescription,idproperty,keywords,logflag) VALUES('1','root','','3','kernix','0');
INSERT INTO ref (idcontent,name,longdescription,idproperty,keywords,logflag) VALUES('2', 'Bienvenue', 'Home Page', '3', 'kernix', '1');
