<?php
require_once('database.php');

// Get all courses
$queryCourses = 'SELECT * FROM sk_courses';
$statement1 = $db->prepare($queryCourses);
$statement1->execute();
$courses = $statement1->fetchAll();
$statement1->closeCursor();

// Get the selected courseID from the URL
$courseID = filter_input(INPUT_GET, 'courseID', FILTER_SANITIZE_SPECIAL_CHARS);

// Fetch course details for the selected courseID
if ($courseID) {
    $queryCourseDetails = 'SELECT * FROM sk_courses WHERE courseID = :courseID';
    $statement3 = $db->prepare($queryCourseDetails);
    $statement3->bindValue(':courseID', $courseID);
    $statement3->execute();
    $courseDetails = $statement3->fetch();
    $statement3->closeCursor();
}

// Get students based on the selected courseID or all students if no courseID is specified
if ($courseID) {
    $queryStudents = 'SELECT * FROM sk_students WHERE courseID = :courseID';
    $statement2 = $db->prepare($queryStudents);
    $statement2->bindValue(':courseID', $courseID);
} else {
    $queryStudents = 'SELECT * FROM sk_students';
    $statement2 = $db->prepare($queryStudents);
}
$statement2->execute();
$students = $statement2->fetchAll();
$statement2->closeCursor();
?>

<!DOCTYPE html>
<html>

<!-- the head section -->

<head>
    <title>My Course Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>

<!-- the body section -->

<body>
    <header>
        <h1>Course Manager</h1>
    </header>
    <main>
        <center>
            <h1>Student List</h1>
        </center>

        <!-- Display course ID and course name if a specific course is selected -->
        <?php if (isset($courseDetails)) : ?>
            <center>
                <h2><?php echo $courseDetails['courseID'] . ' ' . $courseDetails['courseName']; ?></h2>
            </center>
        <?php endif; ?>

        <aside>
            <!-- display a list of categories -->
            <h2>Courses</h2>
            <nav>
                <ul>
                    <?php foreach ($courses as $course) : ?>
                        <li>
                            <a href="?courseID=<?php echo $course['courseID']; ?>">
                                <?php echo $course['courseID']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>
        </aside>

        <section>
            <!-- display a table of Students -->
            <table>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($students as $student) : ?>
                    <tr>
                        <td><?php echo $student['firstName']; ?></td>
                        <td><?php echo $student['lastName']; ?></td>
                        <td><?php echo $student['email']; ?></td>
                        <td>
                            <form action="delete_student.php" method="post">
                                <input type="hidden" name="studentID" value="<?php echo $student['studentID']; ?>">
                                <button type="submit" name="delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>

            <p><a href="add_student_form.php">Add Student</a></p>
            <p><a href="course_list.php">List Courses</a></p>
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Suresh Kalathur</p>
    </footer>
</body>

</html>