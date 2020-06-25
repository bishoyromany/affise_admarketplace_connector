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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
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

    
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>