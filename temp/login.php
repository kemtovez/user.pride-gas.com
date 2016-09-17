<?php if (empty($_SESSION['id'])) { ?>
login
<?php } else { 	 header('Location: ../home'); 	 };