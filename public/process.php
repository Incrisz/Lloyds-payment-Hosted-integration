<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    echo "<h2>Form Submission Data</h2>";
    echo "<pre>";
    print_r($_POST);  // or use var_dump($_POST) for more detailed output
    echo "</pre>";
} else {
    echo "No form submission detected.";
}
?>