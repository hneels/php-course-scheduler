<?php

/*
Hope Asher
cs602 Assignment 6
*/

require_once('database.php');

try {
    // get the format and action from URL
    $format = filter_input(INPUT_GET, 'format');
    $action = filter_input(INPUT_GET, 'action');


    // if format or action fields are empty, throw error to be caught and displayed below
    if ($format == null || $action == null) {
        throw new Error('Check your URL and try again.');
    }


    /* ---- retrieving data section ---- */

    // if action is courses
    if ($action == 'courses') {

        // execute a PDOStatement to retreive all courses from database
        $courseStatement = $db->prepare("SELECT * FROM sk_courses ORDER BY courseID");
        $courseStatement->execute();
        $data = $courseStatement->fetchAll(PDO::FETCH_ASSOC);
        $courseStatement->closeCursor();

    }

    // else if action is students
    elseif ($action == 'students') {

        // get the course ID from URL
        $courseID = filter_input(INPUT_GET, 'course');

        // execute a PDOStatement to get students from selected course
        $studentStatement = $db->prepare("SELECT * FROM sk_students WHERE courseID = :courseID");
        $studentStatement->bindValue(':courseID', $courseID);
        $studentStatement->execute();
        $data = $studentStatement->fetchAll(PDO::FETCH_ASSOC);
        $studentStatement->closeCursor();
    }


    /* ---- rendering JSON/XML response section ---- */

    // convert the array to XML or JSON depending on format specified in URL
    if ($format == 'xml') {
        
        // create the XML document object
        $doc = new DOMDocument('1.0');

		$doc->formatOutput = true;

        // if 'studentID' is the first column name, the XML element is 'student', otherwise it's 'course'
        $nodeName = array_key_exists('studentID', $data[0]) ? 'student' : 'course';

        // create root element - either 'students' or 'courses'
        $root = $doc->createElement($nodeName . 's');
        $root = $doc->appendChild($root);

        // create a new student or course node for each array
        foreach ($data as $outerKey => $outerValue) {
            $node = $doc->createElement($nodeName);
            $node = $root->appendChild($node);
            // then loop through the inner array keys and create XML elements
            foreach ($data[$outerKey] as $key => $value) {
                $child = $doc->createElement($key, $value);
                $node->appendChild($child);
            }
        }

        // set header and send XML
        header("Content-Type: application/xml");
        echo $doc->saveXML();

    }

    elseif ($format == 'json') {

        // set header, convert array to JSON and send JSON
        header('Content-Type: application/json');
        echo json_encode($data, JSON_PRETTY_PRINT);
    }

} catch (Error $e) {
    $error = $e->getMessage();
    include('error.php');
    exit();
}

?>