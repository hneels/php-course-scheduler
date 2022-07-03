# PHP Course Scheduler

## Technologies
* PHP
* SQL
* CSS

*This project was an assignment for BU MET CS602: Server-Side Web Development and copying any portion of it is a violation of Boston University's Academic Conduct Code. Assignment starter code &copy;2021 Suresh Kalathur/Boston University.*

## Summary
PHP Course Scheduler allows the user to add courses into a university course catalog database, add new students to a students database, and add/remove courses onto any student's schedule. In the course manager, the user can view a list of all existing courses and submit a form to add a new Course ID and Course Name. In the Student List view, the user can view a table of all enrolled students by course, delete any student or submit a form to add a new student to a course. The application has views for error handling, and it uses Prepared Statement objects to validate the data and prevent SQL injection attacks.

## REST Endpoints
The rest.php file provides an endpoint to send the Courses or Students data retrieved from the database (depending on the action specified in the URL) in both JSON and XML formats. I used the Postman app to verify this functionality.