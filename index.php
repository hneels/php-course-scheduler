<?php
require_once('database.php');

// execute a PDOStatement to retreive all courses from database
$courseStatement = $db->prepare("SELECT * FROM sk_courses ORDER BY courseID");
$courseStatement->execute();
$courses = $courseStatement->fetchAll();
$courseStatement->closeCursor();


// get course id for selected course (if it exists in URL GET request)
if (!isset($courseID)) {
    $courseID = filter_input(INPUT_GET, 'courseID');
    // if no course is selected, get the courseID of the first course in the array
    if ($courseID == null) {
        $courseID = $courses[0]['courseID'];
    }
}

// execute a PDOStatement to retrieve the current course name
$nameStatement = $db->prepare('SELECT courseName FROM sk_courses WHERE courseID = :courseID');
$nameStatement->bindValue(':courseID', $courseID);
$nameStatement->execute();
$courseName = $nameStatement->fetch()['courseName'];
$nameStatement->closeCursor();

// execute a PDOStatement to get students from selected course
$studentStatement = $db->prepare("SELECT * FROM sk_students WHERE courseID = :courseID");
$studentStatement->bindValue(':courseID', $courseID);
$studentStatement->execute();
$students = $studentStatement->fetchAll();
$studentStatement->closeCursor();


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
    
    <aside>
        <!-- display a list of courses -->
        <h2>Courses</h2>
        <nav>
        <ul>
            <!-- loop through all the courses, making each one a link with corresponding GET request back to this page -->
            <?php foreach($courses as $course) : ?>
                <li><a href=".?courseID=<?php echo $course['courseID']; ?>">
                    <?php echo $course['courseID']; ?>
                </a></li>

            <?php endforeach ?>
        </ul>
        </nav>          
    </aside>

    <section>
    <h1>Student List</h1>
    <!-- Heading with the current selected course -->
    <h2><?php echo $courseID . ' - ' . $courseName ?></h2>
        <!-- display a table of Students -->
        
        <table>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>&nbsp;</th>
            </tr>
            <!-- loop through the students retrieved from db -->
            <?php foreach ($students as $student) : ?>
            <tr>
                <td><?php echo $student['firstName']; ?></td>
                <td><?php echo $student['lastName']; ?></td>
                <td><?php echo $student['email']; ?></td>
                <!-- form with hidden input fields to delete student -->
                <td><form action="delete_student.php" method="post">
                        <input type="hidden" name="student_id" value="<?php echo $student['studentID']; ?>">
                        <input type="hidden" name="course_id" value="<?php echo $student['courseID']; ?>">
                        <input type="submit" value="Delete">
                </form></td>
            </tr>
            <?php endforeach ?>

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