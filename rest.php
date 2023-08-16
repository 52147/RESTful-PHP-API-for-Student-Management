<?php
require_once('database.php');

// Get the parameters from the GET request
$action = isset($_GET['action']) ? $_GET['action'] : null;
$courseID = isset($_GET['course']) ? $_GET['course'] : null;

// Based on the action, process the request
switch ($action) {
    case 'courses':
        $queryCourses = 'SELECT * FROM sk_courses';
        $statement = $db->prepare($queryCourses);
        $statement->execute();
        $courses = $statement->fetchAll(PDO::FETCH_ASSOC); // Fetching as associative array
        $statement->closeCursor();

        header("Content-Type: application/json");
        echo json_encode($courses);
        break;

    case 'students':
        $queryStudents = 'SELECT * FROM sk_students WHERE courseID = :courseID';
        $statement = $db->prepare($queryStudents);
        $statement->bindValue(':courseID', $courseID);
        $statement->execute();
        $students = $statement->fetchAll(PDO::FETCH_ASSOC); // Fetching as associative array
        $statement->closeCursor();

        header("Content-Type: application/json");
        echo json_encode($students);
        break;

    default:
        http_response_code(400);
        echo "Invalid action specified";
        break;
}
?>
