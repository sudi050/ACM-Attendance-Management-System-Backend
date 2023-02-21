<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header("Location: Login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="css/styles.css" />
    <title>Credits - ACM Attendance Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark">
        <div class="container">
            <a class="navbar-brand" href="./Dashboard.php">
                <img src="Images/website_logo.webp" alt="Bootstrap" width="150px" />
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="material-symbols-outlined" style="color: #fafafa;">
                    menu
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./Add_members.php">Add Members</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./All_members.php">All Members</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Attendance_history.php">Attendance History</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Credits.php">Credits</a>
                    </li>
                </ul>
                <span class="navbar-text d-flex">
                    <a href="./Add_attendance.php"><button class="btn btn-success">Add Attendance</button></a>
                    <button onclick="location.href='./Logout.php'" class="btn btn-danger d-flex ms-3"><span class="material-symbols-outlined">
                            logout
                        </span>Logout</button>
                </span>
            </div>
        </div>
    </nav>
    <div class="container credits">
        <div class="row mt-5 text-white">
            <div class="col-lg-12">
                <h2>Credits</h2>
            </div>
            <div class="col-lg-12 mt-3">
                <h4>Developers</h4>
                <ul>
                    <li>
                        <p>Akhil S Kumar</p>
                    </li>
                    <li>
                        <p>R Neeraja Anand</p>
                    </li>
                    <li>
                        <p>Sudhin S</p>
                    </li>
                    <li>
                        <p>Vani R</p>
                    </li>
                </ul>
            </div>
            <div class="col-lg-12 mt-3">
                <h4>Pentesting</h4>
                <ul>
                    <li>
                        <p>Vipin Veinu</p>
                    </li>
                    <li>
                        <p>Aadithyan Raju</p>
                    </li>
                </ul>
            </div>
            <div class="col-lg-12 mt-3">
                <h4>Typo's</h4>
                <ul>
                    <li>
                        <p>Srilakshmi Shajin</p>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row text-center text-white fixed-bottom">
            <div class="col-lg-12">
                <p>© 2023 ACM Amritapuri All Rights Reserved. Made with ❤️ in India.</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script>
        const ctx = document.getElementById("totalPresentChart");
        const data = {
            labels: ["A", "B", "C", "D", "E", "F", "G"],
            datasets: [{
                label: "Members Present",
                data: [65, 59, 80, 81, 56, 55, 40],
                fill: false,
                borderColor: "rgb(75, 192, 192)",
                tension: 0.1,
            }, ],
        };
        new Chart(ctx, {
            type: "line",
            data: data,
        });
    </script>
    <script>
        const web = document.getElementById("webtotalPresentChart");
        const dataWeb = {
            labels: ["A", "B", "C", "D", "E", "F", "G"],
            datasets: [{
                label: "Members Present",
                data: [10, 15, 5, 7, 20, 8, 3],
                fill: false,
                borderColor: "rgb(75, 192, 192)",
                tension: 0.1,
            }, ],
        };
        new Chart(web, {
            type: "line",
            data: dataWeb,
        });
    </script>
    <script>
        const glich = document.getElementById("glichtotalPresentChart");
        const dataGlich = {
            labels: ["A", "B", "C", "D", "E", "F", "G"],
            datasets: [{
                label: "Members Present",
                data: [8, 1, 2, 18, 9, 5, 4],
                fill: false,
                borderColor: "rgb(75, 192, 192)",
                tension: 0.1,
            }, ],
        };
        new Chart(glich, {
            type: "line",
            data: dataGlich,
        });
    </script>
    <script>
        const ai = document.getElementById("aitotalPresentChart");
        const dataAi = {
            labels: ["A", "B", "C", "D", "E", "F", "G"],
            datasets: [{
                label: "Members Present",
                data: [65, 59, 80, 81, 56, 55, 40],
                fill: false,
                borderColor: "rgb(75, 192, 192)",
                tension: 0.1,
            }, ],
        };
        new Chart(ai, {
            type: "line",
            data: dataAi,
        });
    </script>

</body>

</html>