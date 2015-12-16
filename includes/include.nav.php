<nav id="site-nav">
  <ul class="nav nav-pills">
    <?php

    if ( getRights() == 100 )
    {
    	?>
    	<li role="presentation"><a href="/stov/fotographer/index.php">Home</a></li>
    	<li role="presentation"><a href="/stov/logout.php">Log out</a></li>
		<?php
    }
    elseif( getRights() == 101 ){
    	?>
    	<li role="presentation"><a href="/stov/customer/index.php">Home</a></li>
    	<li role="presentation"><a href="/stov/logout.php">Log out</a></li>
		<?php
    }
    	?>
  </ul>
</nav>
