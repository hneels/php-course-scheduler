<?php
require_once('database.php');

// execute a PDOStatement to retreive all courses from database
$courseStatement = $db->prepare("SELECT * FROM sk_courses ORDER BY courseID");
$courseStatement->execute();
$courses = $courseStatement->fetchAll();
$courseStatement->closeCursor();
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
<header><h1>Course Manager</h1></header>
<main>
    <h1>Course List</h1>
    <table>
        <tr>
            <th>ID</th><th>Name</th>
        </tr>
        <!-- add code for the rest of the table here -->
        <?php foreach ($courses as $course) : ?>
            <tr>
                <td><?php echo $course['courseID']; ?></td>
                <td><?php echo $course['courseName']; ?></td>
            </tr>
        <?php endforeach ?>
    </table>

    <p>
    <h2>Add Course</h2>
    
    <form action="add_course.php" method="post"
              id="add_course_form">

        <label>Course Id:</label>
        <input type="text" name="course_id"><br>
        <label>Course Name:</label>
        <input type="text" name="course_name" width="200"><br>
        
        <label>&nbsp;</label>
        <input type="submit" value="Add Course"><br>

    </form>


    <br>
    <p><a href="index.php">List Students</a></p>

    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Suresh Kalathur</p>
    </footer>
</body>
</html>