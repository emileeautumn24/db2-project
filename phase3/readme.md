# Phase 3 - Android App

## Team Members

Group 9

`Emilee Autumn`<br>`Billy Chin`<br>`Zaniab Nadeem`

<br><br>

## Environment Information
Live Demo:
Apple M4 Pro (12/16), 24GB RAM

Pre-recorded Demo:
Intel i9-12900k, AMD RX 6700 XT, 64GB RAM
## Project Instructions

### Prerequisites
1. Install [Android Studio](https://developer.android.com/studio)
2. Install [XAMPP](https://www.apachefriends.org/) with Apache and MySQL
3. Clone this repository

### Database Setup

1. Launch the XAMPP app and run Apache and MySQL.
2. Visit `http://localhost/phpmyadmin/`
3. Copy all contents of `phase2/sql/DB2-tables.sql` from GitHub, go to the SQL tab of `http://localhost/phpmyadmin/`, paste the contents of the file in the textbox and press "go" to create tables.
4. Go to the "db2" database, copy all contents of `phase2/sql/DB2-data.sql` from GitHub, go to the SQL tab, paste the contents of the file in the textbox and press "go" to fill tables with data. The database should have all data needed for the tables.

### Backend Setup
1. Copy all PHP files from the `phase2/` directory into:
   ```
   C:\xampp\htdocs\phase2\
   ```
2. Verify Apache is running and test by visiting `http://localhost/phase2/login.php` in a browser

### Android App Setup

1. Launch the Android Studio app.
2. Open the `phase3\` directory as a project inside the app.
3. Click `build` to allow the project to build the necessary files to allow the project to run on the emulator as an app. This will take a few minutes if build is run for the first time.
4. Click `run` to test the app.

## Phase 2 Directory Modifications

No existing Phase 2 files were modified. The Android app reuses the existing PHP endpoints as-is by sending HTTP POST requests with the same parameters the web interface uses.
 
---

## App Features

| Task | Description |
|---|---|
| Login | Pre-created accounts for students, instructors, and admin. Supports forgot username/password. |
| Browse & Register | Students can browse current semester offerings and register for a section if space is available (max 15 per section). |
| Student Transcript | Students can view courses taken, total credits earned, and cumulative GPA. |
| Discussion Board | Enrolled students can post. TA and Grader roles can delete student posts. |
| Course Evaluation | Students must submit a course evaluation before viewing their grade for that course. |
