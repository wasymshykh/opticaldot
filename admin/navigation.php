<!-- Navigation Bar-->
<nav class="navbar navbar-expand-md navbar-dark bg-maroon fixed-top">
  <a class="navbar-brand" href="portfolio.php">Optical Dot Dashboard</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto navbar-right">

      <li class="nav-item">
        <a class="nav-link<?php if(basename($_SERVER["SCRIPT_FILENAME"])=="portfolio.php"){echo ' active';} ?>" href="portfolio.php"><i class="fa fa-desktop"></i> Portfolio </a>
      </li>

      <?php

      if($permission==7){
        echo '
        <li class="nav-item">
          <a class="nav-link'.iif(basename($_SERVER["SCRIPT_FILENAME"])=="users.php"," active").'" href="users.php"><i class="fa fa-users"></i> Users</a>
        </li>
        <li class="nav-item">
          <a class="nav-link'.iif(basename($_SERVER["SCRIPT_FILENAME"])=="settings.php"," active").'" href="settings.php"><i class="fa fa-cog"></i> Settings</a>
        </li>
        ';
      }

      ?>      

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user-circle"></i> Account</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
          <?php
          if($loginStatus){
          ?>
          <a class="dropdown-item" href="logout.php">Logout</a>
          <?php
          }else{
          ?>
          <a class="dropdown-item<?php if(basename($_SERVER["SCRIPT_FILENAME"])=="login.php"){echo ' active';} ?>" href="login.php">Login</a>
          <?php
          }
          ?>          
        </div>
      </li>
    </ul>
  </div>
</nav>