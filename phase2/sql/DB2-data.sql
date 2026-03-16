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

-- Students Data
insert into student VALUES (00000000, 'Izuku Midoriya', 'Civil Engineering', 0);
insert into student VALUES (00000001, 'Tanjiro Kamado', 'Electrical Engineering', 14);
insert into student VALUES (00000002, 'Subaru Natsuki', 'Biology', 119);
insert into student VALUES (00000003, 'Naofumi Iwatani', 'Chemistry', 22);
insert into student VALUES (00000004, 'Kazuma Satou', 'Physics', 28);
insert into student VALUES (00000005, 'Shinra Kusakabe', 'Earth Sciences', 60);
insert into student VALUES (00000006, 'Yuji Itadori', 'Computer Science', 15);
insert into student VALUES (00000007, 'Eren Jaeger', 'Math', 29);
insert into student VALUES (00000008, 'Shirou Emiya', 'Chemical Engineering', 45);
insert into student VALUES (00000009, 'Loid Forger', 'Mechanical Engineering', 24);
insert into student VALUES (00000010, 'Kazuto Kirigaya', 'Biomedical Engineering', 30);
insert into student VALUES (00000011, 'Ken Takakura', 'Plastics Engineering', 106);
insert into student VALUES (00000012, 'Mirio Togata', 'Civil Engineering', 26);
insert into student VALUES (00000013, 'Obanai Iguro', 'Electrical Engineering', 0);
insert into student VALUES (00000014, 'Otto Suwen', 'Biology', 28);
insert into student VALUES (00000015, 'Lalatina Dustiness', 'Physics', 7);
insert into student VALUES (00000016, 'Yuta Okkotsu', 'Computer Science', 29);
insert into student VALUES (00000017, 'Pieck Finger', 'Math', 18);
insert into student VALUES (00000018, 'Artoria Pendragon', 'Chemical Engineering', 9);
insert into student VALUES (00000019, 'Yuri Briar', 'Mechanical Engineering', 11);
insert into student VALUES (00000020, 'Maki Oze', 'Plastics Engineering', 27);
insert into student VALUES (00000021, 'Keigo Takami', 'Civil Engineering', 29);
insert into student VALUES (00000022, 'Tengen Uzui', 'Electrical Engineering', 41);
insert into student VALUES (00000023, 'Crusch Karsten', 'Biology', 23);
insert into student VALUES (00000024, 'Motoyasu Kitamura', 'Chemistry', 4);
insert into student VALUES (00000025, 'Aoi Todo', 'Computer Science', 26);
insert into student VALUES (00000026, 'Armin Arlelt', 'Math', 0);
insert into student VALUES (00000027, 'Illyasviel Einzbern', 'Chemical Engineering', 32);
insert into student VALUES (00000028, 'Viktor Licht', 'Biomedical Engineering', 5);
insert into student VALUES (00000029, 'Cid Kagenou', 'Plastics Engineering', 13);

-- Instructors Data
insert into instructor VALUES (00000000, 'Shota Aizawa', 'Civil Engineering', 8900000);
insert into instructor VALUES (00000001, 'Giyu Tomioka', 'Electrical Engineering', 24600000);
insert into instructor VALUES (00000002, 'Shinobu Kocho', 'Biology', 18600000);
insert into instructor VALUES (00000003, 'Toshinori Yagi', 'Chemistry', 25300000);
insert into instructor VALUES (00000004, 'Mitsuri Kanroji', 'Physics', 28900000);
insert into instructor VALUES (00000005, 'Akitaru Obi', 'Earth Sciences', 2900000);
insert into instructor VALUES (00000006, 'Satoru Gojo', 'Computer Science', 26300000);
insert into instructor VALUES (00000007, 'Levi Ackermann', 'Math', 22800000);
insert into instructor VALUES (00000008, 'Taiga Fujimura', 'Chemical Engineering', 21800000);
insert into instructor VALUES (00000009, 'Sylvia Sherwood', 'Mechanical Engineering', 23100000);
insert into instructor VALUES (00000010, 'Hizashi Yamada', 'Biomedical Engineering', 5700000);
insert into instructor VALUES (00000011, 'Seiko Ayase', 'Plastics Engineering', 23600000);

-- Undergraduate Students Data
insert into undergraduate VALUES (00000000, 1, 'Civil Engineering');
insert into undergraduate VALUES (00000001, 1, 'Electrical Engineering');
insert into undergraduate VALUES (00000002, 4, 'Biology');
insert into undergraduate VALUES (00000004, 2, 'Physics');
insert into undergraduate VALUES (00000005, 3, 'Earth Sciences');
insert into undergraduate VALUES (00000006, 1, 'Computer Science');
insert into undergraduate VALUES (00000007, 2, 'Math');
insert into undergraduate VALUES (00000008, 2, 'Chemical Engineering');
insert into undergraduate VALUES (00000010, 2, 'Biomedical Engineering');
insert into undergraduate VALUES (00000011, 4, 'Plastics Engineering');

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

-- Course Data
insert into course VALUES (00000000, 'Introduction to Engineering for Civil', 'Civil Engineering', 2);
insert into course VALUES (00000001, 'Introduction to ECE', 'Electrical Engineering', 2);
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
insert into course VALUES (00000013, 'Introduction to Mechanical Engineering', 'Mechanical Engineering', 1);
insert into course VALUES (00000014, 'Biomedical Engineering Application Programming', 'Biomedical Engineering', 3);
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

-- Advising Table
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

-- Section Data
insert into section VALUES (00000011, 00000000, 'Spring', 2026, 'Olney', '519', 4363, 40);
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

-- Students Data
insert into student VALUES (00000000, 'Izuku Midoriya', 'Civil Engineering', 0);
insert into student VALUES (00000001, 'Tanjiro Kamado', 'Electrical Engineering', 14);
insert into student VALUES (00000002, 'Subaru Natsuki', 'Biology', 119);
insert into student VALUES (00000003, 'Naofumi Iwatani', 'Chemistry', 22);
insert into student VALUES (00000004, 'Kazuma Satou', 'Physics', 28);
insert into student VALUES (00000005, 'Shinra Kusakabe', 'Earth Sciences', 60);
insert into student VALUES (00000006, 'Yuji Itadori', 'Computer Science', 15);
insert into student VALUES (00000007, 'Eren Jaeger', 'Math', 29);
insert into student VALUES (00000008, 'Shirou Emiya', 'Chemical Engineering', 45);
insert into student VALUES (00000009, 'Loid Forger', 'Mechanical Engineering', 24);
insert into student VALUES (00000010, 'Kazuto Kirigaya', 'Biomedical Engineering', 30);
insert into student VALUES (00000011, 'Ken Takakura', 'Plastics Engineering', 106);
insert into student VALUES (00000012, 'Mirio Togata', 'Civil Engineering', 26);
insert into student VALUES (00000013, 'Obanai Iguro', 'Electrical Engineering', 0);
insert into student VALUES (00000014, 'Otto Suwen', 'Biology', 28);
insert into student VALUES (00000015, 'Lalatina Dustiness', 'Physics', 7);
insert into student VALUES (00000016, 'Yuta Okkotsu', 'Computer Science', 29);
insert into student VALUES (00000017, 'Pieck Finger', 'Math', 18);
insert into student VALUES (00000018, 'Artoria Pendragon', 'Chemical Engineering', 9);
insert into student VALUES (00000019, 'Yuri Briar', 'Mechanical Engineering', 11);
insert into student VALUES (00000020, 'Maki Oze', 'Plastics Engineering', 27);
insert into student VALUES (00000021, 'Keigo Takami', 'Civil Engineering', 29);
insert into student VALUES (00000022, 'Tengen Uzui', 'Electrical Engineering', 41);
insert into student VALUES (00000023, 'Crusch Karsten', 'Biology', 23);
insert into student VALUES (00000024, 'Motoyasu Kitamura', 'Chemistry', 4);
insert into student VALUES (00000025, 'Aoi Todo', 'Computer Science', 26);
insert into student VALUES (00000026, 'Armin Arlelt', 'Math', 0);
insert into student VALUES (00000027, 'Illyasviel Einzbern', 'Chemical Engineering', 32);
insert into student VALUES (00000028, 'Viktor Licht', 'Biomedical Engineering', 5);
insert into student VALUES (00000029, 'Cid Kagenou', 'Plastics Engineering', 13);

-- Instructors Data
insert into instructor VALUES (00000000, 'Shota Aizawa', 'Civil Engineering', 8900000);
insert into instructor VALUES (00000001, 'Giyu Tomioka', 'Electrical Engineering', 24600000);
insert into instructor VALUES (00000002, 'Shinobu Kocho', 'Biology', 18600000);
insert into instructor VALUES (00000003, 'Toshinori Yagi', 'Chemistry', 25300000);
insert into instructor VALUES (00000004, 'Mitsuri Kanroji', 'Physics', 28900000);
insert into instructor VALUES (00000005, 'Akitaru Obi', 'Earth Sciences', 2900000);
insert into instructor VALUES (00000006, 'Satoru Gojo', 'Computer Science', 26300000);
insert into instructor VALUES (00000007, 'Levi Ackermann', 'Math', 22800000);
insert into instructor VALUES (00000008, 'Taiga Fujimura', 'Chemical Engineering', 21800000);
insert into instructor VALUES (00000009, 'Sylvia Sherwood', 'Mechanical Engineering', 23100000);
insert into instructor VALUES (00000010, 'Hizashi Yamada', 'Biomedical Engineering', 5700000);
insert into instructor VALUES (00000011, 'Seiko Ayase', 'Plastics Engineering', 23600000);

-- Undergraduate Students Data
insert into undergraduate VALUES (00000000, 1, 'Civil Engineering');
insert into undergraduate VALUES (00000001, 1, 'Electrical Engineering');
insert into undergraduate VALUES (00000002, 4, 'Biology');
insert into undergraduate VALUES (00000004, 2, 'Physics');
insert into undergraduate VALUES (00000005, 3, 'Earth Sciences');
insert into undergraduate VALUES (00000006, 1, 'Computer Science');
insert into undergraduate VALUES (00000007, 2, 'Math');
insert into undergraduate VALUES (00000008, 2, 'Chemical Engineering');
insert into undergraduate VALUES (00000010, 2, 'Biomedical Engineering');
insert into undergraduate VALUES (00000011, 4, 'Plastics Engineering');

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

-- Course Data
insert into course VALUES (00000000, 'Introduction to Engineering for Civil', 'Civil Engineering', 2);
insert into course VALUES (00000001, 'Introduction to ECE', 'Electrical Engineering', 2);
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
insert into course VALUES (00000013, 'Introduction to Mechanical Engineering', 'Mechanical Engineering', 1);
insert into course VALUES (00000014, 'Biomedical Engineering Application Programming', 'Biomedical Engineering', 3);
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

-- Advising Table
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

-- Section Data
insert into section VALUES (00000004, 00000000, 'Spring', 2026, 'Olsen', '300', '4364', 99);
insert into section VALUES (00000004, 00000001, 'Spring', 2026, 'Falmouth', '309', '3274', 52);
insert into section VALUES (00000003, 00000001, 'Spring', 2026, 'Shah', '301', '3281', 50);
insert into section VALUES (00000008, 00000000, 'Spring', 2026, 'Olney', '218', '4365', 54);
insert into section VALUES (00000006, 00000000, 'Spring', 2026, 'Falmouth', '309', '4367', 47);
insert into section VALUES (00000002, 00000000, 'Spring', 2026, 'Olsen', '102', '4364', 86);
insert into section VALUES (00000020, 00000000, 'Spring', 2026, 'Olsen', '300', '4365', 94);
insert into section VALUES (00000002, 00000001, 'Spring', 2026, 'Olsen', '102', '3271', 82);
insert into section VALUES (00000006, 00000002, 'Spring', 2026, 'Ball', '210', '3287', 168);
insert into section VALUES (00000001, 00000000, 'Spring', 2026, 'Olsen', '102', '4362', 82);
insert into section VALUES (00000012, 00000000, 'Spring', 2026, 'Falmouth', '309', '4362', 43);
insert into section VALUES (00000012, 00000001, 'Spring', 2026, 'Falmouth', '309', '3273', 51);
insert into section VALUES (00000019, 00000000, 'Spring', 2026, 'Falmouth', '309', '3283', 44);
insert into section VALUES (00000028, 00000000, 'Spring', 2026, 'Ball', '210', '4363', 167);
insert into section VALUES (00000010, 00000002, 'Spring', 2026, 'Olsen', '104', '3281', 52);
insert into section VALUES (00000010, 00000001, 'Spring', 2026, 'Olney', '218', '4365', 58);
insert into section VALUES (00000012, 00000002, 'Spring', 2026, 'Ball', '210', '3274', 158);
insert into section VALUES (00000004, 00000002, 'Spring', 2026, 'Olney', '218', '4367', 54);
insert into section VALUES (00000029, 00000001, 'Spring', 2026, 'Olsen', '300', '4365', 97);
insert into section VALUES (00000018, 00000001, 'Spring', 2026, 'Olney', '204', '3366', 60);
insert into section VALUES (00000025, 00000002, 'Spring', 2026, 'Shah', '303', '3284', 42);
insert into section VALUES (00000018, 00000002, 'Spring', 2026, 'Ball', '314', '3273', 69);
insert into section VALUES (00000008, 00000002, 'Spring', 2026, 'Shah', '305', '4363', 69);
insert into section VALUES (00000023, 00000000, 'Spring', 2026, 'Olney', '204', '3361', 51);
insert into section VALUES (00000011, 00000002, 'Spring', 2026, 'Olsen', '104', '3282', 55);
insert into section VALUES (00000026, 00000001, 'Spring', 2026, 'Olney', '517', '3365', 50);
insert into section VALUES (00000023, 00000002, 'Spring', 2026, 'Olsen', '104', '3272', 57);
insert into section VALUES (00000007, 00000001, 'Spring', 2026, 'Ball', '214', '3284', 138);
insert into section VALUES (00000003, 00000002, 'Spring', 2026, 'Olsen', '503', '3272', 103);
insert into section VALUES (00000008, 00000001, 'Spring', 2026, 'Olsen', '102', '3364', 78);


-- Teaches Data
insert into teaches VALUES (00000007, 00000011, 00000000, 'Spring', 2026);

-- teacher_assistant data
insert into teacher_assistant VALUES (00000017, 00000011, 00000000, 'Spring', 2026);

-- grader data
insert into grader VALUES (00000007, 00000011, 00000000, 'Spring', 2026);

-- course evaluation data
insert into course_evaluation VALUES (00000019, 00000011, 00000000, 'Spring', 2026, 2, 'Too much memorisation and strict grading');

-- Teaches Data
insert into teaches VALUES (00000007, 00000011, 00000000, 'Spring', 2026);

-- teacher_assistant data
insert into teacher_assistant VALUES (00000017, 00000011, 00000000, 'Spring', 2026);

-- grader data
insert into grader VALUES (00000007, 00000011, 00000000, 'Spring', 2026);

-- course evaluation data
insert into course_evaluation VALUES (00000019, 00000011, 00000000, 'Spring', 2026, 2, 'Too much memorisation and strict grading');