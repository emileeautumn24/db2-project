<?php /** @noinspection SqlNoDataSourceInspection */

function calculate_gpa($connection, $result2) {
    $cumulative_gpa = 0.0;
    $taken_courses = 0.0;

    while ($row = mysqli_fetch_array($result2, MYSQLI_ASSOC)) {
        switch ($row["grade"]) {
            case 'A':
                $cumulative_gpa += 4.0 * $row["credits"];
                break;
            case 'A-':
                $cumulative_gpa += 3.7 * $row["credits"];
                break;
            case 'B+':
                $cumulative_gpa += 3.3 * $row["credits"];
                break;
            case 'B':
                $cumulative_gpa += 3.0 * $row["credits"];
                break;
            case 'B-':
                $cumulative_gpa += 2.7 * $row["credits"];
                break;
            case 'C+':
                $cumulative_gpa += 2.3 * $row["credits"];
                break;
            case 'C':
                $cumulative_gpa += 2.0 * $row["credits"];
                break;
            case 'C-':
                $cumulative_gpa += 1.7 * $row["credits"];
                break;
            case 'D+':
                $cumulative_gpa += 1.3 * $row["credits"];
                break;
            case 'D':
                $cumulative_gpa += 1.0 * $row["credits"];
                break;
            default:
                $cumulative_gpa = 0.0;
        }
        $taken_courses += 4.0 * $row["credits"];
    }

    if ($taken_courses > 0.0) {
        $cumulative_gpa /= $taken_courses;
        $cumulative_gpa *= 4.0;
    }

    return $cumulative_gpa;
}

?>