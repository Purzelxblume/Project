<nav id="site-nav">
  <ul class="nav nav-pills">
	<li role="presentation"><a href="index.php">Home</a></li>
    <?php

    if ( hasRights(100) )
    {
    	?>
    	<li role="presentation"><a href="admin.php">Admin</a></li>
    	<li role="presentation"><a href="logout.php">Log out</a></li>
		<?php
    }
    else
    {
    	?>
    	<li role="presentation"><a href="login.php">Login</a></li>
    	<?php
    }

    ?>
  </ul>
</nav>