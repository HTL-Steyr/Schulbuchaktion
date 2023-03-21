insert into book (id, subject_id_id, publisher_id_id, book_number, title, short_title, list_type, school_form, ebook, ebook_plus) values (1, 2, 4, 3, 'Nachrichtentechnik', 'Nt', 1, 3, false, false);
insert into book (id, subject_id_id, publisher_id_id, book_number, title, short_title, list_type, school_form, ebook, ebook_plus) values (2, 1, 3, 3, 'Big Bang', 'BB', 2, 1, false, false);
insert into book (id, subject_id_id, publisher_id_id, book_number, title, short_title, list_type, school_form, ebook, ebook_plus) values (3, 1, 1, 2, 'Ingeneur-Mathetik', 'IM', 2, 3, false, true);
insert into book (id, subject_id_id, publisher_id_id, book_number, title, short_title, list_type, school_form, ebook, ebook_plus, main_book_id_id) values (4, 1, 1, 4, 'Recht für Techniker', 'RfT', 4, 1, false, false, 5);
insert into book (id, subject_id_id, publisher_id_id, book_number, title, short_title, list_type, school_form, ebook, ebook_plus, main_book_id_id) values (5, 3, 2, 3, 'Wirtschaft für Techniker', 'WfT', 5, 2, false, true, 4);

insert into book_price (book_id_id, year, price_inclusive_ebook, price_ebook, price_ebook_plus) VALUES (1,2012,550,150,200);
insert into book_price (book_id_id, year, price_inclusive_ebook, price_ebook, price_ebook_plus) VALUES (2,2016,500,150,250);
insert into book_price (book_id_id, year, price_inclusive_ebook, price_ebook, price_ebook_plus) VALUES (3,2020,700,154,232);
insert into book_price (book_id_id, year, price_inclusive_ebook, price_ebook, price_ebook_plus) VALUES (4,2021,623,165,223);
insert into book_price (book_id_id, year, price_inclusive_ebook, price_ebook, price_ebook_plus) VALUES (5,2020,546,176,243);

insert into department (head_of_department_id, name, budget, used_budget) VALUES (1,'Kawilutscha',500000,14456);
insert into department (head_of_department_id, name, budget, used_budget) VALUES (2,'Netzweaka',5000000,12586);
insert into department (head_of_department_id, name, budget, used_budget) VALUES (3,'Maschinenbaua',800000,23356);
insert into department (head_of_department_id, name, budget, used_budget) VALUES (4,'Moler',200000,12359);
insert into department (head_of_department_id, name, budget, used_budget) VALUES (5,'Lehrbuam',600000,45612);

insert into user (role_id_id, short_name, first_name, last_name, email, token, password) VALUES (3,'cchimani','Christian','Chimani','cchimani@htl-steyr.ac.at','asjdflhadsf7824gbjk','a');
insert into user (role_id_id, short_name, first_name, last_name, email, token, password) VALUES (3,'meder1','Manuel','Eder','meder1@htl-steyr.ac.at','awedfjkiz17zue','a');
insert into user (role_id_id, short_name, first_name, last_name, email, token, password) VALUES (3,'emik','Elias','Miklutsch','emik@htl-steyr.ac.at','dkasfjhkui12edsa','a');
insert into user (role_id_id, short_name, first_name, last_name, email, token, password) VALUES (3,'nmekina','Nico','Mekina','nmekina@htl-steyr.ac.at','safhbaskdlfuiu34eds','a');
insert into user (role_id_id, short_name, first_name, last_name, email, token, password) VALUES (3,'smediko','Semirrrr','Medikovic','smediko@htl-steyr.ac.at','ahscjasdf9o78uhjs','a');

insert into school_grade (book_id_id, grade) VALUES (2,1);
insert into school_grade (book_id_id, grade) VALUES (4,4);
insert into school_grade (book_id_id, grade) VALUES (5,2);
insert into school_grade (book_id_id, grade) VALUES (3,3);
insert into school_grade (book_id_id, grade) VALUES (1,5);
