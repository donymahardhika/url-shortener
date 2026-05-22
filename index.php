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

session_start();
if (!isset($_SESSION['logged_in'])) {
    header("Location: login.php");
    exit();
}
require_once 'config.php';

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

require_once 'config.php';
require_once 'libs/phpqrcode/qrlib.php';

$message = "";
$short_url_result = "";
$qr_image_path = "";

// SAVING
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // 1. Honeypot Protection (If the ‘phone’ field is filled in, it means it's a bot)
    if (!empty($_POST['phone'])) {
        die("Bot detected.");
    }

    $long_url = mysqli_real_escape_string($conn, $_POST['long_url']);
    $short_code = mysqli_real_escape_string($conn, str_replace(' ', '', $_POST['short_code']));

    // URL Validation
    if (!filter_var($long_url, FILTER_VALIDATE_URL)) {
        $message = "<span class='text-red-500'>Invalid URL! Please make sure to use http:// or https://</span>";
    } else {
        // 2. Check Name Availability in the Database
        $check = mysqli_query($conn, "SELECT id FROM urls WHERE short_code = '$short_code'");
        if (mysqli_num_rows($check) > 0) {
            $message = "<span class='text-red-500'>Sorry, name '$short_code' already use.</span>";
        } else {
        // 3. Save to Database
        $query = "INSERT INTO urls (long_url, short_code) VALUES ('$long_url', '$short_code')";
        if (mysqli_query($conn, $query)) {

            // short link result
            $short_url_result = "https://your-domain" . $short_code;

            // Create a QR folder if one doesn't already exist
            if (!is_dir('qrcodes')) {
               mkdir('qrcodes', 0755, true);
            }

            // file name of QR
            $qr_image_path = "qrcodes/" . $short_code . ".png";

            // generate QR
            QRcode::png($short_url_result, $qr_image_path, QR_ECLEVEL_H, 8);

            // location of logo
            $logo = 'assets/your-logo.png';

            if (file_exists($logo)) {

                // load QR
                $QR = imagecreatefrompng($qr_image_path);

                // load logo
                $logoImage = imagecreatefrompng($logo);

                // QR size
                $QR_width = imagesx($QR);
                $QR_height = imagesy($QR);

                // logo size
                $logo_width = imagesx($logoImage);
                $logo_height = imagesy($logoImage);

                // final logo size
                $logo_qr_width = $QR_width / 4;
                $scale = $logo_width / $logo_qr_width;
                $logo_qr_height = $logo_height / $scale;

                // center position
                $from_width = ($QR_width - $logo_qr_width) / 2;

                // logo integration
                imagecopyresampled(
                    $QR,
                    $logoImage,
                    $from_width,
                    $from_width,
                    0,
                    0,
                    $logo_qr_width,
                    $logo_qr_height,
                    $logo_width,
                    $logo_height
                );

                // save the QR code again
                imagepng($QR, $qr_image_path);

                // clear memory
                imagedestroy($QR);
                imagedestroy($logoImage);
            }

            // save path to database
            mysqli_query($conn, "UPDATE urls SET qr_path='$qr_image_path' WHERE short_code='$short_code'");
            } else {
                    $message = "<span class='text-red-500'>A database error has occurred.</span>";
            }
        }
    }
}

// --- PAGINATION ---
$limit = 5;
$page = isset($_GET['p']) ? (int)$_GET['p'] : 1;
$offset = ($page > 1) ? ($page * $limit) - $limit : 0;

// Count the total data to determine the number of pages
$total_results = mysqli_query($conn, "SELECT COUNT(*) AS total FROM urls");
$total_data = mysqli_fetch_assoc($total_results)['total'];
$total_pages = ceil($total_data / $limit);

// Retrieve data using LIMIT
$res = mysqli_query($conn, "SELECT * FROM urls ORDER BY created_at DESC LIMIT $offset, $limit");

?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Name - URL Shortener</title>
    <meta name="description" content="Your website description">
    <meta name="keywords" content="your keyword, separated by commas">
    <link rel="shortcut icon" href="assets/favicon.png">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .honeypot { display: none; } /* Hide the bot-trapping field */
    </style>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-200">
        <h1 class="text-2xl font-bold text-center text-blue-600 mb-2">Your-Name SHORTENER</h1>
        <p class="text-gray-500 text-center text-sm mb-6">Create Custom Short Links Easily</p>
        
        <div class="flex justify-between items-center mb-6 bg-gray-50 p-3 rounded-xl border border-gray-100">
            <p class="text-sm text-gray-600">Halo, <span class="font-bold text-gray-800"><?= $_SESSION['username'] ?></span></p>
            <a href="?logout=true" class="text-xs bg-red-500 text-white px-4 py-2 rounded-lg font-bold hover:bg-red-600 transition shadow-md shadow-red-100">Logout</a>
        </div>
        
        <?php if ($short_url_result): ?>
            <!-- RESULT UI -->
            <div class="bg-green-50 p-4 rounded-lg border border-green-200 text-center">
                <p class="text-green-700 font-semibold mb-2">Success! This is your link:</p>
                <input type="text" id="resultLink" value="<?php echo $short_url_result; ?>" readonly 
                       class="w-full p-2 border rounded bg-white text-center font-mono text-blue-600">
                <?php if (!empty($qr_image_path)): ?>
                        <div class="mt-4 text-center">
                        <img 
                        src="<?php echo $qr_image_path; ?>"
                        alt="QR Code"
                        class="mx-auto w-40 h-40 border rounded-lg shadow">
            </div>
        <?php endif; ?>
                
                <div class="mt-4 flex gap-2">
                    <button onclick="copyToClipboard()" class="flex-1 bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition">Copy</button>
                    <a href="index.php" class="flex-1 bg-gray-200 text-gray-700 py-2 rounded-lg text-center hover:bg-gray-300">More</a>
                </div>
            </div>
        <?php else: ?>
            <!-- FORM UI -->
            <form action="" method="POST" id="shortenForm">
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Long URL</label>
                    <input type="url" name="long_url" required placeholder="https://example.com/very-long-url"
                           class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-400 outline-none">
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Custom Name (case sensitive)</label>
                    <div class="flex items-center border rounded-lg overflow-hidden focus-within:ring-2 focus-within:ring-blue-400">
                        <span class="bg-gray-100 px-3 py-3 text-gray-500 border-r text-sm">your-domain/</span>
                        <input type="text" name="short_code" id="short_code" required placeholder="Example: Xyz"
                               class="w-full p-3 outline-none">
                    </div>
                    <div id="availability_status" class="text-xs mt-1"></div>
                </div>

                <!-- Field Honeypot -->
                <input type="text" name="phone" class="honeypot" tabindex="-1" autocomplete="off">

                <button type="submit" id="btnSubmit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-bold hover:bg-blue-700 transition shadow-lg shadow-blue-200">
                    SHORT
                </button>
                <div class="mt-3 text-center text-sm"><?php echo $message; ?></div>
            </form>

            <div class="mt-10 bg-white p-6 rounded-xl shadow-inner border border-gray-100">
                <!-- <h2 class="text-lg font-bold mb-4 text-gray-800">List of Short URL</h2> -->
    
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                            <tr>
                                <th class="px-3 py-3 text-center">Short & QR</th>
                                <th class="px-3 py-3 text-center">Click</th>
                                <th class="px-3 py-3 text-center">Long</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <?php if (mysqli_num_rows($res) > 0): ?>
                                <?php while($row = mysqli_fetch_assoc($res)): ?>
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-3 py-3 font-medium text-blue-600 truncate max-w-[150px]">
                                        <button onclick="openQRModal('<?php echo $row['qr_path']; ?>', '<?php echo $row['short_code']; ?>')"
                                                class="bg-blue-50 hover:bg-blue-100 px-2 py-1 rounded transition" title="Click to view QR">/<?= $row['short_code'] ?>
                                        </button>
                                    </td>
                                    <td class="px-3 py-3 text-center">
                                        <span class="font-bold text-gray-700"><?= $row['clicks'] ?></span>
                                    </td>
                                    <td class="px-3 py-3 truncate max-w-[120px]">
                                        <a href="<?= $row['long_url'] ?>" target="_blank" class="hover:underline text-gray-400 italic">
                                            <?= $row['long_url'] ?>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr><td colspan="3" class="text-center py-4">No data available.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

                <!-- Paging Navigation -->
                <?php if ($total_pages > 1): ?>
                <div class="mt-6 flex justify-center gap-2">
                    <?php if($page > 1): ?>
                        <a href="?p=<?= $page - 1 ?>" class="px-3 py-1 bg-white border rounded shadow-sm hover:bg-gray-50 text-gray-600 text-sm">&laquo; Prev</a>
                    <?php endif; ?>

                    <?php for($i = 1; $i <= $total_pages; $i++): ?>
                        <a href="?p=<?= $i ?>" class="px-3 py-1 border rounded text-sm <?= ($i == $page) ? 'bg-blue-600 text-white border-blue-600' : 'bg-white text-gray-600 hover:bg-gray-50' ?>">
                            <?= $i ?>
                        </a>
                    <?php endfor; ?>

                    <?php if($page < $total_pages): ?>
                        <a href="?p=<?= $page + 1 ?>" class="px-3 py-1 bg-white border rounded shadow-sm hover:bg-gray-50 text-gray-600 text-sm">Next &raquo;</a>
                    <?php endif; ?>
                </div>
                <p class="text-center text-xs text-gray-400 mt-3">Page <?= $page ?> of <?= $total_pages ?> (Total: <?= $total_data ?> link)</p>
                <?php endif; ?>
            </div>
 
        <?php endif; ?>
    </div>

<!-- QR MODAL -->
<div id="qrModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white p-6 rounded-2xl shadow-2xl w-80">
        <h3 id="modalTitle" class="text-lg font-bold text-center mb-4">QR Code</h3>
        <img id="modalQRImage" src="" class="mx-auto w-48 h-48 border rounded-lg">
        <div class="mt-5 flex gap-2">
            <a id="downloadQR" href="" download class="flex-1 bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700">Download</a>
            <button onclick="closeQRModal()" class="flex-1 bg-gray-200 py-2 rounded-lg hover:bg-gray-300">Close</button>
        </div>
    </div>
</div>    

<script>
    // Real-time name check feature with AJAX
    $(document).ready(function() {
        $('#short_code').on('keyup', function() {
            var code = $(this).val();
            if(code.length > 0) {
                $.ajax({
                    url: 'check_availability.php',
                    type: 'POST',
                    data: {short_code: code},
                    success: function(response) {
                        if(response == "available") {
                            $('#availability_status').html('<span class="text-green-600">✅ Names are available.</span>');
                            $('#btnSubmit').prop('disabled', false).removeClass('opacity-50');
                        } else {
                            $('#availability_status').html('<span class="text-red-600">❌ That name is already in use.</span>');
                            $('#btnSubmit').prop('disabled', true).addClass('opacity-50');
                        }
                    }
                });
            } else {
                $('#availability_status').html('');
            }
        });
    });

    function copyToClipboard() {
        var copyText = document.getElementById("resultLink");
        copyText.select();
        document.execCommand("copy");
        alert("The link has been copied!");
    }

    function openQRModal(qrPath, shortCode) {
        document.getElementById("modalQRImage").src = qrPath;
        document.getElementById("downloadQR").href = qrPath;
        document.getElementById("modalTitle").innerHTML ="QR /" + shortCode;
        document.getElementById("qrModal")
            .classList.remove("hidden");
    }

    function closeQRModal() {
        document.getElementById("qrModal")
            .classList.add("hidden");
    }

</script>
</body>
</html>