<?php
    session_start();
    session_unset();
    session_destroy();

    // Logging out of profile page
    header("location: ../index.php?error=none");
?>