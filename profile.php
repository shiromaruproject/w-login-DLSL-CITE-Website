<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - De La Salle Lipa CITE</title>
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

        nav ul li a.logout-btn {
            background-color: var(--dlsl-red);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }

        /* Profile Container */
        .profile-wrapper {
            margin-top: 100px;
            flex-grow: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .profile-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 6px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        .profile-container h2 {
            color: var(--dlsl-green);
            margin-top: 0;
            margin-bottom: 30px;
            text-align: center;
            font-size: 28px;
            border-bottom: 2px solid var(--dlsl-green);
            padding-bottom: 10px;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .info-label {
            font-weight: bold;
            color: #555;
        }

        .info-value {
            color: var(--text-dark);
            text-align: right;
            font-weight: 500;
        }

        .btn-container {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .home-btn {
            background-color: var(--dlsl-green);
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .home-btn:hover {
            background-color: #124016;
        }
    </style>
</head>
<body>

    <?php include 'includes/nav.php'; ?>

    <div class="profile-wrapper">
        <div class="profile-container">
            <h2>User Profile</h2>
            
            <div class="profile-info">
                <div class="info-row">
                    <span class="info-label">Name:</span>
                    <span class="info-value"><?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Student Number:</span>
                    <span class="info-value"><?php echo htmlspecialchars($_SESSION['student_number']); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Program of Study:</span>
                    <span class="info-value"><?php echo htmlspecialchars($_SESSION['program']); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email Address:</span>
                    <span class="info-value"><?php echo htmlspecialchars($_SESSION['email']); ?></span>
                </div>
            </div>

            <div class="btn-container">
                <a href="index.php" class="home-btn">Go to Home Page</a>
            </div>
        </div>
    </div>

    <script src="assets/js/nav-auth.js"></script>

</body>
</html>
