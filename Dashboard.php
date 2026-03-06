<?php 
$page_title = 'Dashboard';
require('include/header.php');
require('include/navbar.php')

?>


<h1 class="title">User Dashboard <br>Access when you are logged IN !🙌</h1>
<?php if (isset($_SESSION['status'])) : ?>
    <h1 class="title"><?php echo $_SESSION['status']; ?></h1>
    <?php unset($_SESSION['status']);?>
<?php endif; ?>



<?php require('include/footer.php')?>