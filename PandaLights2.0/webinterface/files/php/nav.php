<nav class="navbar navbar-expand-lg navbar-<?php echo ThemeCheck(); ?> bg-<?php echo ThemeCheck(); ?> nav-style">
  <a class="navbar-brand" href="#">
    <img src="/files/img/panda.png" width="30" height="30" class="d-inline-block align-top" alt="">
    Panda - <?php echo $page; ?>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <?php
      //check for active page
      $a_home = $a_settings = $a_profiles = "";
      $a = 'active';
      switch ($page) {
        case 'Home':
          $a_home = $a;
          break;
        case 'Profiles':
          $a_profiles = $a;
          break;
        case 'Settings':
          $a_settings = $a;
          break;
      }
     ?>
    <ul class="navbar-nav">
      <li class="nav-item <?php echo $a_home; ?>">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item <?php echo $a_profiles; ?>">
        <a class="nav-link" href="/profiles">Profiles</a>
      </li>
      <li class="nav-item <?php echo $a_settings; ?>">
        <a class="nav-link" href="/settings">Settings</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/toggle/index.php?page=<?php echo $page; ?>"><?php echo LightsList(); ?></a>
      </li>
    </ul>
  </div>
</nav>
