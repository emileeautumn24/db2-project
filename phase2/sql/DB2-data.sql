-- Classroom Data
insert into classroom VALUES ('Ball', '206', 36);
insert into classroom VALUES ('Ball', '208', 48);
insert into classroom VALUES ('Ball', '210', 168);
insert into classroom VALUES ('Ball', '214', 140);
insert into classroom VALUES ('Ball', '302', 24);
insert into classroom VALUES ('Ball', '313', 20);
insert into classroom VALUES ('Ball', '314', 70);
insert into classroom VALUES ('Ball', '323', 12);
insert into classroom VALUES ('Ball', '326', 44);
insert into classroom VALUES ('Ball', '328', 46);
insert into classroom VALUES ('Falmouth', '209', 56);
insert into classroom VALUES ('Falmouth', '309', 52);
insert into classroom VALUES ('Falmouth', '311', 44);
insert into classroom VALUES ('Falmouth', '313', 52);
insert into classroom VALUES ('Olney', '115', 41);
insert into classroom VALUES ('Olney', '204', 60);
insert into classroom VALUES ('Olney', '218', 60);
insert into classroom VALUES ('Olney', '517', 60);
insert into classroom VALUES ('Olney', '519', 41);
insert into classroom VALUES ('Olsen', '102', 88);
insert into classroom VALUES ('Olsen', '103', 24);
insert into classroom VALUES ('Olsen', '104', 60);
insert into classroom VALUES ('Olsen', '106', 24);
insert into classroom VALUES ('Olsen', '109', 65);
insert into classroom VALUES ('Olsen', '114', 44);
insert into classroom VALUES ('Olsen', '300', 100);
insert into classroom VALUES ('Olsen', '313', 19);
insert into classroom VALUES ('Olsen', '322', 34);
insert into classroom VALUES ('Olsen', '330', 64);
insert into classroom VALUES ('Olsen', '335', 19);
insert into classroom VALUES ('Olsen', '340', 38);
insert into classroom VALUES ('Olsen', '341', 38);
insert into classroom VALUES ('Olsen', '348', 60);
insert into classroom VALUES ('Olsen', '349', 19);
insert into classroom VALUES ('Olsen', '353', 19);
insert into classroom VALUES ('Olsen', '401', 42);
insert into classroom VALUES ('Olsen', '403', 28);
insert into classroom VALUES ('Olsen', '405', 49);
insert into classroom VALUES ('Olsen', '407', 50);
insert into classroom VALUES ('Olsen', '408', 55);
insert into classroom VALUES ('Olsen', '410', 40);
insert into classroom VALUES ('Olsen', '412', 44);
insert into classroom VALUES ('Olsen', '503', 103);
insert into classroom VALUES ('Shah', '208', 20);
insert into classroom VALUES ('Shah', '301', 50);
insert into classroom VALUES ('Shah', '302', 40);
insert into classroom VALUES ('Shah', '303', 50);
insert into classroom VALUES ('Shah', '304', 24);
insert into classroom VALUES ('Shah', '305', 70);
insert into classroom VALUES ('Shah', '306', 40);
insert into classroom VALUES ('Shah', '308', 24);
insert into classroom VALUES ('Shah', '310', 52);

-- Department Data
insert into department VALUES ('Civil Engineering', 'Shah', 111111);
insert into department VALUES ('Electrical Engineering', 'Ball', 222222);
insert into department VALUES ('Biology', 'Olsen', 333333);
insert into department VALUES ('Chemistry', 'Olney', 444444);
insert into department VALUES ('Physics', 'Olney', 555555);
insert into department VALUES ('Earth Sciences', 'Olney', 666666);
insert into department VALUES ('Computer Science', 'Dandeneau', 777777);
insert into department VALUES ('Math', 'Southwick', 888888);
insert into department VALUES ('Chemical Engineering', 'Southwick', 999999);
insert into department VALUES ('Mechanical Engineering', 'Dandeneau', 111112);
insert into department VALUES ('Biomedical Engineering', 'Falmouth', 111112);
insert into department VALUES ('Plastics Engineering', 'Ball', 222221);

-- Timeslot Data
-- first digit: Credits
-- second digit: Frequency
-- third dight: day code
-- fourth digit: count
-- day codes: 1 = M; 2 = T; 3 = W; 4 = R; 5 = F, 9 =
-- 6 = MWF, 7 = MW, 8 = TR
insert into time_slot VALUES ('3111', '1', 15, 30, 18, 20);
insert into time_slot VALUES ('3112', '1', 18, 30, 21, 20);
insert into time_slot VALUES ('3121', '2', 15, 30, 18, 20);
insert into time_slot VALUES ('3122', '2', 18, 30, 21, 20);
insert into time_slot VALUES ('3131', '3', 15, 30, 18, 20);
insert into time_slot VALUES ('3132', '3', 18, 30, 21, 20);
insert into time_slot VALUES ('3141', '4', 15, 30, 18, 20);
insert into time_slot VALUES ('3142', '4', 18, 30, 21, 20);
insert into time_slot VALUES ('3191', '9', 08, 00, 10, 50);
insert into time_slot VALUES ('3192', '9', 11, 00, 13, 50);
insert into time_slot VALUES ('3193', '9', 14, 00, 16, 50);
insert into time_slot VALUES ('3271', '7', 14, 00, 15, 15);
insert into time_slot VALUES ('3272', '7', 15, 30, 16, 45);
insert into time_slot VALUES ('3273', '7', 17, 00, 18, 15);
insert into time_slot VALUES ('3274', '7', 18, 30, 19, 45);
insert into time_slot VALUES ('3281', '8', 08, 00, 09, 15);
insert into time_slot VALUES ('3282', '8', 09, 30, 10, 45);
insert into time_slot VALUES ('3283', '8', 11, 00, 12, 15);
insert into time_slot VALUES ('3284', '8', 12, 30, 13, 45);
insert into time_slot VALUES ('3285', '8', 14, 00, 15, 15);
insert into time_slot VALUES ('3286', '8', 15, 30, 16, 45);
insert into time_slot VALUES ('3287', '8', 17, 00, 18, 15);
insert into time_slot VALUES ('3288', '8', 18, 30, 19, 45);
insert into time_slot VALUES ('3361', '6', 08, 00, 08, 50);
insert into time_slot VALUES ('3362', '6', 09, 00, 09, 50);
insert into time_slot VALUES ('3363', '6', 10, 00, 10, 50);
insert into time_slot VALUES ('3364', '6', 11, 00, 11, 50);
insert into time_slot VALUES ('3365', '6', 12, 00, 12, 50);
insert into time_slot VALUES ('3366', '6', 13, 00, 13, 50);
insert into time_slot VALUES ('4361', '6', 08, 00, 09, 15);
insert into time_slot VALUES ('4362', '6', 09, 30, 10, 45);
insert into time_slot VALUES ('4363', '6', 11, 00, 12, 15);
insert into time_slot VALUES ('4364', '6', 12, 30, 13, 45);
insert into time_slot VALUES ('4365', '6', 14, 00, 15, 15);
insert into time_slot VALUES ('4366', '6', 15, 30, 16, 45);
insert into time_slot VALUES ('4367', '6', 17, 00, 18, 15);
insert into time_slot VALUES ('4368', '6', 18, 30, 19, 45);
