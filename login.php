<?php

session_start();

$email_error = $password_error = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $password = "";

   
    if (empty($_POST["email"])) {
        $email_error = "The email field is required";
    } else {
        $email = htmlspecialchars(trim($_POST["email"]));
    }

    if (empty($_POST["password"])) {
        $password_error = "The password field is required";
    } else {
        $password = trim(htmlspecialchars($_POST["password"]));
    }

    
    if (!$email_error || !$password_error) {
        
        if (isset($_SESSION["user"]) && in_array($email, $_SESSION["user"])) {
            
            if (strcasecmp($password, $_SESSION["user"]["password"]) === 0) {
               
                header("Location: profile.php");
               
            } else {
                $email_error = "You have passed incorrect credentials";
            }
        }
    }
}
if (isset($_SESSION["user"]))  ?>
    <script>
        alert("You may now login");
    </script>
<?php 
 
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>

<body>
    <h4>LOGIN</h4>

    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        EMAIL: <input name="email" required type="email" placeholder="Enter your email">
        <span style="color: red;">*<?php echo $email_error ?></span><br>
        PASSWORD: <input type="password" required placeholder="Enter your password">
        <span style="color: red;">*<?php echo $email_error ?></span><br>
        <button type="submit">Login to Account</button>

    </form>


</body>

</html>