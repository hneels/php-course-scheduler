<?php
    require_once('database.php');

    // Get the course form data
    $courseID = filter_input(INPUT_POST, 'course_id');
    $courseName = filter_input(INPUT_POST, 'course_name');

    // validate input
    if ($courseID == null || $courseName == null) {
        $error = 'Incomplete course information. Check all fields and try again.';
        include('error.php');

    } else {
        // Add the course to the database 
        require_once('database.php');
        $statement = $db->prepare('INSERT INTO sk_courses VALUES (:courseID, :courseName)');
        $statement->bindValue('courseID', $courseID);
        $statement->bindValue('courseName', $courseName);
        $statement->execute();
        $statement->closeCursor();
    }
   
   
    // Display the Course List page
    include('course_list.php');

?>