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
insert into department VALUES ('Elec Engineering', 'Ball', 222222);
insert into department VALUES ('Biology', 'Olsen', 333333);
insert into department VALUES ('Chemistry', 'Olney', 444444);
insert into department VALUES ('Physics', 'Olney', 555555);
insert into department VALUES ('Earth Sciences', 'Olney', 666666);
insert into department VALUES ('Computer Science', 'Dandeneau', 777777);
insert into department VALUES ('Math', 'Southwick', 888888);
insert into department VALUES ('Chemical Engineering', 'Southwick', 999999);
insert into department VALUES ('Mech Engineering', 'Dandeneau', 111112);
insert into department VALUES ('Biomed Engineering', 'Falmouth', 111112);
insert into department VALUES ('Plastics Engineering', 'Ball', 222221);

-- Course Data
insert into course VALUES (00000000, 'Introduction to Engineering for Civil', 'Civil Engineering', 2);
insert into course VALUES (00000001, 'Introduction to ECE', 'Elec Engineering', 2);
insert into course VALUES (00000002, 'Principles of Biology I', 'Biology', 3);
insert into course VALUES (00000003, 'Principles of Biology I Laboratory', 'Biology', 1);
insert into course VALUES (00000004, 'Chemistry I', 'Chemistry', 3);
insert into course VALUES (00000005, 'Chemistry I Lab', 'Chemistry', 1);
insert into course VALUES (00000006, 'Physics I', 'Physics', 4);
insert into course VALUES (00000007, 'Physics I Lab', 'Physics', 2);
insert into course VALUES (00000008, 'Environmental Science Seminar', 'Earth Sciences', 1);
insert into course VALUES (00000009, 'Computing I', 'Computer Science', 3);
insert into course VALUES (00000010, 'Computing I Lab', 'Computer Science', 1);
insert into course VALUES (00000011, 'Calculus I', 'Math', 4);
insert into course VALUES (00000012, 'Principles of Chemical Engineering', 'Chemical Engineering', 3);
insert into course VALUES (00000013, 'Introduction to Mech Engineering', 'Mech Engineering', 1);
insert into course VALUES (00000014, 'Biomed Engineering Application Programming', 'Biomed Engineering', 3);
insert into course VALUES (00000018, 'Principles of Biology II', 'Biology', 3);
insert into course VALUES (00000019, 'Principles of Biology II Laboratory', 'Biology', 1);
insert into course VALUES (00000020, 'Chemistry II', 'Chemistry', 3);
insert into course VALUES (00000021, 'Chemistry II Lab', 'Chemistry', 1);
insert into course VALUES (00000022, 'Physics II', 'Physics', 4);
insert into course VALUES (00000023, 'Physics II Lab', 'Physics', 2);
insert into course VALUES (00000025, 'Computing II', 'Computer Science', 3);
insert into course VALUES (00000026, 'Computing II Lab', 'Computer Science', 1);
insert into course VALUES (00000027, 'Calculus II', 'Math', 4);
insert into course VALUES (00000028, 'Calculus III', 'Math', 4);
insert into course VALUES (00000029, 'Computing III', 'Computer Science', 3);
insert into course VALUES (00000030, 'Computing III Lab', 'Computer Science', 1);

-- Instructors Data
insert into instructor VALUES (00000000, 'Shota Aizawa', 'Civil Engineering', 8900000);
insert into instructor VALUES (00000001, 'Giyu Tomioka', 'Elec Engineering', 24600000);
insert into instructor VALUES (00000002, 'Shinobu Kocho', 'Biology', 18600000);
insert into instructor VALUES (00000003, 'Toshinori Yagi', 'Chemistry', 25300000);
insert into instructor VALUES (00000004, 'Mitsuri Kanroji', 'Physics', 28900000);
insert into instructor VALUES (00000005, 'Akitaru Obi', 'Earth Sciences', 2900001);
insert into instructor VALUES (00000006, 'Satoru Gojo', 'Computer Science', 26300000);
insert into instructor VALUES (00000007, 'Levi Ackermann', 'Math', 22800000);
insert into instructor VALUES (00000008, 'Taiga Fujimura', 'Chemical Engineering', 21800000);
insert into instructor VALUES (00000009, 'Sylvia Sherwood', 'Mech Engineering', 23100000);
insert into instructor VALUES (00000010, 'Hizashi Yamada', 'Biomed Engineering', 5700000);
insert into instructor VALUES (00000011, 'Seiko Ayase', 'Plastics Engineering', 23600000);
insert into instructor VALUES (00000012, 'Utahime Iori', 'Computer Science', 24300000);

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

-- Section Data 
insert into section VALUES (00000003, 00000001, 'Spring', 2026, 'Shah', '301', '3281', 15);
insert into section VALUES (00000025, 00000002, 'Spring', 2026, 'Shah', '303', '3284', 15);
insert into section VALUES (00000008, 00000002, 'Spring', 2026, 'Shah', '305', '4363', 15);
insert into section VALUES (00000006, 00000000, 'Spring', 2026, 'Falmouth', '209', '4367', 15);
insert into section VALUES (00000004, 00000001, 'Spring', 2026, 'Falmouth', '309', '3274', 15);
insert into section VALUES (00000012, 00000000, 'Spring', 2026, 'Falmouth', '309', '4362', 15);
insert into section VALUES (00000012, 00000001, 'Spring', 2026, 'Falmouth', '311', '3273', 15);
insert into section VALUES (00000019, 00000000, 'Spring', 2026, 'Falmouth', '313', '3283', 15);
insert into section VALUES (00000010, 00000001, 'Spring', 2026, 'Olney', '218', '4365', 15);
insert into section VALUES (00000026, 00000001, 'Spring', 2026, 'Olney', '517', '3365', 15);
insert into section VALUES (00000023, 00000000, 'Spring', 2026, 'Olney', '204', '3361', 15);
insert into section VALUES (00000004, 00000002, 'Spring', 2026, 'Olney', '218', '4367', 15);
insert into section VALUES (00000018, 00000001, 'Spring', 2026, 'Olney', '204', '3366', 15);
insert into section VALUES (00000008, 00000000, 'Spring', 2026, 'Olney', '218', '4365', 15);
insert into section VALUES (00000028, 00000000, 'Spring', 2026, 'Ball', '210', '4363', 15);
insert into section VALUES (00000012, 00000002, 'Spring', 2026, 'Ball', '210', '3274', 15);
insert into section VALUES (00000018, 00000002, 'Spring', 2026, 'Ball', '314', '3273', 15);
insert into section VALUES (00000007, 00000001, 'Spring', 2026, 'Ball', '214', '3284', 15);
insert into section VALUES (00000011, 00000002, 'Spring', 2026, 'Olsen', '104', '3282', 15);
insert into section VALUES (00000023, 00000002, 'Spring', 2026, 'Olsen', '104', '3272', 15);
insert into section VALUES (00000003, 00000002, 'Spring', 2026, 'Olsen', '503', '3272', 15);
insert into section VALUES (00000008, 00000001, 'Spring', 2026, 'Olsen', '102', '3364', 15);
insert into section VALUES (00000029, 00000001, 'Spring', 2026, 'Olsen', '300', '4365', 15);
insert into section VALUES (00000010, 00000002, 'Spring', 2026, 'Olsen', '104', '3281', 15);
insert into section VALUES (00000001, 00000000, 'Spring', 2026, 'Olsen', '102', '4362', 15);
insert into section VALUES (00000002, 00000000, 'Spring', 2026, 'Olsen', '102', '4364', 15);
insert into section VALUES (00000020, 00000000, 'Spring', 2026, 'Olsen', '300', '4365', 15);
insert into section VALUES (00000002, 00000001, 'Spring', 2026, 'Olsen', '102', '3271', 15);
insert into section VALUES (00000004, 00000000, 'Spring', 2026, 'Olsen', '300', '4364', 15);
insert into section VALUES (00000000, 00000000, 'Spring', 2026, 'Shah', '301', '4361', 15);
insert into section VALUES (00000022, 00000000, 'Spring', 2026, 'Ball', '313', '4365', 15);
insert into section VALUES (00000009, 00000000, 'Spring', 2026, 'Shah', '305', '3122', 15);
insert into section VALUES (00000027, 00000000, 'Spring', 2026, 'Shah', '302', '4361', 15);
insert into section VALUES (00000013, 00000000, 'Spring', 2026, 'Olsen', '405', '3284', 15);
insert into section VALUES (00000014, 00000000, 'Spring', 2026, 'Falmouth', '309', '3273', 15);
insert into section VALUES (00000021, 00000000, 'Spring', 2026, 'Shah', '208', '3191', 15);
insert into section VALUES (00000005, 00000002, 'Spring', 2026, 'Falmouth', '313', '4363', 15);
insert into section VALUES (00000009, 00000001, 'Spring', 2026, 'Shah', '305', '3284', 15);
insert into section VALUES (00000011, 00000001, 'Spring', 2026, 'Olsen', '104', '3285', 15);

-- Teaches Data (instructor_id, course_id, section_id, 'spring', 2026)
-- Civil engineering
insert into teaches VALUES (00000000, 00000000, 00000000, 'Spring', 2026);
-- Elec Engineering
insert into teaches VALUES (00000001, 00000001, 00000000, 'Spring', 2026);
-- Biology
insert into teaches VALUES (00000002, 00000002, 00000000, 'Spring', 2026);
insert into teaches VALUES (00000002, 00000003, 00000001, 'Spring', 2026);
insert into teaches VALUES (00000002, 00000018, 00000001, 'Spring', 2026);
insert into teaches VALUES (00000002, 00000019, 00000000, 'Spring', 2026);
-- Physics
insert into teaches VALUES (00000004, 00000006, 00000000, 'Spring', 2026);
insert into teaches VALUES (00000004, 00000007, 00000001, 'Spring', 2026);
insert into teaches VALUES (00000004, 00000022, 00000000, 'Spring', 2026);
insert into teaches VALUES (00000004, 00000023, 00000000, 'Spring', 2026);
-- Earth Sciences
insert into teaches VALUES (00000005, 00000008, 00000000, 'Spring', 2026);
insert into teaches VALUES (00000005, 00000008, 00000001, 'Spring', 2026);
-- Computer Science
insert into teaches VALUES (00000006, 00000009, 00000000, 'Spring', 2026);
insert into teaches VALUES (00000006, 00000009, 00000001, 'Spring', 2026);
insert into teaches VALUES (00000006, 00000010, 00000001, 'Spring', 2026);
insert into teaches VALUES (00000006, 00000010, 00000002, 'Spring', 2026);
insert into teaches VALUES (00000006, 00000025, 00000002, 'Spring', 2026);
insert into teaches VALUES (00000006, 00000026, 00000001, 'Spring', 2026);
insert into teaches VALUES (00000006, 00000029, 00000001, 'Spring', 2026);
-- Math
insert into teaches VALUES (00000007, 00000011, 00000001, 'Spring', 2026);
insert into teaches VALUES (00000007, 00000011, 00000002, 'Spring', 2026);
insert into teaches VALUES (00000007, 00000027, 00000000, 'Spring', 2026);
insert into teaches VALUES (00000007, 00000028, 00000000, 'Spring', 2026);
-- Chemical Engineering
insert into teaches VALUES (00000008, 00000012, 00000000, 'Spring', 2026);
insert into teaches VALUES (00000008, 00000012, 00000001, 'Spring', 2026);
insert into teaches VALUES (00000008, 00000012, 00000002, 'Spring', 2026);
-- Mech Engineering
insert into teaches VALUES (00000009, 00000013, 00000000, 'Spring', 2026);
-- Biomed Engineering
insert into teaches VALUES (00000010, 00000014, 00000000, 'Spring', 2026);
-- Chemistry
insert into teaches VALUES (00000003, 00000004, 00000001, 'Spring', 2026);
insert into teaches VALUES (00000003, 00000004, 00000000, 'Spring', 2026);
insert into teaches VALUES (00000003, 00000020, 00000000, 'Spring', 2026);
insert into teaches VALUES (00000003, 00000021, 00000000, 'Spring', 2026);

-- Students Data
insert into student VALUES (00000000, 'Izuku Midoriya', 'Civil Engineering', 0);
insert into student VALUES (00000001, 'Tanjiro Kamado', 'Elec Engineering', 14);
insert into student VALUES (00000002, 'Subaru Natsuki', 'Biology', 119);
insert into student VALUES (00000003, 'Naofumi Iwatani', 'Chemistry', 22);
insert into student VALUES (00000004, 'Kazuma Satou', 'Physics', 28);
insert into student VALUES (00000005, 'Shinra Kusakabe', 'Earth Sciences', 60);
insert into student VALUES (00000006, 'Yuji Itadori', 'Computer Science', 15);
insert into student VALUES (00000007, 'Eren Jaeger', 'Math', 29);
insert into student VALUES (00000008, 'Shirou Emiya', 'Chemical Engineering', 45);
insert into student VALUES (00000009, 'Loid Forger', 'Mech Engineering', 24);
insert into student VALUES (00000010, 'Kazuto Kirigaya', 'Biomed Engineering', 30);
insert into student VALUES (00000011, 'Ken Takakura', 'Plastics Engineering', 106);
insert into student VALUES (00000012, 'Mirio Togata', 'Civil Engineering', 26);
insert into student VALUES (00000013, 'Obanai Iguro', 'Elec Engineering', 0);
insert into student VALUES (00000014, 'Otto Suwen', 'Biology', 28);
insert into student VALUES (00000015, 'Lalatina Dustiness', 'Physics', 7);
insert into student VALUES (00000016, 'Yuta Okkotsu', 'Computer Science', 29);
insert into student VALUES (00000017, 'Pieck Finger', 'Math', 18);
insert into student VALUES (00000018, 'Artoria Pendragon', 'Chemical Engineering', 9);
insert into student VALUES (00000019, 'Yuri Briar', 'Mech Engineering', 11);
insert into student VALUES (00000020, 'Maki Oze', 'Plastics Engineering', 27);
insert into student VALUES (00000021, 'Keigo Takami', 'Civil Engineering', 29);
insert into student VALUES (00000022, 'Tengen Uzui', 'Elec Engineering', 41);
insert into student VALUES (00000023, 'Crusch Karsten', 'Biology', 23);
insert into student VALUES (00000024, 'Motoyasu Kitamura', 'Chemistry', 4);
insert into student VALUES (00000025, 'Aoi Todo', 'Computer Science', 26);
insert into student VALUES (00000026, 'Armin Arlelt', 'Math', 0);
insert into student VALUES (00000027, 'Illyasviel Einzbern', 'Chemical Engineering', 32);
insert into student VALUES (00000028, 'Viktor Licht', 'Biomed Engineering', 5);
insert into student VALUES (00000029, 'Cid Kagenou', 'Plastics Engineering', 13);
insert into student VALUES (00000030, 'Shido Itsuka', 'Computer Science', 17);
insert into student VALUES (00000031, 'Megumi Fushiguro', 'Computer Science', 34);
insert into student VALUES (00000032, 'Nobara Kugisaki', 'Computer Science', 12);
insert into student VALUES (00000033, 'Arata Nitta', 'Computer Science', 0);
insert into student VALUES (00000034, 'Maki Zenin', 'Computer Science', 106);
insert into student VALUES (00000035, 'Toge Inumaki', 'Computer Science', 54);
insert into student VALUES (00000036, 'Mai Zenin', 'Computer Science', 70);
insert into student VALUES (00000037, 'Kokichi Muta', 'Computer Science', 88);
insert into student VALUES (00000038, 'Kasumi Miwa', 'Computer Science', 17);
insert into student VALUES (00000039, 'Kinji Hakari', 'Computer Science', 95);
insert into student VALUES (00000040, 'Kirara Hoshi', 'Computer Science', 96);
insert into student VALUES (00000041, 'Noritoshi Kamo', 'Computer Science', 7);
insert into student VALUES (00000042, 'Mikasa Ackermann', 'Math', 30);
insert into student VALUES (00000043, 'Reiner Braun', 'Math', 35);
insert into student VALUES (00000044, 'Annie Leonhart', 'Math', 15);
insert into student VALUES (00000045, 'Jean Kirschtein', 'Math', 100);
insert into student VALUES (00000046, 'Hitch Dreyse', 'Math', 84);
insert into student VALUES (00000047, 'Historia Reiss', 'Math', 106);

-- Takes Data
insert into takes VALUES (00000000, 00000000, 00000000, 'Spring', 2026, 'B-');
insert into takes VALUES (00000001, 00000001, 00000000, 'Spring', 2026, 'C-');
insert into takes VALUES (00000002, 00000002, 00000001, 'Spring', 2026, 'D');
insert into takes VALUES (00000002, 00000003, 00000001, 'Spring', 2026, 'A');
insert into takes VALUES (00000002, 00000018, 00000002, 'Spring', 2026, 'B-');
insert into takes VALUES (00000002, 00000019, 00000000, 'Spring', 2026, 'A-');
insert into takes VALUES (00000004, 00000006, 00000000, 'Spring', 2026, 'C-');
insert into takes VALUES (00000004, 00000007, 00000001, 'Spring', 2026, 'C-');
insert into takes VALUES (00000005, 00000008, 00000000, 'Spring', 2026, 'D');
insert into takes VALUES (00000006, 00000009, 00000000, 'Spring', 2026, 'C-');
insert into takes VALUES (00000006, 00000010, 00000001, 'Spring', 2026, 'C');
insert into takes VALUES (00000007, 00000011, 00000002, 'Spring', 2026, 'A');
insert into takes VALUES (00000008, 00000012, 00000002, 'Spring', 2026, 'B+');
insert into takes VALUES (00000010, 00000014, 00000000, 'Spring', 2026, 'D+');
insert into takes VALUES (00000011, 00000004, 00000001, 'Spring', 2026, 'B-');
insert into takes VALUES (00000011, 00000005, 00000002, 'Spring', 2026, 'C');
insert into takes VALUES (00000017, 00000011, 00000002, 'Spring', 2026, 'A');
insert into takes VALUES (00000031, 00000009, 00000001, 'Spring', 2026, 'A-');
insert into takes VALUES (00000032, 00000009, 00000001, 'Spring', 2026, 'F');
insert into takes VALUES (00000033, 00000009, 00000001, 'Spring', 2026, 'D+');
insert into takes VALUES (00000034, 00000009, 00000001, 'Spring', 2026, 'C+');
insert into takes VALUES (00000035, 00000009, 00000001, 'Spring', 2026, 'D');
insert into takes VALUES (00000036, 00000009, 00000001, 'Spring', 2026, 'B');
insert into takes VALUES (00000037, 00000009, 00000001, 'Spring', 2026, 'B+');
insert into takes VALUES (00000038, 00000009, 00000001, 'Spring', 2026, 'A');
insert into takes VALUES (00000039, 00000009, 00000001, 'Spring', 2026, 'F');
insert into takes VALUES (00000040, 00000009, 00000001, 'Spring', 2026, 'B');
insert into takes VALUES (00000041, 00000009, 00000001, 'Spring', 2026, 'B-');
insert into takes VALUES (00000042, 00000011, 00000002, 'Spring', 2026, 'A');
insert into takes VALUES (00000043, 00000011, 00000001, 'Spring', 2026, 'F');
insert into takes VALUES (00000044, 00000011, 00000001, 'Spring', 2026, 'F');
insert into takes VALUES (00000045, 00000011, 00000001, 'Spring', 2026, 'A');
insert into takes VALUES (00000046, 00000011, 00000001, 'Spring', 2026, 'C');
insert into takes VALUES (00000047, 00000011, 00000001, 'Spring', 2026, 'B');

-- Advising Data
insert into advising VALUES (00000000, 00000000);
insert into advising VALUES (00000012, 00000000);
insert into advising VALUES (00000021, 00000000);
insert into advising VALUES (00000001, 00000001);
insert into advising VALUES (00000013, 00000001);
insert into advising VALUES (00000022, 00000001);
insert into advising VALUES (00000002, 00000002);
insert into advising VALUES (00000014, 00000002);
insert into advising VALUES (00000023, 00000002);
insert into advising VALUES (00000003, 00000003);
insert into advising VALUES (00000024, 00000003);
insert into advising VALUES (00000004, 00000004);
insert into advising VALUES (00000015, 00000004);
insert into advising VALUES (00000005, 00000005);
insert into advising VALUES (00000006, 00000006);
insert into advising VALUES (00000016, 00000006);
insert into advising VALUES (00000025, 00000006);
insert into advising VALUES (00000007, 00000007);
insert into advising VALUES (00000017, 00000007);
insert into advising VALUES (00000026, 00000007);
insert into advising VALUES (00000008, 00000008);
insert into advising VALUES (00000018, 00000008);
insert into advising VALUES (00000027, 00000008);
insert into advising VALUES (00000009, 00000009);
insert into advising VALUES (00000019, 00000009);
insert into advising VALUES (00000010, 00000010);
insert into advising VALUES (00000028, 00000010);
insert into advising VALUES (00000011, 00000011);
insert into advising VALUES (00000020, 00000011);
insert into advising VALUES (00000029, 00000011);
insert into advising VALUES (00000030, 00000006);
insert into advising VALUES (00000031, 00000006);
insert into advising VALUES (00000032, 00000006);
insert into advising VALUES (00000033, 00000006);
insert into advising VALUES (00000034, 00000006);
insert into advising VALUES (00000035, 00000006);
insert into advising VALUES (00000036, 00000006);
insert into advising VALUES (00000037, 00000006);
insert into advising VALUES (00000038, 00000006);
insert into advising VALUES (00000039, 00000006);
insert into advising VALUES (00000040, 00000006);
insert into advising VALUES (00000041, 00000006);
insert into advising VALUES (00000042, 00000007);
insert into advising VALUES (00000043, 00000007);
insert into advising VALUES (00000044, 00000007);
insert into advising VALUES (00000045, 00000007);
insert into advising VALUES (00000046, 00000007);
insert into advising VALUES (00000047, 00000007);

-- Prereq Data
insert into prereq VALUES (00000028, 00000027);
insert into prereq VALUES (00000027, 00000011);
insert into prereq VALUES (00000026, 00000010);
insert into prereq VALUES (00000025, 00000009);
insert into prereq VALUES (00000023, 00000007);
insert into prereq VALUES (00000022, 00000006);
insert into prereq VALUES (00000021, 00000005);
insert into prereq VALUES (00000020, 00000004);
insert into prereq VALUES (00000019, 00000003);
insert into prereq VALUES (00000018, 00000002);
insert into prereq VALUES (00000029, 00000025);
insert into prereq VALUES (00000030, 00000026);

-- teacher_assistant data (student_id(phd only), course_id, section_id, semester, year),
insert into teacher_assistant VALUES (00000009, 00000013, 00000000, 'Spring', 2026);
insert into teacher_assistant VALUES (00000021, 00000000, 00000000, 'Spring', 2026);
insert into teacher_assistant VALUES (00000022, 00000001, 00000000, 'Spring', 2026);
insert into teacher_assistant VALUES (00000023, 00000002, 00000000, 'Spring', 2026);
insert into teacher_assistant VALUES (00000024, 00000004, 00000000, 'Spring', 2026);
insert into teacher_assistant VALUES (00000025, 00000009, 00000000, 'Spring', 2026);
insert into teacher_assistant VALUES (00000026, 00000011, 00000002, 'Spring', 2026);
insert into teacher_assistant VALUES (00000027, 00000012, 00000000, 'Spring', 2026);
insert into teacher_assistant VALUES (00000028, 00000014, 00000000, 'Spring', 2026);
insert into teacher_assistant VALUES (00000029, 00000005, 00000002, 'Spring', 2026);

-- grader data (undergraduate and master students only)
-- Undergraduate
insert into grader VALUES (00000000, 00000000, 00000000, 'Spring', 2026);
insert into grader VALUES (00000001, 00000001, 00000000, 'Spring', 2026);
insert into grader VALUES (00000002, 00000018, 00000001, 'Spring', 2026);
insert into grader VALUES (00000004, 00000004, 00000001, 'Spring', 2026);
insert into grader VALUES (00000005, 00000006, 00000000, 'Spring', 2026);
insert into grader VALUES (00000006, 00000009, 00000000, 'Spring', 2026);
insert into grader VALUES (00000007, 00000027, 00000000, 'Spring', 2026);
insert into grader VALUES (00000008, 00000012, 00000001, 'Spring', 2026);
insert into grader VALUES (00000010, 00000014, 00000000, 'Spring', 2026);
insert into grader VALUES (00000011, 00000028, 00000000, 'Spring', 2026);
-- Masters
insert into grader VALUES (00000012, 00000002, 00000000, 'Spring', 2026);
insert into grader VALUES (00000013, 00000003, 00000001, 'Spring', 2026);
insert into grader VALUES (00000014, 00000019, 00000000, 'Spring', 2026);
insert into grader VALUES (00000015, 00000005, 00000002, 'Spring', 2026);
insert into grader VALUES (00000016, 00000007, 00000001, 'Spring', 2026);
insert into grader VALUES (00000017, 00000011, 00000002, 'Spring', 2026);
insert into grader VALUES (00000018, 00000012, 00000000, 'Spring', 2026);
insert into grader VALUES (00000019, 00000012, 00000002, 'Spring', 2026);
insert into grader VALUES (00000020, 00000013, 00000000, 'Spring', 2026);

-- Undergraduate Students Data
insert into undergraduate VALUES (00000000, 1, 'Civil Engineering');
insert into undergraduate VALUES (00000001, 1, 'Elec Engineering');
insert into undergraduate VALUES (00000002, 4, 'Biology');
insert into undergraduate VALUES (00000004, 2, 'Physics');
insert into undergraduate VALUES (00000005, 3, 'Earth Sciences');
insert into undergraduate VALUES (00000006, 1, 'Computer Science');
insert into undergraduate VALUES (00000007, 2, 'Math');
insert into undergraduate VALUES (00000008, 2, 'Chemical Engineering');
insert into undergraduate VALUES (00000010, 2, 'Biomed Engineering');
insert into undergraduate VALUES (00000011, 4, 'Plastics Engineering');
insert into undergraduate VALUES (00000031, 2, 'Computer Science');
insert into undergraduate VALUES (00000032, 1, 'Computer Science');
insert into undergraduate VALUES (00000033, 1, 'Computer Science');
insert into undergraduate VALUES (00000034, 4, 'Computer Science');
insert into undergraduate VALUES (00000035, 2, 'Computer Science');
insert into undergraduate VALUES (00000036, 3, 'Computer Science');
insert into undergraduate VALUES (00000037, 4, 'Computer Science');
insert into undergraduate VALUES (00000038, 1, 'Computer Science');
insert into undergraduate VALUES (00000039, 4, 'Computer Science');
insert into undergraduate VALUES (00000040, 4, 'Computer Science');
insert into undergraduate VALUES (00000041, 1, 'Computer Science');
insert into undergraduate VALUES (00000042, 2, 'Math');
insert into undergraduate VALUES (00000043, 2, 'Math');
insert into undergraduate VALUES (00000044, 1, 'Math');
insert into undergraduate VALUES (00000045, 4, 'Math');
insert into undergraduate VALUES (00000046, 3, 'Math');
insert into undergraduate VALUES (00000047, 4, 'Math');

-- Master Students Data
insert into master VALUES (00000003);
insert into master VALUES (00000012);
insert into master VALUES (00000013);
insert into master VALUES (00000014);
insert into master VALUES (00000015);
insert into master VALUES (00000016);
insert into master VALUES (00000017);
insert into master VALUES (00000018);
insert into master VALUES (00000019);
insert into master VALUES (00000020);

-- PhD Students Data
insert into phd VALUES (00000009, 'Adaptive Micro-Actuation Systems for Precision Robotic Manipulation in Unstructured Environments.', TRUE);
insert into phd VALUES (00000021, 'Aerodynamic Optimization of High-Rise Structures for Extreme Wind Environments.', TRUE);
insert into phd VALUES (00000022, 'Advanced Acoustic Signal Processing for High-Precision Environmental Detection Systems.', FALSE);
insert into phd VALUES (00000023, 'Adaptive Ecosystem Dynamics in Temperate Forest Biomes under Environmental Stress.', FALSE);
insert into phd VALUES (00000024, 'Synthesis and Structural Characterization of High-Strength Transition Metal Alloys for Reactive Applications.', FALSE);
insert into phd VALUES (00000025, 'Adaptive Deep Learning Architectures for Real-Time Strategic Decision Making in Dynamic Environments.', FALSE);
insert into phd VALUES (00000026, 'Game-Theoretic Modeling of Strategic Decision-Making in Multi-Agent Conflict Systems.', FALSE);
insert into phd VALUES (00000027, 'Design and Synthesis of Multi-Functional Polymer Matrices for Adaptive Chemical Systems.', FALSE);
insert into phd VALUES (00000028, 'Electrophysiological Modeling of High-Energy Bioelectrical Phenomena in Human Tissue.', FALSE);
insert into phd VALUES (00000029, 'Synthesis and Mechanical Characterization of High-Performance Thermoplastic Polymer Composites.', FALSE);
insert into phd VALUES (00000030, 'Emotional State Classification in Human-Spirit Interaction: A Machine Learning Approach to Affective Computing.', FALSE);

-- Discussion Data
insert into discussion VALUES (00000001, 00000001, 00000000, 'Spring', 2026, 'Why does electricity flow with such gentle but relentless determination?');
insert into discussion VALUES (00000002, 00000002, 00000001, 'Spring', 2026, 'I already understood cell death on a deeply personal level, but I am confused on the other material.');
insert into discussion VALUES (00000002, 00000003, 00000001, 'Spring', 2026, 'I will just start over from the beginning after knocking some things over.');
insert into discussion VALUES (00000002, 00000018, 00000002, 'Spring', 2026, 'Do organisms that die repeatedly in the same environment ever develop any kind of meaningful adaptation?');
insert into discussion VALUES (00000002, 00000019, 00000000, 'Spring', 2026, 'Was returning to a previous checkpoint an accepted scientific methodology?');
insert into discussion VALUES (00000004, 00000006, 00000000, 'Spring', 2026, 'Which elective stat I could dump to boost my grade?');
insert into discussion VALUES (00000004, 00000007, 00000001, 'Spring', 2026, 'Why is the experiment so tedious?');
insert into discussion VALUES (00000005, 00000008, 00000000, 'Spring', 2026, 'I had firsthand experience with combustion dynamics that no peer-reviewed study could adequately replicate.');
insert into discussion VALUES (00000007, 00000011, 00000002, 'Spring', 2026, 'I would master derivatives no matter the cost and that freedom from failing this course was something I would secure for myself with my own two hands, even if it took every hour of the weekend.');
insert into discussion VALUES (00000008, 00000012, 00000002, 'Spring', 2026, 'Was mastering the math itself a form of justice?');


-- course evalution 
insert into course_evaluation VALUES (00000000, 00000003, 00000001, 'Spring', 2026, 5, 'Great intro course. Lab work was very practical.');
insert into course_evaluation VALUES (00000001, 00000025, 00000002, 'Spring', 2026, 4, 'Coding projects were challenging but rewarding.');
insert into course_evaluation VALUES (00000002, 00000008, 00000002, 'Spring', 2026, 3, 'Interesting lectures but the textbook is mandatory.');
insert into course_evaluation VALUES (00000003, 00000006, 00000000, 'Spring', 2026, 5, 'Excellent demonstrations and clear explanations.');
insert into course_evaluation VALUES (00000004, 00000004, 00000001, 'Spring', 2026, 2, 'Lectures were a bit hard to follow at times.');
insert into course_evaluation VALUES (00000005, 00000012, 00000000, 'Spring', 2026, 4, 'Well organized course with helpful weekly summaries.');
insert into course_evaluation VALUES (00000006, 00000012, 00000001, 'Spring', 2026, 4, 'Section 1 was very interactive. Good group projects.');
insert into course_evaluation VALUES (00000007, 00000019, 00000000, 'Spring', 2026, 1, 'Material was much harder than the prerequisite suggested.');
insert into course_evaluation VALUES (00000008, 00000010, 00000001, 'Spring', 2026, 5, 'Highly recommended for anyone in the department.');
insert into course_evaluation VALUES (00000009, 00000026, 00000001, 'Spring', 2026, 3, 'A standard course. The workload is manageable.');
insert into course_evaluation VALUES (00000010, 00000023, 00000000, 'Spring', 2026, 4, 'Very detailed syllabus and fair exam questions.');
insert into course_evaluation VALUES (00000011, 00000004, 00000002, 'Spring', 2026, 2, 'The midterm exam was significantly harder than the homework.');
insert into course_evaluation VALUES (00000012, 00000018, 00000001, 'Spring', 2026, 5, 'One of the best professors I have had so far.');
insert into course_evaluation VALUES (00000013, 00000008, 00000000, 'Spring', 2026, 3, 'Decent course content, but the lab equipment is old.');
insert into course_evaluation VALUES (00000014, 00000028, 00000000, 'Spring', 2026, 5, 'Foundational knowledge that is essential for my major.');
insert into course_evaluation VALUES (00000015, 00000012, 00000002, 'Spring', 2026, 4, 'The practical examples really helped bridge the theory.');
insert into course_evaluation VALUES (00000016, 00000018, 00000002, 'Spring', 2026, 3, 'Very fast-paced. Hard to keep up if you miss one class.');
insert into course_evaluation VALUES (00000017, 00000007, 00000001, 'Spring', 2026, 5, 'The best lab experience of my undergraduate career.');
insert into course_evaluation VALUES (00000018, 00000011, 00000002, 'Spring', 2026, 4, 'Complex topics made simple through great visualization.');
insert into course_evaluation VALUES (00000019, 00000023, 00000002, 'Spring', 2026, 2, 'Way too much homework for a 3-credit course.');
insert into course_evaluation VALUES (00000020, 00000003, 00000002, 'Spring', 2026, 5, 'The teaching style is very engaging and inclusive.');
insert into course_evaluation VALUES (00000021, 00000008, 00000001, 'Spring', 2026, 4, 'Learned a lot of practical skills for my future career.');
insert into course_evaluation VALUES (00000022, 00000029, 00000001, 'Spring', 2026, 3, 'The material was okay, but the classroom was too small.');
insert into course_evaluation VALUES (00000023, 00000010, 00000002, 'Spring', 2026, 5, 'Fantastic online resources provided by the department.');
insert into course_evaluation VALUES (00000024, 00000001, 00000000, 'Spring', 2026, 4, 'A solid introduction to the field of study.');
insert into course_evaluation VALUES (00000025, 00000002, 00000000, 'Spring', 2026, 1, 'Difficulty reaching the professor during office hours.');
insert into course_evaluation VALUES (00000026, 00000020, 00000000, 'Spring', 2026, 5, 'Absolutely fascinating topic. I wish there was a part 2.');
insert into course_evaluation VALUES (00000027, 00000002, 00000001, 'Spring', 2026, 4, 'Well-structured labs that mirrored the lecture content.');
insert into course_evaluation VALUES (00000028, 00000004, 00000000, 'Spring', 2026, 3, 'A standard chemistry class with no major surprises.');
insert into course_evaluation VALUES (00000029, 00000011, 00000002, 'Spring', 2026, 5, 'Highly effective teaching methods. Really enjoyed it.');
