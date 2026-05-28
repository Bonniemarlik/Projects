<?php
require_once 'db_connect.php';

$message = "";

// Check if the form was submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);

    if (!empty($name) && !empty($email)) {
        // Securely insert data using Prepared Statements
        $stmt = $pdo->prepare("INSERT INTO submissions (name, email) VALUES (?, ?)");
        
        if ($stmt->execute([$name, $email])) {
            // Redirect using URL parameters to avoid using session cookies
            header("Location: index.php?status=success");
            exit;
        }
    } else {
        $message = "Please fill in all fields.";
    }
}

// Read status directly from the URL query parameters
if (isset($_GET['status']) && $_GET['status'] == 'success') {
    $message = "Data successfully sent and stored in the database!";
}

// Fetch the saved data from the database to display it dynamically on the page
$stmt = $pdo->query("SELECT * FROM submissions ORDER BY id DESC");
$rows = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Project Submission</title>
    <style>
        body { color: #b3990aff;; font-family: Arial, sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container {max-width: 700px; background: rgba(11, 20, 62, 1); padding: 20px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        input[type="text"], input[type="email"] { width: 100%; padding: 10px; margin: 10px 0; box-sizing: border-box; }
        input[type="submit"] { background-color: #064646ff; color: white; padding: 10px 15px; border: none; cursor: pointer; }
        .alert { padding: 10px; background-color: #64c37aff; color: #155724; margin-bottom: 20px; border-radius: 4px; }
        table { width: 100%; margin-top: 20px; border-collapse: collapse; }
        table, th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        button{background-color: rgba(11, 54, 63, 1);color:white;max-width:20px;}
    </style>
</head>
<body>

<div class="container">
    <h2>STUDENT DETAILS</h2>
    
    <?php if (!empty($message)): ?>
        <div class="alert"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>


    <form action="index.php" method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>

        <label>Email Address:</label>
        <input type="email" name="email" required>
        <label>Password</label>
        <br>
        <input type="password"></input>

        <br>
        <br>

        <input type="submit" value="Submit"> 
        
    </form>
    <br>

   

    
</div>

</body>
</html>