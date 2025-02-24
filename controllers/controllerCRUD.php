<?php
$action = isset($_GET['action']) ? $_GET['action'] : '';
$table = isset($_GET['table']) ? $_GET['table'] : '';
$Id = isset($_GET['Id']) ? $_GET['Id'] : '';
if ($action === 'Create' ){
    header("Location: ../view/front/create.php?table=$table&Id=$Id");
} elseif ($action === 'Delete' ){
    header("Location: ../view/front/delete.php?table=$table&Id=$Id");
}elseif ($action === 'Modify' ){
    header("Location: ../view/front/modify.php?table=$table&Id=$Id");
}
?>
