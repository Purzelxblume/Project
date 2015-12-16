<nav id="site-nav">
  <ul class="nav nav-pills">
	<li role="presentation"><a href="index.php">Home</a></li>
    <?php

    if ( hasRights(100) )
    {
    	?>
    	<li role="presentation"><a href="/stov/fotographer/index.php">Home</a></li>
    	<li role="presentation"><a href="/stov/logout.php">Log out</a></li>
		<?php
    }
    elseif( hasRights(101) ){
    	?>
    	<li role="presentation"><a href="/stov/customer/index.php">Home</a></li>
    	<li role="presentation"><a href="/stov/logout.php">Log out</a></li>
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
