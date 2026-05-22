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

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'short';

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>