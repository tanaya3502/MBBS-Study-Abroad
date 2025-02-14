<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo"<center><H1>";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $country = htmlspecialchars($_POST["country"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format");
    }

    if (!preg_match("/^[0-9]{10}$/", $phone)) {
        die("Invalid phone number");
    }

    // Save data to a JSON file
    $data = [
        "name" => $name,
        "email" => $email,
        "phone" => $phone,
        "country" => $country,
        "timestamp" => date("Y-m-d H:i:s")
    ];

    $file = 'submissions.json';

    if (file_exists($file)) {
        $current_data = json_decode(file_get_contents($file), true);
    } else {
        $current_data = [];
    }

    $current_data[] = $data;
    file_put_contents($file, json_encode($current_data, JSON_PRETTY_PRINT));

    echo "Application submitted successfully!";
} else {
    echo "Invalid request method.";
}
 
echo"<br><br><button><a href=\"index.html\">Go Back</a></button>";
echo"</center></H1>";
?>
