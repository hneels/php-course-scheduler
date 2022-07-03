<?php
require_once('database.php');

// Get the student form data
$studentID = filter_input(INPUT_POST, 'student_id');
$courseID = filter_input(INPUT_POST, 'course_id'); // this is used below in index.php to show the current course

// validate form data
if ($studentID == null || $courseID == null) {
    $error = 'Something went wrong. Please try again.';
    include('error.php');

} else {

    // Delete the student from the database
    include('database.php');
    $statement = $db->prepare('DELETE FROM sk_students WHERE studentID = :studentID');
    $statement->bindValue('studentID', $studentID);
    $statement->execute();
    $statement->closeCursor();

}

// Display the Home page
include('index.php');

?>