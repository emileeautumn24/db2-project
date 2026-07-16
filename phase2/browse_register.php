<?php /** @noinspection SqlNoDataSourceInspection */

$student_id = $_POST["student_id"];
$course_id = $_POST["course_id"];
$section_id = $_POST["section_id"];
$semester_name = isset($_POST["semesterSelector"]) ? $_POST["semesterSelector"] : null;
if ($semester_name === null) {
    die("Please select a semester.");
}
$year_id = $_POST["year_id"];

// checks connection
$connection = mysqli_connect("localhost", "root", "")
or die ("Could not connect: " . mysqli_error($connection));

// checks if database exists
$db = mysqli_select_db($connection, "db2") or die ("Could not select database");

// check if View button or Enroll button is clicked
if (isset($_POST["view_btn"])) {
    // View was clicked
    echo "<strong>" . $semester_name . " " . $year_id . " Course Offerings</strong><br><br>";

    // get list of courses offered
    $query0 = "SELECT C.course_id, C.title, C.dept_name, C.credits, S.section_id FROM course C, section S " .
    "WHERE S.semester = '" . $semester_name . "' AND S.year = " . $year_id . " AND C.course_id = S.course_id";
    $result0 = mysqli_query($connection, $query0) or die ("View courses failed" . mysqli_error($connection));
    while ($row = mysqli_fetch_array($result0, MYSQLI_ASSOC)) {
        echo "<strong>" . $row["title"] . "</strong><br>";
        echo "<strong>Course ID: </strong>" . $row["course_id"] . "<br>";
        echo "<strong>Section ID: </strong>" . $row["section_id"] . "<br>";
        echo "<strong>Department: </strong>" . $row["dept_name"] . "<br>";
        echo "<strong>Credits: </strong>" . $row["credits"] . "<br><br>";
    }
    mysqli_free_result($result0);
} elseif (isset($_POST["enroll_btn"])) {
    // Enroll was clicked

    // Check if course and section exists
    $query1 = "SELECT course_id, section_id, semester, year FROM section WHERE course_id = " . $course_id . " AND section_id = " . $section_id . " AND semester = '" . $semester_name . "' AND year = " . $year_id;
    $result1 = mysqli_query($connection, $query1) or die ("Course and/or Section doesn't exist." . mysqli_error($connection));
    if ($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)) {
        // Check if section is full or not
        $query2 = "SELECT (SELECT count(*) FROM takes T WHERE T.course_id = " . $course_id . " AND T.section_id = " . $section_id .
        " AND T.semester = '" . $semester_name . "' AND T.year = " . $year_id . ") AS count, S.capacity FROM section S WHERE S.course_id = " .
        $course_id . " AND S.section_id = " . $section_id . " AND S.semester = '" . $semester_name . "' AND S.year = " . $year_id;
        $result2 = mysqli_query($connection, $query2) or die ("Course and/or Section count failed." . mysqli_error($connection));
        if ($countRow = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
            if ($countRow["count"] < $countRow["capacity"]) {
                // Check if student already passed the course
                $query6 = "SELECT student_id, course_id FROM takes WHERE student_id = " . $student_id . " AND course_id = " . $course_id . " AND grade <> 'F'";
                $result6 = mysqli_query($connection, $query6) or die ("Course taken check failed." . mysqli_error($connection));
                if (mysqli_num_rows($result6) > 0) {
                    die ("Student already passed the course.");
                }

                // Check if course has any prerequisites
                $query3 = "SELECT count(*) AS count FROM prereq WHERE course_id = " . $course_id;
                $result3 = mysqli_query($connection, $query3) or die ("Prereq count failed." . mysqli_error($connection));
                if ($countRow1 = mysqli_fetch_array($result3, MYSQLI_ASSOC)) {
                    if ($countRow1["count"] > 0) {
                        $query4 = "SELECT prereq_id FROM prereq WHERE course_id = " . $course_id;
                        $result4 = mysqli_query($connection, $query4) or die ("Selecting prereq IDs failed." . mysqli_error($connection));
                        while ($prereqRow = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                            $query5 = "SELECT course_id FROM takes WHERE course_id = " . $prereqRow["prereq_id"] . " AND student_id = " . $student_id;
                            $result5 = mysqli_query($connection, $query5) or die ("Finding prereq ID failed." . mysqli_error($connection));
                            if (mysqli_num_rows($result5) <= 0) {
                                die ("Student has not completed the prerequisites yet.");
                            }
                            mysqli_free_result($result5);
                        }
                        mysqli_free_result($result4);

                        // Prerequisite check complete, now enroll student
                        $enrollStudent = "INSERT INTO takes VALUES ('" . $student_id . "', '" . $course_id . "', '" . $section_id . "', '" . $semester_name . "', " . $year_id . ", NULL)";
                        $enrollResult = mysqli_query($connection, $enrollStudent) or die ('Enroll student failed ' . mysqli_error($connection));
                        echo "Student successfully enrolled!";
                    } else {
                        // No prerequisite check required
                        $enrollStudent = "INSERT INTO takes VALUES ('" . $student_id . "', '" . $course_id . "', '" . $section_id . "', '" . $semester_name . "', " . $year_id . ", NULL)";
                        $enrollResult = mysqli_query($connection, $enrollStudent) or die ('Enroll student failed ' . mysqli_error($connection));
                        echo "Student successfully enrolled!";
                    }
                }
                mysqli_free_result($result3);
            } else {
                die ("Section is full.");
            }
        } else {
            die ("Course and/or Section count failed." . mysqli_error($connection));
        }
        mysqli_free_result($result2);
    } else {
        die ("Course and/or Section doesn't exist." . mysqli_error($connection));
    }
    mysqli_free_result($result1);
} 

mysqli_close($connection);
?>