<?php
require_once('database.php');

// Get the studentID to delete
$studentID = filter_input(INPUT_POST, 'studentID', FILTER_VALIDATE_INT);

if ($studentID) {
    // Delete the student from the database
    $query = 'DELETE FROM sk_students WHERE studentID = :studentID';
    $statement = $db->prepare($query);
    $statement->bindValue(':studentID', $studentID);
    $statement->execute();
    $statement->closeCursor();
}

// Redirect back to the current course's student list page
if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: index.php'); // Redirect to index if HTTP_REFERER is not available
}
