<?php
    
    require_once('database.php');

    // Get the student form data
    $courseID = filter_input(INPUT_POST, 'course_id');
    $firstName = filter_input(INPUT_POST, 'first_name');
    $lastName = filter_input(INPUT_POST, 'last_name');
    $email = filter_input(INPUT_POST, 'email');

// validate input
if ($courseID == null || $firstName == null || $lastName == null || $email == null) {
    $error = 'Incomplete student information. Check all fields and try again.';
    // display the form again with error message above if form input is invalid
    include('error.php');
    include('add_student_form.php');

} else {

    // Add the student to the database
    require_once('database.php');
    $statement = $db->prepare('INSERT INTO sk_students (courseID, firstName, lastName, email) 
        VALUES (:courseID, :firstName, :lastName, :email)');
    $statement->bindValue('courseID', $courseID);
    $statement->bindValue('firstName', $firstName);
    $statement->bindValue('lastName', $lastName);
    $statement->bindValue('email', $email);
    $statement->execute();
    $statement->closeCursor();

    // Display the Student List page
    include('index.php');

}
?>