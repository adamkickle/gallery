<?php

include_once '../Includes/init.php';
require_once '../Includes/functions.php';

echo "<div style='background:red'>" . $message . "</div>";
// ==== pagination
$page = !empty($_GET['page']) ? (int) $_GET['page'] : 1;
$per_page = 2;
$tottal_count = photograph::count_all();
// ==== end of pagination logic
$photo = new photograph();
//
// $photos = $photo->find_all(); // replaces with pagination tech
//

$pagination = new pagination($page, $per_page, $tottal_count);
$sql = "SELECT * FROM photographs ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$photos = photograph::get_page_photos($sql);

foreach ($photos as $photo) {

    echo '<a  href="photo.php?id=' . $photo['id'] . '">';
    echo '<img style="width:200px;height:200px" src="http://localhost/gallery/public/admin/images/' . $photo['filename'] . '" />';
    echo "<span style='width:200px;height:200px' >" . $photo['caption'] . "</span>";
    echo '</a>';
}
?>
<div id="pagination" style="clear:both;">
<?php
if ($pagination->total_pages() > 1) {
 
    if ($pagination->has_previous_page()) {
        echo "<a href=\"index.php?page=";
        echo $pagination->previous_page();
        echo "\">&laquo; Previous </a> " ;
    }
 
    for($i = 1; $i <=$pagination->total_pages(); $i++){
        if($i == $page){
            echo " <span style='color:grey'>".$i."</span> ";

        }else{
            echo " <a href=\"index.php?page={$i}\">{$i}</a> ";

        }
    }
 
    if ($pagination->has_next_page()) {
        echo "<a href=\"index.php?page=";
        echo $pagination->next_page();
        echo "\">Next &raquo;</a>";
    }
}

?>

</div>
