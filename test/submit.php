<?php
session_start();
include('db.php');
date_default_timezone_set('Asia/Kuala_Lumpur');

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $comment = trim($_POST['comment']);

    if (!empty($comment)) {
        // Prevent SQL Injection
        $comment = $Con->real_escape_string($comment);

        // Insert comment
        $sql = "INSERT INTO tblcomment (comment) VALUES ('$comment')";

        if ($Con->query($sql) === TRUE) {
            echo "Comment submitted successfully!";
        } else {
            echo "Error submitting comment: " . $Con->error;
        }
    } else {
        echo "Please write a comment before submitting.";
    }
}

$Con->close();
?>
<br><br>
<a href="comment.html">Back to comment form</a>
