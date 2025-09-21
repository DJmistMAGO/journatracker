<!DOCTYPE html>
<html>
<head>
    <title>Your Account Credentials</title>
</head>
<body>
    <p>Hello {{ $name }},</p>
    <p>Your account has been created. Here are your credentials:</p>
    <ul>
        <li><strong>Email:</strong> {{ $email }}</li>
        <li><strong>Password:</strong> {{ $password }}</li>
    </ul>
    <p>Please log in and change your password immediately.</p>
    <p>Thank you!</p>
</body>
</html>
