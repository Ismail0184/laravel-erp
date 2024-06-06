<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Access</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 40px;
            text-align: center;
            max-width: 600px;
            width: 100%;
            box-sizing: border-box;
        }

        h1 {
            color: #dc3545;
            margin-bottom: 20px;
        }

        p {
            color: #6c757d;
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .btn {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }

        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Access Denied</h1>
    <p>You do not have permission to view this page.</p>
    <p><strong>Note:</strong> Please remember that a notification has been sent to the administration and if you attempt to view unauthorized pages 3 times, your account will be banned. </p>
    <p><em>Unauthorized page view attempt : 1/3</em></p>
    <a href="{{route('dashboard')}}" class="btn">Exit Safely</a>
</div>
</body>
</html>
