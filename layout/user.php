<?php
    if (!isset($_SESSION['user'])){     //se não está definido o session user
        return;
    }

?>


<div class="bg-dark text-white text-right p-2">
    <?php echo $_SESSION['user'] ?> |<a href="?p=logout"> LOGOUT </a>
</div>