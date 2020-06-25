<?php 
    $target = isset($_GET['taget']) ? $_GET['target'] : 'affise';
    $perpage = isset($_GET['perpage']) ? (int)$_GET['perpage'] :20;
    $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;
    $currentPage = $offset == 0 ? 0 : ceil($offset / $perpage);
    $search = isset($_GET['search']) ? filter_var($_GET['search'], FILTER_SANITIZE_STRING) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php if($target == 'adm'){ echo "Show Admarketplace Ads"; }else{ echo "Show Affise Offers"; } ?>
    </title>
    <style>
        #data{
            margin-top : 80px;
        }
    </style>
</head>
<body>
    <?php require_once __DIR__.'/navbar.php'; ?>
    <?php if(isLogged()): ?>
    <div id="data">
        <div class="container">
            <?php 
                if($target == 'adm'){
                    require_once __DIR__."/manage/adm.php";
                }else{
                    require_once __DIR__."/manage/affise.php";
                }
            ?>
        </div>
    </div>
    <?php else: ?>
        <div class="alert alert-warning">You are not allowed to view this page</div>
    <?php endif; ?>
    
    <?php require_once __DIR__.'/../boostrap.html'; ?>
</body>
</html>