# Phase 3 - Android App

## Team Members

Group 9

`Emilee Autumn`<br>`Billy Chin`<br>`Zaniab Nadeem`

<br><br>

## Environment Information

## Project Instructions

### Prerequisites
1. Install [Android Studio](https://developer.android.com/studio)
2. Install [XAMPP](https://www.apachefriends.org/) with Apache and MySQL
3. Clone this repository

### Database Setup

### Backend Setup
1. Copy all PHP files from the `phase2/` directory into:
   ```
   C:\xampp\htdocs\phase2\
   ```
2. Verify Apache is running and test by visiting `http://localhost/phase2/login.php` in a browser

### Android App Setup


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