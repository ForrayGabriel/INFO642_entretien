
DROP TABLE IF EXISTS role;
CREATE TABLE IF NOT EXISTS role (
  id_role int(11) NOT NULL AUTO_INCREMENT,
  name_role varchar(100) NOT NULL,
  PRIMARY KEY (id_role)
);

INSERT INTO role (id_role,name_role) VALUES
(1,"Etudiant"),
(2,"Professeur"),
(3,"Administrateur");

DROP TABLE IF EXISTS internal_user;
CREATE TABLE IF NOT EXISTS internal_user (
  id_user int(11) NOT NULL AUTO_INCREMENT,
  nom_user varchar(100) NOT NULL,
  prenom_user varchar(100) NOT NULL,
  email_user varchar(100) NOT NULL,
  password varchar(100) NOT NULL,
  username varchar(100) NULL,
  id_role varchar(100) NULL,
  PRIMARY KEY (id_user),
  FOREIGN KEY (id_role) REFERENCES role(id_role)
);

INSERT INTO internal_user (id_user,nom_user,prenom_user,email_user,password,username,id_role) VALUES
(1,"CAULLIREAU","Dorian","caullireau.dorian@gmail.com","password","caullird",1),
(2,"PERROLLAZ","Maverick","perrollaz.maverick@gmail.com","password","perollaz",1),
(3,"BASCOP","Alexandre","bascop.alexandre@gmail.com","password","bascopa",2),
(4,"PROF2","PROF2","PROF2.PROF2@gmail.com","password","PROF2",2),
(5,"admin","admin","admin@admin.admin","password","admin",3);


DROP TABLE IF EXISTS student;
CREATE TABLE IF NOT EXISTS student (
  id_student int(11) NOT NULL AUTO_INCREMENT,
  num_INE varchar(100) NULL,
  num_student varchar(100) NULL,
  id_user int(11) NOT NULL,
  PRIMARY KEY (id_student),
  FOREIGN KEY (id_user) REFERENCES internal_user(id_user)
);

INSERT INTO student (id_student,num_INE,num_student,id_user) VALUES
(1,"1445D8854","8985444447",1),
(2,"14E5D8854","8944589447",2);

DROP TABLE IF EXISTS time_slot;
CREATE TABLE IF NOT EXISTS time_slot (
  id_time_slot int(11) NOT NULL AUTO_INCREMENT,
  date_day DATETIME NULL,
  start_time TIME NULL,
  end_time TIME NULL,
  PRIMARY KEY (id_time_slot)
);

INSERT INTO time_slot (id_time_slot,date_day,start_time,end_time) VALUES
(1,"2010-04-02","",""),
(2,"2010-04-02","",""),
(3,"2010-04-02","",""),
(4,"2010-04-02","","");

DROP TABLE IF EXISTS availability;
CREATE TABLE IF NOT EXISTS availability (
  id_availability int(11) NOT NULL AUTO_INCREMENT,
  id_user int(11) NOT NULL,
  id_time_slot int(11) NOT NULL,
  comment varchar(2048) NULL,
  PRIMARY KEY (id_availability),
  FOREIGN KEY (id_user) REFERENCES internal_user(id_user),
  FOREIGN KEY (id_time_slot) REFERENCES time_slot(id_time_slot)
); 

INSERT INTO availability (id_availability,id_user,id_time_slot,comment) VALUES
(1,3,1,"Dispo vraiment si besoin"),
(2,4,1,""),
(3,4,3,"Disponible");


DROP TABLE IF EXISTS classrom;
CREATE TABLE IF NOT EXISTS classrom (
  id_classrom int(11) NOT NULL AUTO_INCREMENT,
  name_classrom varchar(100) NULL,
  building_classrom varchar(100) NULL,
  capacity_classrom varchar(100) NULL,
  PRIMARY KEY (id_classrom)
);

INSERT INTO classrom(id_classrom,name_classrom,building_classrom,capacity_classrom) VALUES
(1,"C104","Bâtiment B","200 places assises"),
(2,"C204","Bâtiment C","200 places assises"),
(3,"T804","Bâtiment T","200 places assises");


DROP TABLE IF EXISTS jury;
CREATE TABLE IF NOT EXISTS jury (
  id_jury int(11) NOT NULL AUTO_INCREMENT,
  id_classrom int(11) NOT NULL,
  id_time_slot int(11) NOT NULL,
  name_jury varchar(2048) NULL,
  PRIMARY KEY (id_jury),
  FOREIGN KEY (id_classrom) REFERENCES classrom(id_classrom),
  FOREIGN KEY (id_time_slot) REFERENCES time_slot(id_time_slot)
);

INSERT INTO jury(id_jury,id_classrom,id_time_slot,name_jury) VALUES
(1,1,1,"Jury de la honte"),
(2,2,2,"Jury des bg");

DROP TABLE IF EXISTS compose;
CREATE TABLE IF NOT EXISTS compose (
  id_compose int(11) NOT NULL AUTO_INCREMENT,
  id_user int(11) NOT NULL,
  id_jury int(11) NOT NULL,
  PRIMARY KEY (id_compose),
  FOREIGN KEY (id_user) REFERENCES internal_user(id_user),
  FOREIGN KEY (id_jury) REFERENCES jury(id_jury)
);

INSERT INTO compose(id_compose,id_user,id_jury) VALUES
(1,1,1),
(2,2,2);


DROP TABLE IF EXISTS event;
CREATE TABLE IF NOT EXISTS event (
  id_event int(11) NOT NULL AUTO_INCREMENT,
  entitled_event varchar(2048) NULL,
  description_event varchar(2048) NULL,
  id_event_creator int(11) NOT NULL,
  start_date DATETIME NOT NULL,
  end_date DATETIME NOT NULL,
  PRIMARY KEY (id_event),
  FOREIGN KEY (id_event_creator) REFERENCES internal_user(id_user)
);

INSERT INTO event(id_event,entitled_event,description_event,id_event_creator,start_date,end_date) VALUES
(1,"Soutenance des stage FI4","Description de l event",5,"2010-04-02","2010-04-03"),
(2,"Soutenance des stage FI3","Description de l event",5,"2010-04-02","2010-04-03");


DROP TABLE IF EXISTS prestation;
CREATE TABLE IF NOT EXISTS prestation (
  id_prestation int(11) NOT NULL AUTO_INCREMENT,
  id_student int(11) NOT NULL,
  id_jury int(11) NOT NULL,
  id_event int(11) NOT NULL,
  start_time TIME NULL,
  end_time TIME NULL,
  comment_jury varchar(2048) NULL,
  PRIMARY KEY (id_prestation),
  FOREIGN KEY (id_student) REFERENCES student(id_student),
  FOREIGN KEY (id_jury) REFERENCES jury(id_jury),
  FOREIGN KEY (id_event) REFERENCES event(id_event)
);

INSERT INTO prestation(id_prestation,id_student,id_jury,id_event,start_time,end_time,comment_jury) VALUES 
(1,1,1,1,"","","Super incroyablement nickel"),
(2,2,1,1,"","","Finalement pas incroyable");

DROP TABLE IF EXISTS evaluation_criteria;
CREATE TABLE IF NOT EXISTS evaluation_criteria (
  id_evaluation_criteria int(11) NOT NULL AUTO_INCREMENT,
  id_event int(11) NOT NULL,
  description_criteria varchar(2048) NULL,
  scale_criteria varchar(2048) NULL,
  PRIMARY KEY (id_evaluation_criteria),
  FOREIGN KEY (id_event) REFERENCES event(id_event)
);

INSERT INTO evaluation_criteria(id_evaluation_criteria,id_event,description_criteria,scale_criteria) VALUES
(1,1,"Contenu du diaporama","{A,B,C}"),
(2,1,"Communication","{0:20}");


DROP TABLE IF EXISTS individual_evaluation;
CREATE TABLE IF NOT EXISTS individual_evaluation (
  id_individual_evaluation int(11) NOT NULL AUTO_INCREMENT,
  id_prestation int(11) NOT NULL,
  id_evaluation_criteria int(11) NOT NULL,
  id_compose int(11) NOT NULL,
  individual_note varchar(25) NOT NULL,
  individual_comment varchar(255) NULL,
  PRIMARY KEY (id_individual_evaluation),
  FOREIGN KEY (id_prestation) REFERENCES prestation(id_prestation),
  FOREIGN KEY (id_evaluation_criteria) REFERENCES evaluation_criteria(id_evaluation_criteria),
  FOREIGN KEY (id_compose) REFERENCES compose(id_compose)
);


INSERT INTO individual_evaluation(id_individual_evaluation,id_prestation,id_evaluation_criteria,id_compose,individual_note,individual_comment) VALUES
(1,1,2,1,"20","Un peu lent dans la présentation"),
(2,1,1,1,"A","Finalement, surpris de ce sujet oral");



















