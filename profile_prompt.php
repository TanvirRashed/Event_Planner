<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Update Your Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fde8ef;
            display: flex;
            height: 100vh;
            justify-content: center;
            align-items: center;
            margin: 0;
        }
        .modal {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(214, 51, 108, 0.3);
            max-width: 400px;
            text-align: center;
        }
        button {
            margin: 10px 15px;
            padding: 10px 25px;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .btn-edit {
            background-color: #d6336c;
            color: white;
        }
        .btn-edit:hover {
            background-color: #bb295d;
        }
        .btn-cancel {
            background-color: #6c757d;
            color: white;
        }
        .btn-cancel:hover {
            background-color: #5a6268;
        }
    </style>
</head>
<body>

<div class="modal">
    <h2>Welcome!</h2>
    <p>Would you like to update your profile information before continuing?</p>
    <button class="btn-edit" onclick="location.href='edit_user.php'">Edit Profile</button>
    <button class="btn-cancel" onclick="location.href='dashboard_user.php'">Skip / Cancel</button>
</div>

</body>
</html>
