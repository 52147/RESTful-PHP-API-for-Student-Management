<?php
require_once('database.php');

// Get the form data
$courseID = filter_input(INPUT_POST, 'course_id', FILTER_SANITIZE_SPECIAL_CHARS);
$firstName = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
$lastName = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);

// Insert the student into the database
$query = 'INSERT INTO sk_students (courseID, firstName, lastName, email) 
          VALUES (:courseID, :firstName, :lastName, :email)';
$statement = $db->prepare($query);
$statement->bindValue(':courseID', $courseID);
$statement->bindValue(':firstName', $firstName);
$statement->bindValue(':lastName', $lastName);
$statement->bindValue(':email', $email);
$statement->execute();
$statement->closeCursor();

// Redirect back to the home page with the current course selection and the resulting students
header('Location: index.php?courseID=' . $courseID);
