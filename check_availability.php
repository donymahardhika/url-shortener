<?php
/* URL SHORTENER USING PHP & MYSQL with msqli
 * Created by : Dony Mahardhika (@donymahardhika)
 * Published on : 20/05/2026
 * Library : phpqrcode
 *
 * Everything contained in this project may be used freely,
 * whether for personal or commercial purposes.
 * Feel free to develop it further and send it back to my GitHub
 * so that more people can benefit from it.
 *
 */

require_once 'config.php';

if (isset($_POST['short_code'])) {
    $short_code = mysqli_real_escape_string($conn, $_POST['short_code']);
    
    $query = "SELECT id FROM urls WHERE short_code = '$short_code'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        echo "taken";
    } else {
        echo "available";
    }
}
?>