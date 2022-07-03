<?php
require('database.php');

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
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<!-- the body section -->
<body>
    <header><h1>Course Manager</h1></header>

    <main>
        <h1>Add Student</h1>
        <form action="add_student.php" method="post"
              id="add_student_form">

            <!-- display a Select option for each course -->
            <label for="course_id">Course:</label>
            <select id="course_id" name="course_id">
            <?php foreach ($courses as $course) : ?>
            
                <option value="<?php echo $course['courseID']; ?>">
                    <?php echo $course['courseID'] . '- ' . $course['courseName'];?>
                </option>
            
            <?php endforeach ?>
            </select>
            <br>

            
            <label for="first_name">First Name:</label>
            <input id="first_name" type="text" name="first_name"><br>

            <label for="last_name">Last Name:</label>
            <input id="last_name" type="text" name="last_name"><br>

            <label for="email">Email:</label>
            <input id="email" type="email" name="email"><br>


            <label>&nbsp;</label>
            <input type="submit" value="Add Student"><br>
        </form>
        <p><a href="index.php">View Student List</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> Suresh Kalathur.</p>
    </footer>
</body>
</html>