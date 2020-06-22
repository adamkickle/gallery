<?php

require_once '../Includes/init.php';
$photo = new photograph();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $photo = $photo->find_by_id($id);
    if ($photo['filename']) {
        echo '<div style="padding:5% auto;text-align:center">';
        echo '<img style="max-width:1300px;max-height:1300px" src="http://localhost/gallery/public/admin/images/' . $photo['filename'] . '" />';
        echo "<a href='index.php'>Back</a>";
        echo "</div>";
    } else {
        header("location:index.php");
    }
} else {
    //  header("location:index.php");
}
// perform the form proccessig

if (isset($_POST['submit'])) {
    $author = trim($_POST['author']);
    $body = trim($_POST['body']);
    $new_comment = comment::make($photo['id'], $author, $body);

    if ($new_comment && $new_comment->create()) {
        // COMMENT saved
        header("location:photo.php?id={$photo['id']}");

    } else {
        // failed
        $message = "there was an error that prevented the comment from bieng aved";

    }

} else {
    $author = "";
    $body = "";
}

// find the comments related to the photo

$comment = new comment();
$comments = $comment->find_by_id($id);

echo "<ul>";
foreach ($comments as $comment) {
    echo "<li>";
    echo $comment['author'] . " ____" . $comment['body'] . "<br>" . datetime_to_text($comment['created']);

    echo "</li>";

}
echo "</ul>";
?>
<?php include '../Public/layouts/admin_header.php';?>

<!-- list the comments -->

<form action="photo.php?id=<?php echo $photo['id']; ?>" method="POST">

    <h2>New comment </h2>
        <div>
                Your name :

                <input  type="text"  name="author" value="<?php echo $author; ?>" />
        </div>

    <h2>Your comment :

    <textarea name="body" cols="40" rows="8">
            <?php
            echo $body;
            ?>

 </textarea>


<input type="submit" name="submit" value="submit comment"/>





</form>