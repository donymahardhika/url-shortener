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

if (isset($_GET['code'])) {
    $code = mysqli_real_escape_string($conn, $_GET['code']);
    
    // Find the original URL and update the number of clicks
    $query = "SELECT long_url FROM urls WHERE short_code = '$code'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Increase the number of clicks
        mysqli_query($conn, "UPDATE urls SET clicks = clicks + 1 WHERE short_code = '$code'");
        
        header("Location: " . $row['long_url']);
        exit();
    }
}

// If the code is missing or cannot be found, return to the home page
header("Location: index.php");
exit();