<?php 
    require_once __DIR__.'/../backend/DB.php';
    $db = new DB();
    $prefix = $db->getPrefix();
    $target = isset($_GET['taget']) ? $_GET['target'] : 'users';
    $action = isset($_GET['action']) ? $_GET['action'] : false;
    $id = isset($_GET['id']) ? $_GET['id'] : false;
    if($action && $id){
        if($action == 'deactive'){
            $query = $db->query("UPDATE`".$prefix."users` SET `isActive` = 0 WHERE `id` = $id");
        }elseif($action == 'active'){
            $query = $db->query("UPDATE`".$prefix."users` SET `isActive` = 1 WHERE `id` = $id");
        }
    }
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
        Manage Users
    </title>
    <style>
        #data{
            margin-top : 80px;
        }
    </style>
</head>
<body>
    <?php require_once __DIR__.'/../backend/navbar.php'; ?>

    <?php if(isLogged()): ?>
    <div id="data">
        <div class="container">
            <?php 
                $totalRecords = (int)$db->query("SELECT COUNT(*) as total FROM `".$prefix."users`")[0]['total'];
                $pages = ceil($totalRecords / $perpage);
                $where = '';
                if(!empty($search)){
                    $where = "WHERE `firstname` LIKE '%$search%' OR `lastname` LIKE '%$search%' OR `email` LIKE '%$search%'";
                }
                $data = $db->query("SELECT * FROM `".$prefix."users` $where ORDER BY `id` DESC LIMIT ".$offset.",".$perpage."");
            ?>

            <h2 class="text-center">Manage Admarketplace Offers</h2>

            <form action="<?php echo $base; ?>/user/users.php?target=<?php echo $target; ?>&perpage=<?php echo $perpage; ?>" method="GET">
                <div class="row">
                    <div class="col-md-10">
                        <input type="text" class="form-control" id="search" value="<?php echo $search; ?>" name="search" placeholder="Search Records">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-success btn-block">Submit</button>
                    </div>
                </div>
                <input type="hidden" name="target" value="<?php echo $target; ?>">
            </form>

            <table class="table table-hover table-dark table-bordered">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $d): ?>
                        <tr>
                            <td><?php echo $d['id']; ?></td>
                            <td><?php echo $d['firstname']; ?></td>
                            <td><?php echo $d['lastname']; ?></td>
                            <td><?php echo $d['email']; ?></td>
                            <td>
                                <?php if($d['isActive']): ?>
                                    <a href="<?php echo $base; ?>/user/users.php?target=<?php echo $target; ?>&id=<?php echo $d['id']; ?>&perpage=<?php echo $perpage; ?>&action=deactive" class="btn btn-warning">Deactivate</a>
                                <?php else: ?>
                                    <a href="<?php echo $base; ?>/user/users.php?target=<?php echo $target; ?>&id=<?php echo $d['id']; ?>&perpage=<?php echo $perpage; ?>&action=active" class="btn btn-success">Activate</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <nav aria-label="Page navigation example" style="float:right; clear:both;">
            <ul class="pagination">
                <?php for($x = 0; $x < $pages; $x++): ?>
                    <li class="page-item <?php echo $x == $currentPage ? 'active' : ''; ?>"><a class="page-link" 
                    href="<?php echo $base; ?>/user/users.php?target=<?php echo $target; ?>&search=<?php echo $search ?>&perpage=<?php echo $perpage; ?>&offset=<?php echo $x * $perpage; ?>"
                    ><?php echo $x+1; ?></a></li>
                <?php endfor; ?>
            </ul>
            </nav>
        </div>
    </div>
    <?php else: ?>
        <div class="alert alert-warning">You are not allowed to view this page</div>
    <?php endif; ?>
    
    <?php require_once __DIR__.'/../boostrap.html'; ?>
</body>
</html>