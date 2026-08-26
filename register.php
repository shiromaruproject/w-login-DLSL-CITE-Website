<?php
session_start();
require 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_number = $_POST['student_number'];
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $middle_name = $_POST['middle_name'];
    $program = $_POST['program_of_study'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (student_number, last_name, first_name, middle_name, program_of_study, email, password) 
            VALUES (?, ?, ?, ?, ?, ?, ?)";
            
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("sssssss", $student_number, $last_name, $first_name, $middle_name, $program, $email, $password);
        if ($stmt->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Registration failed. Email or Student Number might already be taken.";
        }
        $stmt->close();
    } else {
        $error = "Database error.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - De La Salle Lipa CITE</title>
    <link rel="stylesheet" href="assets/css/nav-auth.css">
    <style>
        :root {
            --dlsl-green: #1b5e20;
            --dlsl-light-green: #2ea84b;
            --dlsl-red: #d82f3a;
            --text-dark: #333333;
            --bg-light: #f9f9f9;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            color: var(--text-dark);
            background-color: var(--bg-light);
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        *, *:before, *:after {
            box-sizing: inherit;
        }

        /* Navigation Bar */
        nav {
            position: fixed;
            top: 0;
            width: 100%;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 50px;
            height: 70px;
        }

        nav .logo {
            font-weight: 800;
            font-size: 22px;
            color: var(--dlsl-green);
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 25px;
            margin: 0;
            padding: 0;
            align-items: center;
        }

        nav ul li a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 700;
            font-size: 14px;
            text-transform: uppercase;
            transition: color 0.3s ease;
            padding: 8px 5px;
        }

        nav ul li a:hover {
            color: var(--dlsl-green);
        }
        
        nav ul li a.apply-btn {
            background-color: var(--dlsl-green);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }

        /* Form Container */
        .form-wrapper {
            margin-top: 100px;
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        .form-container h2 {
            color: var(--dlsl-green);
            margin-top: 0;
            margin-bottom: 20px;
            text-align: center;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: 600;
            font-size: 14px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: inherit;
            font-size: 15px;
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: var(--dlsl-green);
            box-shadow: 0 0 5px rgba(27, 94, 32, 0.2);
        }

        .submit-btn {
            width: 100%;
            padding: 12px;
            background-color: var(--dlsl-green);
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .submit-btn:hover {
            background-color: #124016;
        }

        .error-message {
            color: var(--dlsl-red);
            margin-bottom: 15px;
            text-align: center;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .text-center a {
            color: var(--dlsl-green);
            text-decoration: none;
            font-weight: bold;
        }

        .text-center a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <?php $activeNav = 'register'; include 'includes/nav.php'; ?>

    <div class="form-wrapper">
        <div class="form-container">
            <h2>Create an Account</h2>
            
            <?php if (!empty($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="register.php">
                <div class="form-group">
                    <label>Student Number</label>
                    <input type="text" name="student_number" required placeholder="e.g. 123456789">
                </div>

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="first_name" required>
                </div>

                <div class="form-group">
                    <label>Middle Name</label>
                    <input type="text" name="middle_name">
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="last_name" required>
                </div>

                <div class="form-group">
                    <label>Program of Study</label>
                    <select name="program_of_study" required>
                        <option value="" disabled selected>Select your program</option>
                        <option value="BSIT">BS Information Technology</option>
                        <option value="BSCPE">BS Computer Engineering</option>
                        <option value="BSArch">BS Architecture</option>
                        <option value="BSElec">BS Electrical Engineering</option>
                        <option value="BSCS">BS Computer Science</option>
                        <option value="BSIE">BS Industrial Engineering</option>
                        <option value="BSECE">BS Electronics Engineering</option>
                        <option value="BSCE">BS Civil Engineering</option>
                        <option value="BSME">BS Mechanical Engineering</option>
                        <option value="BSEMC">BS Entertainment and Multimedia Computing</option>
                        <option value="ACT">Associate in Computer Technology</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required placeholder="example@dlsl.edu.ph">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit" class="submit-btn">Register</button>
            </form>

            <div class="text-center">
                Already have an account? <a href="login.php">Login here</a>
            </div>
        </div>
    </div>

    <script src="assets/js/nav-auth.js"></script>

</body>
</html>
