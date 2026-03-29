## UML Database Managemnet System ##

## Project Overview

## Team Members

Group 9

Emilee Autumn
Billy Chin
Zaniab Nadeem

## Installation & Setup

To run this project locally, we'll need XAMPP.

1. **Software:** Install [XAMPP](https://www.apachefriends.org/index.html).
2. **Directory:** Clone this repository or move the `db2-project` folder into:
   `C:\xampp\htdocs\db2-project\`
3. **Start Services:** Open XAMPP Control Panel and start **Apache** and **MySQL**.
4. **Database Import:**
   * Go to [phpmyadmin](http://localhost/phpmyadmin/).
   * Create a database named `db2`.
   * Copy the files in the `phase2/sql/` folder in this order: `DB2-tables.sql`, then `DB2-data.sql`.
5. **Access:** Open your browser and go to `http://localhost/db2-project/phase2/login.html`.

## Directory Structure

The repository format:

```bash
.
DB2-project
├── phase2                  # Phase 2 root directory
│   ├── sql                 # SQL files
│   │   ├── DB-tables.sql   # SQL file provided in this repository
│   │   └── DB-data.sql     # SQL file containing insertion statements used to populate the database
│   ├── README.md           # Specific documentation for phase 2
│   └── ...                 # Other files
```


## Test Cases & Functionality

Use the following credentials and inputs to verify the system's requirements:

| Task | Feature | Test Cases / Inputs | Outcome |
| :--- | :--- | :--- | :--- |
| **1** | **Accounts and login** | User: `00000000` / Pass: `Izuku Midoriya` | You're logged in! Welcome Izuku Midoriya!
Student ID: 0. |
| **2** | **Create course Section** | Course: `5`, Section: `98`, Inst: `0`, Building: `Shah` Room Number: `301`, Time Slot: `3112` | Success! Section Created
Successfully created Section 98 for Course 5. |
| **3** | **Advising** | Student ID: `6`, Instructor ID: `6` (Undergrad) | Instructor ID: 6
Instructor Name: Satoru Gojo

Student ID: 6
Student Name: Yuji Itadori

Courses Taken
Computing I Lab
Computing I

Cumulative GPA
1.775

Remaining Credits to Graduate
105 |
| **4** | **Browse and Register** | Student: `00000042`, Course: `27`, Section: `0`, Spring 2026 | Student successfully enrolled!. |
| **5** | **Student Transcript** | Student ID: `6` | Student ID: 6
Student Name: Yuji Itadori

Courses Taken
Computing I Lab
Computing I

Cumulative GPA
1.775

Total Credits Earned
15 |
| **6** | **Instructor teaching Records** | Instructor ID: `00000000`, Course: `0`, Section: `0` | Sections Taught by Instructor 0:
Course	Section	Semester	Year
0	0	Spring	2026 |
| **7** | **TA Assignments** | TA: `00000030`, Course: `9`, Section: `1`, Spring 2026 | TA successfully assigned!. |
| **8** | **Grader Assignments** | Grader: `00000042`, Course: `11`, Section: `1`, Spring 2026 | Grader successfully assigned!. |
| **9** | **Discussion Board** | **Post:** Student `0`,  / **Delete:** Student `21` (TA role) |  |
| **10**| **Course Evaluation** | Student: `00000001`, Course: `1`, Section: `0`,Semsster: Spring, Rating: `5` | Success! Evaluation Submitted.
Course: Introduction to ECE
Your Final Grade: C- |

## Notes


