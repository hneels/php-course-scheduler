# PHP Course Scheduler

## Technologies
* PHP
* SQL
* CSS

*This project was an assignment for CS602: Server-Side Web Development. Copying any portion and submitting it as your own work is a violation of Boston University's Academic Conduct Code and is prohibited. This was an individual assignment and the starter code is &copy;2021 Professor Suresh Kalathur at Boston University.*

## Summary
PHP Course Scheduler allows the user to add courses into a university course catalog database, add new students to a students database, and add/remove courses onto any student's schedule. In the course manager, the user can view a list of all existing courses and submit a form to add a new Course ID and Course Name. In the Student List view, the user can view a table of all enrolled students by course, delete any student or submit a form to add a new student to a course. The application has views for error handling, and it uses Prepared Statement objects to validate the data and prevent SQL injection attacks.

## REST Endpoints
The rest.php file provides an endpoint to send the Courses or Students data retrieved from the database (depending on the action specified in the URL) in both JSON and XML formats. I used the Postman app to verify this functionality.

## How to Run
Download <a href="https://www.mamp.info/en/mamp/">MAMP</a> and place the code cloned from this repo in the "htdocs" folder within the MAMP program files. Open the MAMP application, click "start" in the upper-right corner, then click "webstart". In the browser window that opens, select "My Website" and choose the directory name for this project.
