DROP TABLE IF EXISTS individualevaluation;
DROP TABLE IF EXISTS prestation;
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
  nom_internaluser varchar(100) NOT NULL,
  prenom_internaluser varchar(100) NOT NULL,
  email_internaluser varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  username varchar(100) NULL,
  idrole int(11) NULL,
  PRIMARY KEY (idinternaluser),
  FOREIGN KEY (idrole) REFERENCES role(idrole)
);

INSERT INTO internaluser (idinternaluser,nom_internaluser,prenom_internaluser,email_internaluser,password,username,idrole) VALUES
(1,"CAULLIREAU","Dorian","caullireau.dorian@gmail.com","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","caullird",1),
(2,"PERROLLAZ","Maverick","perrollaz.maverick@pm.com","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","perrollm",1),
(3,"BASCOP","Alexandre","bascop.alexandre@gmail.com","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","bascopa",2),
(4,"PROF2","PROF2","PROF2.PROF2@gmail.com","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","PROF2",2),
(5,"admin","admin","admin@admin.admin","$2y$10$8.V7eL2.V02RR7gbut/QIeyS0KHl0f6HvCDZQASqpjfC4OQMKPASS","admin",3);

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
(2,"14E5D8854","8944589447",2);

CREATE TABLE IF NOT EXISTS classroom (
  idclassroom int(11) NOT NULL AUTO_INCREMENT,
  name_classroom varchar(100) NULL,
  building_classroom varchar(100) NULL,
  capacity_classroom varchar(100) NULL,
  description_classroom varchar(500) NULL,
  PRIMARY KEY (idclassroom)
);

INSERT INTO classroom(idclassroom,name_classroom,building_classroom,capacity_classroom) VALUES
(1,"C104","Bâtiment B","200 places assises"),
(2,"C204","Bâtiment C","200 places assises"),
(3,"T804","Bâtiment T","200 places assises");

CREATE TABLE IF NOT EXISTS timeslot (
  idtimeslot int(11) NOT NULL AUTO_INCREMENT,
  idinternaluser int(11) NOT NULL,
  disponibility  int(1) NOT NULL,
  meridiem DATETIME NOT NULL,
  PRIMARY KEY (idtimeslot)
);

INSERT INTO timeslot (idtimeslot,idinternaluser,disponibility,meridiem) VALUES
(1,1,0,NOW()),
(2,2,0,NOW()),
(3,2,0,NOW()-INTERVAL 1 DAY),
(4,2,0,NOW()+INTERVAL 1 DAY);

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
(1,1,1,"Jury de la honte"),
(2,2,2,"Jury des bg");

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
(1,"Soutenance des stage FI4","Description de l event",5,"2010-04-02","2010-04-03"),
(2,"Soutenance des stage FI3","Description de l event",5,"2010-04-02","2010-04-03");

CREATE TABLE IF NOT EXISTS prestation (
  idprestation int(11) NOT NULL AUTO_INCREMENT,
  idstudent int(11) NOT NULL,
  idjury int(11) NOT NULL,
  idevent int(11) NOT NULL,
  date_prestation DATETIME NULL,
  start_time TIME NULL,
  end_time TIME NULL,
  comment_jury varchar(2048) NULL,
  PRIMARY KEY (idprestation),
  FOREIGN KEY (idstudent) REFERENCES student(idstudent),
  FOREIGN KEY (idjury) REFERENCES jury(idjury),
  FOREIGN KEY (idevent) REFERENCES event(idevent)
);

INSERT INTO prestation(idprestation,idstudent,idjury,idevent,date_prestation,start_time,end_time,comment_jury) VALUES 
(1,1,1,1,"2010-04-02","","","Super incroyablement nickel"),
(2,2,1,1,"2010-04-02","","","Finalement pas incroyable");

CREATE TABLE IF NOT EXISTS compose (
  idcompose int(11) NOT NULL AUTO_INCREMENT,
  idinternaluser int(11) NOT NULL,
  idjury int(11) NOT NULL,
  PRIMARY KEY (idcompose),
  FOREIGN KEY (idinternaluser) REFERENCES internaluser(idinternaluser),
  FOREIGN KEY (idjury) REFERENCES jury(idjury)
);

INSERT INTO compose(idcompose,idinternaluser,idjury) VALUES
(1,1,1),
(2,2,2);

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
  iduser_requestor int(11) NOT NULL,
  iduser_receiver int(11) NOT NULL,
  title_contact varchar(2046) NULL,
  description_contact varchar(2046) NULL,
  date_contact DATETIME NULL,
  type_demande varchar(1000) NULL,
  have_response boolean NULL,
  is_close boolean NULL,
  PRIMARY KEY (idusercontact),
  FOREIGN KEY (iduser_requestor) REFERENCES internaluser(idinternaluser),
  FOREIGN KEY (iduser_receiver) REFERENCES internaluser(idinternaluser)
);

INSERT INTO usercontact (idusercontact, iduser_requestor,iduser_receiver,title_contact,description_contact,date_contact,type_demande,have_response,is_close) VALUES
(1,1,5,"Erreur sur le site","Erreur quand je clique sur le bouton logout","2010-04-02","Erreur",1,0),
(2,1,5,"Problèle","Problèle quand je clique sur le bouton logout","2010-04-02","Erreur",1,0);

CREATE TABLE IF NOT EXISTS responsecontact (
  idresponsecontact int(11) NOT NULL AUTO_INCREMENT,
  idusercontact int(11) NOT NULL,
  iduser_requestor int(11) NOT NULL,
  iduser_receiver int(11) NOT NULL,
  title_response varchar(2046) NULL,
  text_response varchar(2046) NULL,
  date_response DATETIME NULL,
  admin_response boolean NULL,
  PRIMARY KEY (idresponsecontact),
  FOREIGN KEY (idusercontact) REFERENCES usercontact(idusercontact),
  FOREIGN KEY (iduser_requestor) REFERENCES internaluser(idinternaluser),
  FOREIGN KEY (iduser_receiver) REFERENCES internaluser(idinternaluser)
);

INSERT INTO responsecontact(idresponsecontact, idusercontact, iduser_requestor, iduser_receiver ,title_response , text_response,date_response ,admin_response) VALUES 
(1,1,5,1,"C'est noté !","Tu veux du pain ou quoi ?","2010-04-02",1),
(2,1,5,1,"C'est pas noté !","Tu veux du lait ou quoi ?","2010-04-02",1);
