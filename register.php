<?php 

session_start();


$name_error = $email_error = $password_error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $_SESSION["user"] = [];

    
    $name = $email = $password = "";
    

    if (empty($_POST["name"])) {
        $name_error = "The name field is required";
    }else {
        $name = trim(htmlspecialchars($_POST["name"]));
    }
    if (empty($_POST["email"])) {
        $email_error = "The email field is required";
    }else {
        if (filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            $email = trim(htmlspecialchars($_POST["email"]));
        }else {
            $email_error = "Email should be in format email@domain.com";
        }
    }
    if (empty($_POST["password"])) {
        $password_error = "The password field is required";
    }else {
        $password = trim(htmlspecialchars($_POST["password"]));
    }

    //if there are no errors
    if (!$name_error || !$email_error || !$password_error) {
        $data = [
            "name" => $name,
            "email" => $email,
            "password" => $password
        ];

        //store array in session
        $_SESSION["user"] = $data;

        //redirect to login
        header("Location: profile.php");
    }  
}
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
      <h4>Create Account</h4>
    <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
       NAME: <input name= "name"  type = "text" placeholder = "Enter your name">
       <span style="color: red;"><?php echo $name_error ?></span><br>

       EMAIL: <input name= "email" type="email" placeholder = "Enter your email">
       <span style="color: red;"><?php echo $email_error ?></span><br>

       PASSWORD: <input type= "password"  placeholder = "Enter your password">
        <span style="color: red;"><?php echo $password_error ?></span><br>

       <button type="submit">Create Account</button>
       
       </form>
</body>
</html>