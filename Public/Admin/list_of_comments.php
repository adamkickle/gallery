<?php

include_once '../../Includes/init.php';
require_once '../../Includes/functions.php';

if (!$session->is_logged_in()) {header('location: login.php');}
;

echo $message;
// find the comments related to the photo

$comment = new comment();
$comments = $comment->find_all();
if ($comments) {
    echo "<ul>";
    foreach ($comments as $comment) {
        echo "<li>";
        echo $comment['author'] . " ____" . $comment['body'] . "<br>" . datetime_to_text($comment['created']);
        echo '<a  href="/gallery/public/admin/delete_comment.php?id='. $comment['id'] . '">delete</a> ';

        echo "</li>";
    }

    echo "</ul>";
} else {
    $session->message ( "there is no comments yet");

    sleep(1);

    header("location:index.php");
}
