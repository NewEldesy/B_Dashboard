<?php
    addLog($_SESSION["id"], "logout");
    session_destroy();
    header('location: /_Projects/B_Dashboard/');
    exit;