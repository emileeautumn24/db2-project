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

## Directory Structure

```
DB2-project
├── phase2/                  # Phase 2 web app (unchanged)
│   ├── sql/                 # SQL files
│   ├── README.md
│   └── ...
├── phase3/                  # Phase 3 Android app
│   └── app/
│       └── src/main/
│           ├── java/com/database2/android/studentinfo/
│           │   ├── MainActivity.java
│           │   ├── loginFragment.java
│           │   ├── mainMenuFragment.java
│           │   ├── registerFragment.java
│           │   ├── transcriptFragment.java
│           │   ├── discussionFragment.java
│           │   └── evaluationFragment.java
│           └── res/
│               ├── layout/         # XML UI layouts
│               └── navigation/     # Nav graph
└── README.md
```

## App Features

| Task | Feature | Inputs | Outcome                                                   |
|:---|:---|:---|:----------------------------------------------------------|
| **1** | **Login** | Username: `00000000` / Password: `Izuku Midoriya` | Logged in successfully, navigates to Main Menu            |
| **1** | **Forgot Username** | Leave username blank, use Forgot Username | Returns username for account                              |
| **1** | **Forgot Password** | Leave password blank, use Forgot Password | Returns password for account                              |
| **2** | **Browse & Register** | Student: `00000042` / Password: `Mikasa Ackermann` → Course: `27`, Section: `0`, Semester: `Spring`, Year: `2026` | Student successfully enrolled!                            |
| **3** | **Student Transcript** | Student: `6` / Password: `Yuji Itadori` | Shows courses taken, cumulative GPA, total credits earned |
| **4** | **Discussion Board (Post)** | Student: `0` / Password: `Izuku Midoriya` → Course: `0`, Section: `0`, Semester: `Spring`, Year: `2026`, Post: `this class is exhausting`, Type: `Student` | Post submitted, board updated                             |
| **4** | **Discussion Board (Delete)** | Student: `21` / Password: `Keigo Takami` → Course: `0`, Section: `0`, Semester: `Spring`, Year: `2026`, Student ID to delete: `0`, Type: `TA` | Post by student `0` deleted                               |
| **5** | **Course Evaluation** | Student: `00000001` / Password: `Tanjiro Kamado` → Course: `1`, Section: `0`, Semester: `Spring`, Year: `2026`, Rating: `5`, Comment: `Very easy to understand the lectures and material.` | `Success! Evaluation Submitted.` — grade is then visible  |

## Notes

- All HTTP requests are made asynchronously using `ExecutorService` so the UI never freezes during database calls.
- HTML tags returned by PHP responses are stripped using regex before displaying in TextViews.
- The delete post button on the Discussion Board is visible to all users — permission enforcement is handled by the PHP backend, consistent with Phase 2 behavior.
- Role-based navigation is supported: the app passes `username` and `role` arguments between fragments using Android's Navigation Component Bundle system.