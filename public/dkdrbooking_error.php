<?php
session_start();
if (isset($_SESSION['payam'])) {
    echo'<p> khata is : ' . $_SESSION['payam'] . '</p>';

} else {

    echo '<p>خطا </p>';
}
session_destroy();
