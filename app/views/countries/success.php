<?php
    // includes header
    require APPROOT . '/views/includes/head_succes.php';


    // echo "<div class='alert alert-success' role='alert'> Country was created succesfully </div>";exit();
    echo $data["message"];
    header("Refresh:2.5; url=" . URLROOT . "/Countries/index");



    // includes footer
    require APPROOT . '/views/includes/footer.php';
?> 