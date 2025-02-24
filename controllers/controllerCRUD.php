<?php
$action = isset($_GET['action']) ? $_GET['action'] : '';
$table = isset($_GET['table']) ? $_GET['table'] : '';

if ($action === 'Create' ){
    header("Location: ../view/front/create.php?table=$table");
} elseif ($action === 'Delete' ){
    header("Location: ../view/front/delete.php?table=$table");
}elseif ($action === 'Modify' ){
    header("Location: ../view/front/modify.php?table=$table");
}
?>
