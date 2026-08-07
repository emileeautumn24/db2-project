## UML Database Managemnet System ##

## Project Overview

For Phase 2 of our Database II project, our team built a functional web interface similar to SiS (Student Information System) to manage a university's daily operations. This project is a functional Relational Database Management System (RDBMS) developed for the University of Massachusetts Lowell, transitioning our conceptual E/R modeling into a full-stack implementation using MySQL and PHP. 

We focused heavily on "Business Logic", the administrative rules that keep a university running. We ensured that our PHP scripts don't just "input data," but actively enforce critical constraints such as instructor overbooking, classroom capacity limits, and student enrollment verification before allowing access to course evaluations or the discussion board.

The system provides a web-based interface for three distinct user roles:
* Administrators
* Instructors 
* Students 

Key features include a constraint-based course scheduler (enforcing consecutive instructor time slots), a grade-locked course evaluation system, and a moderated discussion board for active sections.

## Team Members

Group 9

`Emilee Autumn`<br>`Billy Chin`<br>`Zaniab Nadeem`

<br><br>

Demo: [Video](https://www.youtube.com/watch?v=kQFlepceiVM)

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
| **1** | **Accounts and login** | User: `00000000` / Pass: `constraint2238` | `You're logged in! Welcome Izuku Midoriya!`<br>`Student ID: 00000000.` |
| **2** | **Create course Section** | Course: `00000013`, Section: `00000001`, Inst: `00000009`, Building: `Olsen` Room Number: `405`, Time Slot: `3283` | `Success! Section Created`<br>`Successfully created Section 00000001 for Course 00000013.` |
| **3** | **Advising** | Student ID: `00000006`, Instructor ID: `00000006` (Undergrad) |`Instructor ID: 00000006`<br>`Instructor Name: Satoru Gojo`<br>`Student ID: 00000006`<br>`Student Name: Yuji Itadori`<br>`Courses Taken`<br>`Computing I Lab`<br>`Computing I`<br>`Cumulative GPA: 1.775`<br>`Remaining Credits to Graduate:105` |
| **4** | **Browse and Register** | Student: `00000042`, Course: `00000027`, Section: `00000000`, Spring 2026 | Student successfully enrolled!. |
| **5** | **Student Transcript** | Student ID: `00000006` | `Student ID: 00000006`<br>`Student Name: Yuji Itadori`<br>`Courses Taken:Computing I Lab`,`Computing I`<br>`Cumulative GPA: 1.775`<br>`Total Credits Earned:15` |
| **6** | **Instructor teaching Records** | Instructor ID: `00000000`, Course: `00000000`, Section: `00000000` | `Sections Taught by Instructor 00000000:`<br>`Course`,`Section`,`Semester`,`Year`<br>`00000000`,`00000000`,`Spring`,`2026` |
| **7** | **TA Assignments** | TA: `00000030`, Course: `00000009`, Section: `00000001`, Spring 2026 | TA successfully assigned!. |
| **8** | **Grader Assignments** | Grader: `00000042`, Course: `00000011`, Section: `00000001`, Spring 2026 | Grader successfully assigned!. |
| **9** | **Discussion Board** | **Post:** Student `00000000`, Course: `00000000`, Section: `00000000`, Spring 2026 / **Delete:** Student `00000021`,Course: `00000000`, Section: `00000000`, Spring 2026, Student ID to Delete Posts From `00000000` (TA role) |  |
| **10**| **Course Evaluation** | Student: `00000001`, Course: `00000001`, Section: `00000000`, Spring 2026, Rating: `5` | `Success! Evaluation Submitted.`<br>`Course: Introduction to ECE`<br>`Your Final Grade: C-` |

## Notes

* We used `intval()` and `abs()` in PHP to calculate the distance between Time Slot IDs. This ensures that if an instructor teaches two classes, they are back-to-back, preventing "gaps" in their schedule as required by Task 2.

* In our `.php` files we used `die()` statements and `mysqli_error()` extensively. We did this so that if a query fails (like a student trying to register for a full class), the system gives a clear reason why instead of just a blank screen.

* Our `DB2-data.sql` contains custom-made records for students and instructors. We made sure to include edge cases, like students with enough credits to graduate and others who are just starting.

