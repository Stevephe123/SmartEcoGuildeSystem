<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management Page</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <!-- Layout CSS -->
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        .page-container {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header, footer {
            background-color: #f3f3f3;
            padding: 15px 30px;
            text-align: center;
        }

        .main-body {
            flex: 1;
            display: flex;
        }

        .sidebar {
            width: 220px;
            background-color: #eaeaea;
            padding: 20px;
            display: flex;
            flex-direction: column;
        }

        .sidebar h2 {
            font-size: 20px;
            margin-bottom: 15px;
        }

        .sidebar button {
            background-color: transparent;
            border: none;
            text-align: left;
            padding: 10px;
            margin-bottom: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.2s;
        }

        .sidebar button:hover {
            background-color: #d5d5d5;
            border-radius: 5px;
        }

        .main-content {
            flex: 1;
            padding: 30px;
            background-color: #ffffff;
        }

        .dashboard-cards {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 8px;
            text-align: center;
            flex: 1;
        }

        .card h2 {
            margin: 0;
            font-size: 32px;
        }

        .card p {
            margin: 5px 0 0;
            color: #555;
        }

        .actions, .notifications {
            background-color: #f7f7f7;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .actions button {
            display: block;
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            border: none;
            background-color: #333;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .actions button:hover {
            background-color: #555;
        }

        .notifications {
            margin-top: 30px;
        }
    </style>
</head>

<body>
    <div class="page-container">
        <!-- Header -->
        <?php include 'header.php'; ?>

        <!-- Main Layout -->
        <div class="main-body">
            <!-- Sidebar -->
            <div class="sidebar">
                <h2>Dashboard</h2>
                <button onclick="location.href='dashboard.php'">🏠 Dashboard</button>
                <button onclick="location.href='guides.php'">🧭 Park Guides</button>
                <button onclick="location.href='trainings.php'">📚 Trainings</button>
                <button onclick="location.href='certifications.php'">📄 Certifications</button>
                <button onclick="location.href='ai_performance.php'">🤖 AI & Performance</button>
                <button onclick="location.href='biodiversity.php'">🌿 Biodiversity DB</button>
                <button onclick="location.href='iot.php'">📡 IoT Monitoring</button>
                <button onclick="location.href='cms.php'">🌐 CMS / Public Site</button>
                <button onclick="location.href='security.php'">🔐 Security & Settings</button>
            </div>

            <!-- Content Area -->
            <div class="main-content">
                <!-- Dashboard Cards -->
                <div class="dashboard-cards">
                    <div class="card">
                        <h2>120</h2>
                        <p>Total Guides</p>
                    </div>
                    <div class="card">
                        <h2>3</h2>
                        <p>Upcoming Trainings</p>
                    </div>
                    <div class="card">
                        <h2>5</h2>
                        <p>Expiring Certs</p>
                    </div>
                    <div class="card">
                        <h2>★</h2>
                        <p>Average Rating</p>
                    </div>
                </div>

                <!-- Actions -->
                <div class="actions">
                    <button>+ Add Guide</button>
                    <button>View Feedback</button>
                </div>

                <!-- Notifications -->
                <div class="notifications">
                    <h3>Notifications</h3>
                    <p>• New training available next week.</p>
                    <p>• Some certifications are expiring soon.</p>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </div>
</body>
</html>
