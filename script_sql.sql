
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

DROP TABLE IF EXISTS internaluser;
CREATE TABLE IF NOT EXISTS internaluser (
  iduser int(11) NOT NULL AUTO_INCREMENT,
  nom_user varchar(100) NOT NULL,
  prenom_user varchar(100) NOT NULL,
  email_user varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  username varchar(100) NULL,
  idrole varchar(100) NULL,
  PRIMARY KEY (iduser),
  FOREIGN KEY (idrole) REFERENCES role(idrole)
);

INSERT INTO internaluser (iduser,nom_user,prenom_user,email_user,password,username,idrole) VALUES
(1,"CAULLIREAU","Dorian","caullireau.dorian@gmail.com","password","caullird",1),
(2,"PERROLLAZ","Maverick","perrollaz.maverick@gmail.com","password","perollaz",1),
(3,"BASCOP","Alexandre","bascop.alexandre@gmail.com","password","bascopa",2),
(4,"PROF2","PROF2","PROF2.PROF2@gmail.com","password","PROF2",2),
(5,"admin","admin","admin@admin.admin","password","admin",3);


DROP TABLE IF EXISTS student;
CREATE TABLE IF NOT EXISTS student (
  idstudent int(11) NOT NULL AUTO_INCREMENT,
  num_INE varchar(100) NULL,
  num_student varchar(100) NULL,
  iduser int(11) NOT NULL,
  PRIMARY KEY (idstudent),
  FOREIGN KEY (iduser) REFERENCES internaluser(iduser)
);

INSERT INTO student (idstudent,num_INE,num_student,iduser) VALUES
(1,"1445D8854","8985444447",1),
(2,"14E5D8854","8944589447",2);

DROP TABLE IF EXISTS time_slot;
CREATE TABLE IF NOT EXISTS time_slot (
  idtime_slot int(11) NOT NULL AUTO_INCREMENT,
  date_day DATETIME NULL,
  start_time TIME NULL,
  end_time TIME NULL,
  PRIMARY KEY (idtime_slot)
);

INSERT INTO time_slot (idtime_slot,date_day,start_time,end_time) VALUES
(1,"2010-04-02","",""),
(2,"2010-04-02","",""),
(3,"2010-04-02","",""),
(4,"2010-04-02","","");

DROP TABLE IF EXISTS availability;
CREATE TABLE IF NOT EXISTS availability (
  idavailability int(11) NOT NULL AUTO_INCREMENT,
  iduser int(11) NOT NULL,
  idtime_slot int(11) NOT NULL,
  comment varchar(2048) NULL,
  PRIMARY KEY (idavailability),
  FOREIGN KEY (iduser) REFERENCES internaluser(iduser),
  FOREIGN KEY (idtime_slot) REFERENCES time_slot(idtime_slot)
); 

INSERT INTO availability (idavailability,iduser,idtime_slot,comment) VALUES
(1,3,1,"Dispo vraiment si besoin"),
(2,4,1,""),
(3,4,3,"Disponible");


DROP TABLE IF EXISTS classroom;
CREATE TABLE IF NOT EXISTS classroom (
  idclassroom int(11) NOT NULL AUTO_INCREMENT,
  name_classroom varchar(100) NULL,
  building_classroom varchar(100) NULL,
  capacity_classroom varchar(100) NULL,
  PRIMARY KEY (idclassroom)
);

INSERT INTO classroom(idclassroom,name_classroom,building_classroom,capacity_classroom) VALUES
(1,"C104","Bâtiment B","200 places assises"),
(2,"C204","Bâtiment C","200 places assises"),
(3,"T804","Bâtiment T","200 places assises");


DROP TABLE IF EXISTS jury;
CREATE TABLE IF NOT EXISTS jury (
  idjury int(11) NOT NULL AUTO_INCREMENT,
  idclassroom int(11) NOT NULL,
  idtime_slot int(11) NOT NULL,
  name_jury varchar(2048) NULL,
  PRIMARY KEY (idjury),
  FOREIGN KEY (idclassroom) REFERENCES classroom(idclassroom),
  FOREIGN KEY (idtime_slot) REFERENCES time_slot(idtime_slot)
);

INSERT INTO jury(idjury,idclassroom,idtime_slot,name_jury) VALUES
(1,1,1,"Jury de la honte"),
(2,2,2,"Jury des bg");

DROP TABLE IF EXISTS compose;
CREATE TABLE IF NOT EXISTS compose (
  idcompose int(11) NOT NULL AUTO_INCREMENT,
  iduser int(11) NOT NULL,
  idjury int(11) NOT NULL,
  PRIMARY KEY (idcompose),
  FOREIGN KEY (iduser) REFERENCES internaluser(iduser),
  FOREIGN KEY (idjury) REFERENCES jury(idjury)
);

INSERT INTO compose(idcompose,iduser,idjury) VALUES
(1,1,1),
(2,2,2);


DROP TABLE IF EXISTS event;
CREATE TABLE IF NOT EXISTS event (
  idevent int(11) NOT NULL AUTO_INCREMENT,
  entitled_event varchar(2048) NULL,
  description_event varchar(2048) NULL,
  idevent_creator int(11) NOT NULL,
  start_date DATETIME NOT NULL,
  end_date DATETIME NOT NULL,
  PRIMARY KEY (idevent),
  FOREIGN KEY (idevent_creator) REFERENCES internaluser(iduser)
);

INSERT INTO event(idevent,entitled_event,description_event,idevent_creator,start_date,end_date) VALUES
(1,"Soutenance des stage FI4","Description de l event",5,"2010-04-02","2010-04-03"),
(2,"Soutenance des stage FI3","Description de l event",5,"2010-04-02","2010-04-03");


DROP TABLE IF EXISTS prestation;
CREATE TABLE IF NOT EXISTS prestation (
  idprestation int(11) NOT NULL AUTO_INCREMENT,
  idstudent int(11) NOT NULL,
  idjury int(11) NOT NULL,
  idevent int(11) NOT NULL,
  start_time TIME NULL,
  end_time TIME NULL,
  comment_jury varchar(2048) NULL,
  PRIMARY KEY (idprestation),
  FOREIGN KEY (idstudent) REFERENCES student(idstudent),
  FOREIGN KEY (idjury) REFERENCES jury(idjury),
  FOREIGN KEY (idevent) REFERENCES event(idevent)
);

INSERT INTO prestation(idprestation,idstudent,idjury,idevent,start_time,end_time,comment_jury) VALUES 
(1,1,1,1,"","","Super incroyablement nickel"),
(2,2,1,1,"","","Finalement pas incroyable");

DROP TABLE IF EXISTS evaluation_criteria;
CREATE TABLE IF NOT EXISTS evaluation_criteria (
  idevaluation_criteria int(11) NOT NULL AUTO_INCREMENT,
  idevent int(11) NOT NULL,
  description_criteria varchar(2048) NULL,
  scale_criteria varchar(2048) NULL,
  PRIMARY KEY (idevaluation_criteria),
  FOREIGN KEY (idevent) REFERENCES event(idevent)
);

INSERT INTO evaluation_criteria(idevaluation_criteria,idevent,description_criteria,scale_criteria) VALUES
(1,1,"Contenu du diaporama","{A,B,C}"),
(2,1,"Communication","{0:20}");


DROP TABLE IF EXISTS individual_evaluation;
CREATE TABLE IF NOT EXISTS individual_evaluation (
  idindividual_evaluation int(11) NOT NULL AUTO_INCREMENT,
  idprestation int(11) NOT NULL,
  idevaluation_criteria int(11) NOT NULL,
  idcompose int(11) NOT NULL,
  individual_note varchar(25) NOT NULL,
  individual_comment varchar(255) NULL,
  PRIMARY KEY (idindividual_evaluation),
  FOREIGN KEY (idprestation) REFERENCES prestation(idprestation),
  FOREIGN KEY (idevaluation_criteria) REFERENCES evaluation_criteria(idevaluation_criteria),
  FOREIGN KEY (idcompose) REFERENCES compose(idcompose)
);


INSERT INTO individual_evaluation(idindividual_evaluation,idprestation,idevaluation_criteria,idcompose,individual_note,individual_comment) VALUES
(1,1,2,1,"20","Un peu lent dans la présentation"),
(2,1,1,1,"A","Finalement, surpris de ce sujet oral");



















