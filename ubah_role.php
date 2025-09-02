<?php
include "config.php";

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $newRole = ($_POST['role'] === 'yes') ? 'yes' : 'no';

    $sql = "UPDATE login SET role=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $newRole, $id);
    $stmt->execute();
}

if ($role === 'no') {
    session_unset();
    session_destroy();
    header("Location: loginAdmin.php");
    exit();
} else {
    $_SESSION['role'] = 'yes'; // update session biar sinkron
    header("Location: ruangcontrol.php");
    exit();
}


header("Location: ruangcontrol.php");
exit();
?>
