DROP TABLE IF EXISTS individualevaluation;
DROP TABLE IF EXISTS prestation;
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
(11,"admin","admin","admin@admin.admin","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","admin",3);

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
(3,"IDU3-G2",""),
(4,"IDU4",""),
(5,"IDU5",""),
(6,"FI3","");

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
(2,1,2),
(3,1,6),
(4,2,1),
(5,2,2),
(6,2,6),
(7,3,1),
(8,3,2),
(9,3,6),
(10,4,1),
(11,4,3),
(12,4,6),
(13,5,1),
(14,5,2),
(15,5,6),
(16,6,1),
(17,6,3),
(18,6,6),
(19,7,1),
(20,7,3),
(21,7,6),
(22,8,1),
(23,8,2),
(24,8,6);

CREATE TABLE IF NOT EXISTS classroom (
  idclassroom int(11) NOT NULL AUTO_INCREMENT,
  name_classroom varchar(100) NULL,
  building_classroom varchar(100) NULL,
  capacity_classroom varchar(100) NULL,
  description_classroom varchar(500) NULL,
  PRIMARY KEY (idclassroom)
);

INSERT INTO classroom(idclassroom,name_classroom,building_classroom,capacity_classroom) VALUES
(1,"B14","Batiment B","200 places assises"),
(2,"B120","Batiment B","200 places assises"),
(3,"C204","Batiment C","30 places assises"),
(4,"C205","Batiment C","30 places assises"),
(5,"C206","Batiment C","30 places assises"),
(6,"C207","Batiment C","30 places assises"),
(7,"C208","Batiment C","30 places assises"),
(8,"A202","Batiment A","25 places assises"),
(9,"A203","Batiment A","25 places assises"),
(10,"A204","Batiment A","25 places assises");

CREATE TABLE IF NOT EXISTS timeslot (
  idtimeslot int(11) NOT NULL AUTO_INCREMENT,
  idinternaluser int(11) NOT NULL,
  disponibility  int(1) NOT NULL,
  meridiem DATETIME NOT NULL,
  PRIMARY KEY (idtimeslot)
);

INSERT INTO timeslot (idtimeslot,idinternaluser,disponibility,meridiem) VALUES
(1,1,1,NOW()),
(2,2,2,NOW()),
(3,2,3,NOW()-INTERVAL 1 DAY),
(4,2,4,NOW()+INTERVAL 1 DAY);

CREATE TABLE IF NOT EXISTS jury (
  idjury int(11) NOT NULL AUTO_INCREMENT,
  idclassroom int(11) NOT NULL,
  idtimeslot int(11) NOT NULL,
  name_jury varchar(2048) NULL,
  PRIMARY KEY (idjury),
  FOREIGN KEY (idclassroom) REFERENCES classroom(idclassroom),
  FOREIGN KEY (idtimeslot) REFERENCES timeslot(idtimeslot)
);

INSERT INTO jury(idjury,idclassroom,idtimeslot,name_jury) VALUES
(1,1,1,"Jury A"),
(2,2,2,"Jury B");

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
(1,"Soutenance des stage FI4","Oral de fin de stage",11,"2021-05-20","2021-06-15"),
(2,"Soutenance des stage FI3","Oral de fin de stage",11,"2021-04-20","2021-05-15"),
(3,"Oral concour GEIPI","Oral de sélection des futures PIEP1",11,"2021-04-10","2021-04-15");

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

INSERT INTO prestation(idprestation,idstudent,idjury,idevent,date_prestation,start_time,end_time,comment_jury) VALUES
(1,1,1,1,"2021-04-22","","","Très bonne présentation"),
(2,1,1,1,"2021-04-26","","","Manque de sérieux"),
(3,2,1,2,"2021-05-5","","","Présentation correcte"),
(4,2,1,2,"2021-06-10","","","Clair et précis");


CREATE TABLE IF NOT EXISTS notationstate (
  idnotationstate int(11) NOT NULL AUTO_INCREMENT,
  state varchar(255) NULL,
  PRIMARY KEY (idnotationstate)
);

INSERT INTO notationstate(idnotationstate,state) VALUES
(1,"En attente de notation"),
(2,"En attente de validation"),
(3,"Affiché");




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
(3,9,2);

CREATE TABLE IF NOT EXISTS evaluationcriteria (
  idevaluationcriteria int(11) NOT NULL AUTO_INCREMENT,
  idevent int(11) NOT NULL,
  description_criteria varchar(2048) NULL,
  scale_criteria varchar(2048) NULL,
  PRIMARY KEY (idevaluationcriteria),
  FOREIGN KEY (idevent) REFERENCES event(idevent)
);

INSERT INTO evaluationcriteria(idevaluationcriteria,idevent,description_criteria,scale_criteria) VALUES
(1,1,"Contenu du diaporama","{A,B,C}"),
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
(1,1,2,1,"20","Un peu lent dans la présentation"),
(2,1,1,1,"A","Finalement, surpris de ce sujet oral");


CREATE TABLE IF NOT EXISTS usercontact (
  idusercontact int(11) NOT NULL AUTO_INCREMENT,
  idinternaluser_requestor int(11) NOT NULL,
  idinternaluser_receiver int(11) NOT NULL,
  title_contact varchar(2046) NULL,
  description_contact varchar(2046) NULL,
  date_contact DATETIME NULL,
  type_demande varchar(1000) NULL,
  have_response boolean NULL,
  is_close boolean NULL,
  PRIMARY KEY (idusercontact),
  FOREIGN KEY (idinternaluser_requestor) REFERENCES internaluser(idinternaluser),
  FOREIGN KEY (idinternaluser_receiver) REFERENCES internaluser(idinternaluser)
);

INSERT INTO usercontact (idusercontact, idinternaluser_requestor,idinternaluser_receiver,title_contact,description_contact,date_contact,type_demande,have_response,is_close) VALUES
(1,1,11,"Erreur sur le site","Erreur quand je clique sur le bouton logout","2021-04-02","Erreur",1,0),
(2,1,11,"Probleme","Probleme quand je clique sur le bouton logout","2021-04-02","Erreur",1,0);

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
(1,1,11,1,"C'est noté !","Je ferai mon possible pour régler ça","2021-04-02"),
(2,1,11,1,"C'est problématique","Passe me voir dans mon bureau pour régler ça","2021-04-02");
