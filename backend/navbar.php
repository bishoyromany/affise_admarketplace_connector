<?php 
    require_once __DIR__.'/helpers.php';
    $base = getConfig('base');
    $target = isset($_GET['target']) ? $_GET['target'] : '';
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="<?php echo $base; ?>">Affise - Admarketplace Connector</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item <?php echo $target == 'affise' ? 'active' : ''; ?>">
        <a class="nav-link " href="<?php echo $base; ?>/backend/show.php?target=affise">Affise</a>
      </li>
      <li class="nav-item <?php echo $target == 'adm' ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo $base; ?>/backend/show.php?target=adm">Admarketplace</a>
      </li>
      <li class="nav-item <?php echo $target == 'config' ? 'active' : ''; ?>">
        <a class="nav-link" href="<?php echo $base; ?>/config.php?target=config">Configurations</a>
      </li>
    </ul>
  </div>
</nav>