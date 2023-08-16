<?php
require_once('database.php');

// Get course data from form
$course_id = filter_input(INPUT_POST, 'course_id');
$course_name = filter_input(INPUT_POST, 'course_name');

// Validate input
if (empty($course_id) || empty($course_name)) {
    // Redirect back to the add_course_form.php with an error message
    header("Location: add_course_form.php?error=Invalid input. Please fill in all fields.");
    exit();
} else {
    // Check if the course already exists
    $queryCheckCourse = 'SELECT courseID FROM sk_courses WHERE courseID = :course_id';
    $statementCheckCourse = $db->prepare($queryCheckCourse);
    $statementCheckCourse->bindValue(':course_id', $course_id);
    $statementCheckCourse->execute();
    $existingCourse = $statementCheckCourse->fetch();
    $statementCheckCourse->closeCursor();

    if ($existingCourse) {
        // Redirect back to the add_course_form.php with an error message
        header("Location: add_course_form.php?error=Course ID already exists. Please choose a different ID.");
        exit();
    }

    // Insert the course into the database
    $queryInsertCourse = 'INSERT INTO sk_courses (courseID, courseName) VALUES (:course_id, :course_name)';
    $statementInsertCourse = $db->prepare($queryInsertCourse);
    $statementInsertCourse->bindValue(':course_id', $course_id);
    $statementInsertCourse->bindValue(':course_name', $course_name);
    $statementInsertCourse->execute();
    $statementInsertCourse->closeCursor();
}

// Redirect to the index.php page of the newly added course
header("Location: index.php?courseID=$course_id");
exit();
