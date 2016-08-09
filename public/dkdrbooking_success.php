<?php
session_start();

if (isset($_SESSION['payam'])) {
    echo '<div>';
    echo '<h3><p>' . $_SESSION['payam'] . ' </p></h3>';
    echo '</div>';
}

if (isset($_SESSION['yourTrackCode']) && isset($_SESSION['dkdrname'])
    && isset($_SESSION['dkdrfamily']) && isset($_SESSION['dkdrMobile'])
    && isset($_SESSION['dktell']) && isset($_SESSION['dkdrWherecome']) && $_SESSION['dkdrwhenCome'] &&
    isset($_SESSION['dkdrSelector']) && isset($_SESSION['dkdrDate']) && isset($_SESSION['dkdrTurn'])
) {
    echo '<div id="dkdrShowInformation">';
    echo '<p id="dkdrTrackCode">' . $_SESSION['yourTrackCode'] . '</p>';
    echo '<p id="dkdrTurn">' . $_SESSION['dkdrTurn'] . '</p>';
    echo '<p id="dkdrNameFamily">' . $_SESSION['dkdrname'] . " " . $_SESSION['dkdrfamily'];
    '</p>';
    echo '<p id="dkdrwhereFrom">' . $_SESSION['dkdrWherecome'] . '</p>';
    echo '<p id="dkdrWhenFrom">' . $_SESSION['dkdrwhenCome'] . '</p>';
    echo '<p id="dkdrTell">' . $_SESSION['dktell'] . '</p>';
    echo '<p id="dkdrMobile">' . $_SESSION['dkdrMobile'] . '</p>';
    echo '<p id="dkdrSelector">' . $_SESSION['dkdrSelector'] . '</p>';
    echo '<p id="dkdrDate">' . $_SESSION['dkdrDate'] . '</p>';

    echo '</div>';
}
session_destroy();

