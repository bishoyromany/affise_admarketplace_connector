<?php 
    require_once __DIR__.'/../DB.php';
    $db = new DB();
    $prefix = $db->getPrefix();
    $totalRecords = (int)$db->query("SELECT COUNT(*) as total FROM `".$prefix."adm`")[0]['total'];
    $pages = ceil($totalRecords / $perpage);
    $where = '';
    if(!empty($search)){
        $where = "WHERE `sub1` LIKE '%$search%' OR `sub2` LIKE '%$search%' OR `sub1Fake` LIKE '%$search%' OR `ad_id` LIKE '%$search%' OR `name` LIKE '%$search%'";
    }
    $data = $db->query("SELECT * FROM `".$prefix."adm` $where ORDER BY `id` DESC LIMIT ".$offset.",".$perpage."");
?>

<h2 class="text-center">Manage Admarketplace Offers</h2>

<form action="<?php echo $base; ?>/backend/show.php?target=<?php echo $target; ?>&perpage=<?php echo $perpage; ?>&offset=<?php echo $x * $perpage; ?>" method="GET">
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
            <th scope="col">Sub1</th>
            <th scope="col">Sub2</th>
            <th scope="col">Sub1 Fake</th>
            <th scope="col">AD ID</th>
            <th scope="col">Name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $d): ?>
            <tr>
                <td><?php echo $d['id']; ?></td>
                <td><?php echo $d['sub1']; ?></td>
                <td><?php echo $d['sub2']; ?></td>
                <td><?php echo $d['sub1Fake']; ?></td>
                <td><?php echo $d['ad_id']; ?></td>
                <td><?php echo $d['name']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<nav aria-label="Page navigation example" style="float:right; clear:both;">
  <ul class="pagination">
    <?php for($x = 0; $x < $pages; $x++): ?>
        <li class="page-item <?php echo $x == $currentPage ? 'active' : ''; ?>"><a class="page-link" 
        href="<?php echo $base; ?>/backend/show.php?target=<?php echo $target; ?>&search=<?php echo $search ?>&perpage=<?php echo $perpage; ?>&offset=<?php echo $x * $perpage; ?>"
        ><?php echo $x+1; ?></a></li>
    <?php endfor; ?>
  </ul>
</nav>