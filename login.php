<?php
session_start();
require 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            if (password_verify($password, $user['password'])) {
                // Password is correct
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['student_number'] = $user['student_number'];
                $_SESSION['program'] = $user['program_of_study'];
                
                // The prompt mentions redirecting to index.html, but the image says 
                // "a new page will display showing the profile of the user." 
                // We'll redirect to profile.php to show the profile.
                header("Location: profile.php");
                exit();
            } else {
                $error = "Invalid email or password.";
            }
        } else {
            $error = "Invalid email or password.";
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
    <title>Login - De La Salle Lipa CITE</title>
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
            max-width: 400px;
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

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-family: inherit;
            font-size: 15px;
        }

        .form-group input:focus {
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

    <!-- Navigation -->
    <nav>
        <div class="logo">DE LA SALLE LIPA</div>
        <ul>
            <li><a href="index.html#home" class="nav-link">HOME</a></li>
            <li><a href="index.html#programs" class="nav-link">PROGRAMS</a></li>
            <li><a href="index.html#activities" class="nav-link">ACTIVITIES</a></li>
            <li><a href="index.html#about" class="nav-link">ABOUT</a></li>
            <li><a href="login.php" class="nav-link" style="color: var(--dlsl-green);">LOGIN</a></li>
            <li><a href="register.php" class="nav-link">REGISTER</a></li>
            <li><a href="https://my.dlsl.edu.ph/padmission" class="apply-btn" target="_blank">APPLY NOW</a></li>
        </ul>
    </nav>

    <div class="form-wrapper">
        <div class="form-container">
            <h2>Welcome Back</h2>
            
            <?php if (!empty($error)): ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php endif; ?>

            <form method="POST" action="login.php">
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required placeholder="example@dlsl.edu.ph">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>

                <button type="submit" class="submit-btn">Login</button>
            </form>

            <div class="text-center">
                Don't have an account? <a href="register.php">Register here</a>
            </div>
        </div>
    </div>

</body>
</html>
