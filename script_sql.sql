set NAMES 'UTF8';

DROP TABLE IF EXISTS individualevaluation;
DROP TABLE IF EXISTS prestation;
DROP TABLE IF EXISTS notationstate;
DROP TABLE IF EXISTS belonggroup;
DROP TABLE IF EXISTS peoplegroup;
DROP TABLE IF EXISTS student;
DROP TABLE IF EXISTS compose;
DROP TABLE IF EXISTS jury;
DROP TABLE IF EXISTS timeslot;
DROP TABLE IF EXISTS classroom;
DROP TABLE IF EXISTS evaluationcriteria;
DROP TABLE IF EXISTS event;
DROP TABLE IF EXISTS responsecontact;
DROP TABLE IF EXISTS usercontact;
DROP TABLE IF EXISTS internaluser;
DROP TABLE IF EXISTS role;

CREATE TABLE IF NOT EXISTS role (
  idrole int(11) NOT NULL AUTO_INCREMENT,
  name_role varchar(100) NOT NULL,
  PRIMARY KEY (idrole)
);

INSERT INTO role (idrole,name_role) VALUES
(1,"Etudiant"),
(2,"Professeur"),
(3,"Administrateur");

CREATE TABLE IF NOT EXISTS internaluser (
  idinternaluser int(11) NOT NULL AUTO_INCREMENT,
  nom varchar(100) NOT NULL,
  prenom varchar(100) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  username varchar(100) NULL,
  idrole int(11) NULL,
  deleted boolean NOT NULL default FALSE,
  PRIMARY KEY (idinternaluser),
  FOREIGN KEY (idrole) REFERENCES role(idrole)
);

INSERT INTO internaluser (idinternaluser,nom,prenom,email,password,username,idrole) VALUES
(1,"CAULLIREAU","Dorian","dorian.caullireau@etu.univ-smb.fr","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","caullird",1),
(2,"PERROLLAZ","Maverick","maverick.perrollaz@etu.univ-smb.fr","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","perrollm",1),
(3,"KOEBERLE ","Celien","celien.koeberle@etu.univ-smb.fr","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","koeberlec",1),
(4,"MASSIT","Clement","clement.massit@etu.univ-smb.fr","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","massitc",1),
(5,"GOBJI","Zied","zied.gobji@etu.univ-smb.fr","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","gobjiz",1),
(6,"COCHARD","Antoine","antoine.cochard@etu.univ-smb.fr","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","cocharda",1),
(7,"SOUCHON","Romain","romain.souchon@etu.univ-smb.fr","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","souchonr",1),
(8,"FORRAY","Gabriel","gabriel.forray@etu.univ-smb.fr","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","forrayg",1),
(9,"ALLOUI","Ilham","ilham.alloui@univ-smb.fr","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","allouii",2),
(10,"VALET","Lionel","lionel.valet@univ-smb.fr","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","valetl",2),
(11,"Administrateur","","admin@admin.admin","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","admin",3);

CREATE TABLE IF NOT EXISTS student (
  idstudent int(11) NOT NULL AUTO_INCREMENT,
  num_INE varchar(100) NULL,
  num_student varchar(100) NULL,
  idinternaluser int(11) NOT NULL,
  PRIMARY KEY (idstudent),
  FOREIGN KEY (idinternaluser) REFERENCES internaluser(idinternaluser)
);

INSERT INTO student (idstudent,num_INE,num_student,idinternaluser) VALUES
(1,"1445D8854","8985444447",1),
(2,"1445D8855","8985444448",2),
(3,"1445D8856","8985444449",3),
(4,"1445D8857","8985444441",4),
(5,"1445D8858","8985444442",5),
(6,"1445D8859","8985444443",6),
(7,"1445D8860","8985444444",7),
(8,"14E5D8861","8944589444",8);

CREATE TABLE IF NOT EXISTS peoplegroup (
  idpeoplegroup int(11) NOT NULL AUTO_INCREMENT,
  title_peoplegroup varchar(500) NULL,
  description_peoplegroup varchar(500) NULL,
  PRIMARY KEY (idpeoplegroup)
);

INSERT INTO peoplegroup (idpeoplegroup,title_peoplegroup,description_peoplegroup) VALUES
(1,"IDU3",""),
(2,"IDU3-G1",""),
(3,"IDU3-G2","");

CREATE TABLE IF NOT EXISTS belonggroup (
  idbelonggroup int(11) NOT NULL AUTO_INCREMENT,
  idinternaluser int(11) NOT NULL,
  idpeoplegroup int(11) NOT NULL,
  PRIMARY KEY (idbelonggroup),
  FOREIGN KEY (idinternaluser) REFERENCES internaluser(idinternaluser),
  FOREIGN KEY (idpeoplegroup) REFERENCES peoplegroup(idpeoplegroup)
);

INSERT INTO belonggroup (idbelonggroup, idinternaluser,idpeoplegroup) VALUES
(1,1,1),
(2,2,1),
(3,3,1),
(4,4,1),
(5,5,1),
(6,6,1),
(7,7,1),
(8,8,1),

(9,1,2),
(10,2,2),
(11,3,2),
(12,4,3),
(13,5,2),
(14,6,3),
(15,7,3),
(16,8,2);

CREATE TABLE IF NOT EXISTS classroom (
  idclassroom int(11) NOT NULL AUTO_INCREMENT,
  name_classroom varchar(100) NULL,
  building_classroom varchar(100) NULL,
  capacity_classroom varchar(100) NULL,
  description_classroom varchar(500) NULL,
  PRIMARY KEY (idclassroom)
);

INSERT INTO classroom(idclassroom,name_classroom,building_classroom,capacity_classroom) VALUES
(1,"B14","Batiment B","200 places"),
(2,"B120","Batiment B","200 places"),
(3,"C107","Batiment C","19 places"),
(4,"C205","Batiment C","30 places"),
(5,"C206","Batiment C","30 places"),
(6,"C207","Batiment C","30 places"),
(7,"C208","Batiment C","30 places"),
(8,"A202","Batiment A","25 places"),
(9,"A203","Batiment A","25 places"),
(10,"A204","Batiment A","25 places");

CREATE TABLE IF NOT EXISTS timeslot (
  idtimeslot int(11) NOT NULL AUTO_INCREMENT,
  idinternaluser int(11) NOT NULL,
  disponibility  int(1) NOT NULL,
  meridiem DATETIME NOT NULL,
  PRIMARY KEY (idtimeslot)
);

INSERT INTO timeslot (idtimeslot,idinternaluser,disponibility,meridiem) VALUES
(1,9,4,CONCAT(CAST(Now() as date)," 14:00:00")),
(2,9,3,CONCAT(CAST(Now()+INTERVAL 4 DAY as date)," 08:00:00")),
(3,9,3,CONCAT(CAST(Now()+INTERVAL 4 DAY as date)," 14:00:00")),
(4,9,3,CONCAT(CAST(Now()+INTERVAL 5 DAY as date)," 08:00:00")),
(5,9,3,CONCAT(CAST(Now()+INTERVAL 5 DAY as date)," 14:00:00")),
(6,9,3,CONCAT(CAST(Now()+INTERVAL 6 DAY as date)," 08:00:00")),
(7,9,3,CONCAT(CAST(Now()+INTERVAL 6 DAY as date)," 14:00:00")),

(8,10,4,CONCAT(CAST(Now() as date)," 14:00:00")),
(9,10,3,CONCAT(CAST(Now()+INTERVAL 5 DAY as date)," 08:00:00")),
(10,10,3,CONCAT(CAST(Now()+INTERVAL 5 DAY as date)," 14:00:00")),
(11,10,3,CONCAT(CAST(Now()+INTERVAL 6 DAY as date)," 08:00:00")),
(12,10,3,CONCAT(CAST(Now()+INTERVAL 6 DAY as date)," 14:00:00")),
(13,10,3,CONCAT(CAST(Now()+INTERVAL 7 DAY as date)," 08:00:00")),
(14,10,3,CONCAT(CAST(Now()+INTERVAL 7 DAY as date)," 14:00:00"));

CREATE TABLE IF NOT EXISTS jury (
  idjury int(11) NOT NULL AUTO_INCREMENT,
  idclassroom int(11) NOT NULL,
  name_jury varchar(2048) NULL,
  meridiem DATETIME NOT NULL,
  PRIMARY KEY (idjury),
  FOREIGN KEY (idclassroom) REFERENCES classroom(idclassroom)
);

INSERT INTO jury(idjury,idclassroom,name_jury,meridiem) VALUES
(1,3,"ALLOUI VALET",CONCAT(CAST(Now()-INTERVAL 1 DAY as date)," 14:00:00")),
(2,3,"ALLOUI VALET",CONCAT(CAST(Now() as date)," 14:00:00")),
(3,3,"ALLOUI VALET",CONCAT(CAST(Now()-INTERVAL 1 MONTH as date)," 14:00:00"));

CREATE TABLE IF NOT EXISTS event (
  idevent int(11) NOT NULL AUTO_INCREMENT,
  entitled_event varchar(2048) NULL,
  description_event varchar(2048) NULL,
  idevent_creator int(11) NOT NULL,
  start_date DATETIME NOT NULL,
  end_date DATETIME NOT NULL,
  PRIMARY KEY (idevent),
  FOREIGN KEY (idevent_creator) REFERENCES internaluser(idinternaluser)
);

INSERT INTO event(idevent,entitled_event,description_event,idevent_creator,start_date,end_date) VALUES
(1,"Soutenance d'INFO642","Présentation des projets réalisés",10,CAST(Now()-INTERVAL 1 DAY as date), CAST(Now() as date)),
(2,"Soutenance d'INFO635","Présentation des projets réalisés",10,CAST(Now()-INTERVAL 1 MONTH-INTERVAL 1 DAY as date), CAST(Now()-INTERVAL 1 MONTH as date));

CREATE TABLE IF NOT EXISTS notationstate (
  idnotationstate int(11) NOT NULL AUTO_INCREMENT,
  state varchar(255) NULL,
  PRIMARY KEY (idnotationstate)
);

INSERT INTO notationstate(idnotationstate,state) VALUES
(1,"En attente de notation"),
(2,"En attente de validation"),
(3,"Affiché");

CREATE TABLE IF NOT EXISTS prestation (
  idprestation int(11) NOT NULL AUTO_INCREMENT,
  idstudent int(11) NOT NULL,
  idjury int(11) NOT NULL,
  idevent int(11) NOT NULL,
  date_prestation DATETIME NULL,
  start_time TIME NULL,
  end_time TIME NULL,
  comment_jury varchar(2048) NULL,
  idnotationstate int(11) NOT NULL,
  PRIMARY KEY (idprestation),
  FOREIGN KEY (idstudent) REFERENCES student(idstudent),
  FOREIGN KEY (idjury) REFERENCES jury(idjury),
  FOREIGN KEY (idevent) REFERENCES event(idevent),
  FOREIGN KEY (idnotationstate) REFERENCES notationstate(idnotationstate)
);

INSERT INTO prestation(idprestation,idstudent,idjury,idevent,date_prestation,start_time,end_time,comment_jury,idnotationstate) VALUES
(1,1,1,1,CAST(Now()-INTERVAL 1 DAY as date),"14:00:00","14:20:00","Très bonne présentation",3),
(2,2,1,1,CAST(Now()-INTERVAL 1 DAY as date),"14:20:00","14:40:00","Contenu de la présentation respectée",3),
(3,3,2,1,CAST(Now() as date),"14:00:00","14:20:00","",1),
(4,5,2,1,CAST(Now() as date),"14:20:00","14:40:00","",1),
(5,8,2,1,CAST(Now() as date),"14:40:00","15:00:00","",1),
(6,5,3,2,CAST(Now()-INTERVAL 1 MONTH as date),"14:00:00","15:00:00","",3);

CREATE TABLE IF NOT EXISTS compose (
  idcompose int(11) NOT NULL AUTO_INCREMENT,
  idinternaluser int(11) NOT NULL,
  idjury int(11) NOT NULL,
  PRIMARY KEY (idcompose),
  FOREIGN KEY (idinternaluser) REFERENCES internaluser(idinternaluser),
  FOREIGN KEY (idjury) REFERENCES jury(idjury)
);

INSERT INTO compose(idcompose,idinternaluser,idjury) VALUES
(1,9,1),
(2,10,1),
(3,9,2),
(4,10,2),
(5,9,3),
(6,10,3);

CREATE TABLE IF NOT EXISTS evaluationcriteria (
  idevaluationcriteria int(11) NOT NULL AUTO_INCREMENT,
  idevent int(11) NOT NULL,
  description_criteria varchar(2048) NULL,
  scale_criteria varchar(2048) NULL,
  PRIMARY KEY (idevaluationcriteria),
  FOREIGN KEY (idevent) REFERENCES event(idevent)
);

INSERT INTO evaluationcriteria(idevaluationcriteria,idevent,description_criteria,scale_criteria) VALUES
(1,1,"Contenu du diaporama","{0:20}"),
(2,1,"Communication","{0:20}");

CREATE TABLE IF NOT EXISTS individualevaluation (
  idindividualevaluation int(11) NOT NULL AUTO_INCREMENT,
  idprestation int(11) NOT NULL,
  idevaluationcriteria int(11) NOT NULL,
  idcompose int(11) NOT NULL,
  individual_note varchar(25) NOT NULL,
  individual_comment varchar(2046) NULL,
  PRIMARY KEY (idindividualevaluation),
  FOREIGN KEY (idprestation) REFERENCES prestation(idprestation),
  FOREIGN KEY (idevaluationcriteria) REFERENCES evaluationcriteria(idevaluationcriteria),
  FOREIGN KEY (idcompose) REFERENCES compose(idcompose)
);

INSERT INTO individualevaluation(idindividualevaluation,idprestation,idevaluationcriteria,idcompose,individual_note,individual_comment) VALUES
(1,1,1,1,"12","Diaporama trop rempli"),
(2,1,2,2,"18","Surpris par les termes avancés utilisés dans sont oral"),
(3,2,1,1,"16","Magnifique diaporama"),
(4,2,2,2,"14","En retrait durant la présentation orale"),
(5,6,1,1,"14","Diaporama bien réalisé"),
(6,6,2,1,"15","Bonne présentation dans l'ensemble");

CREATE TABLE IF NOT EXISTS usercontact (
  idusercontact int(11) NOT NULL AUTO_INCREMENT,
  idinternaluser_requestor int(11) NOT NULL,
  idinternaluser_receiver int(11) NOT NULL,
  title_contact varchar(2046) NULL,
  description_contact varchar(2046) NULL,
  date_contact DATETIME NULL,
  have_response boolean NULL,
  is_close boolean NULL,
  PRIMARY KEY (idusercontact),
  FOREIGN KEY (idinternaluser_requestor) REFERENCES internaluser(idinternaluser),
  FOREIGN KEY (idinternaluser_receiver) REFERENCES internaluser(idinternaluser)
);

INSERT INTO usercontact (idusercontact, idinternaluser_requestor,idinternaluser_receiver,title_contact,description_contact,date_contact,have_response,is_close) VALUES
(1,1,11,"Erreur sur le site","Erreur quand je clique sur le bouton logout",CAST(Now()-INTERVAL 5 DAY as date),1,0);

CREATE TABLE IF NOT EXISTS responsecontact (
  idresponsecontact int(11) NOT NULL AUTO_INCREMENT,
  idusercontact int(11) NOT NULL,
  idinternaluser_requestor int(11) NOT NULL,
  idinternaluser_receiver int(11) NOT NULL,
  title_response varchar(2046) NULL,
  text_response varchar(2046) NULL,
  date_response DATETIME NULL,
  PRIMARY KEY (idresponsecontact),
  FOREIGN KEY (idusercontact) REFERENCES usercontact(idusercontact),
  FOREIGN KEY (idinternaluser_requestor) REFERENCES internaluser(idinternaluser),
  FOREIGN KEY (idinternaluser_receiver) REFERENCES internaluser(idinternaluser)
);

INSERT INTO responsecontact(idresponsecontact, idusercontact, idinternaluser_requestor, idinternaluser_receiver ,title_response , text_response,date_response) VALUES
(1,1,11,1,"C'est noté !","Je ferai mon possible pour régler ça",CAST(Now()-INTERVAL 4 DAY as date));
