<?php  
 session_start();  
 if(isset($_SESSION["user"]))  
 {  
      header("location:home.php");  
 }  
 
 ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADMIN Login Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            width: 100%;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            letter-spacing: 1px;
            background-color: #0c1022;
        }

        .login_form_container {
            position: relative;
            width: 400px;
            height: 470px;
            max-width: 400px;
            max-height: 470px;
            background: #040717;
            border-radius: 50px 5px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            margin-top: 70px;
        }

        .login_form_container::before {
            position: absolute;
            width: 170%;
            height: 170%;
            content: '';
            background-image: conic-gradient(transparent, transparent, transparent, #ee00ff);
            animation: rotate_border 6s linear infinite;
        }

        .login_form_container::after {
            position: absolute;
            width: 170%;
            height: 170%;
            content: '';
            background-image: conic-gradient(transparent, transparent, transparent, #00ccff);
            animation: rotate_border 6s linear infinite;
            animation-delay: -3s;
        }

        @keyframes rotate_border {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .login_form {
            position: absolute;
            content: '';
            background-color: #0c1022;
            border-radius: 50px 5px;
            inset: 5px;
            padding: 50px 40px;
            z-index: 10;
            color: #00ccff;
        }

        h2 {
            font-size: 40px;
            font-weight: 600;
            text-align: center;
        }

        .input_group {
            margin-top: 40px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: start;
        }

        .input_text {
            width: 95%;
            height: 30px;
            background: transparent;
            border: none;
            outline: none;
            border-bottom: 1px solid #00ccff;
            font-size: 20px;
            padding-left: 10px;
            color: #00ccff;
        }

        ::placeholder {
            font-size: 15px;
            color: #00ccff52;
            letter-spacing: 1px;
        }

        .fa {
            font-size: 20px;
        }

        #login_button {
            position: relative;
            width: 300px;
            height: 40px;
            transition: 1s;
            margin-top: 70px;
        }

        #login_button a input{
            position: absolute;
            width: 100%;
            height: 100%;
            text-decoration: none;
            z-index: 10;
            cursor: pointer;
            font-size: 22px;
            letter-spacing: 2px;
            border: 1px solid #00ccff;
            border-radius: 50px;
            background-color: #0c1022;
            display: flex;
            justify-content: center;
            align-items: center;
 
        }

        .fotter {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }

        .fotter a {
            text-decoration: none;
            cursor: pointer;
            font-size: 18px;
        }

        .glowIcon {
            text-shadow: 0 0 10px #00ccff;
        }
       
    </style>
</head>

<body>
	<form  method="post" action="">
    <div class="login_form_container">
        <div class="login_form">
            <h2>Login</h2>
            <div class="input_group">
                <i class="fa fa-user"></i>
                <input type="text" placeholder="Username"   name="user"  class="input_text" autocomplete="off" />
            </div>
            <div class="input_group">
                <i class="fa fa-unlock-alt"></i>
                <input type="password" placeholder="Password"  name="pass"   class="input_text" autocomplete="off" />
            </div>
 		<div class="button_group" id="login_button">
             <a><input type="submit" name="sub" value="SUBMIT"></a>
                </div>	
        </div>
    </div>
</form>
    <script>
        $(".input_text").focus(function () {
            $(this).prev('.fa').addClass('glowIcon')
        })
        $(".input_text").focusout(function () {
            $(this).prev('.fa').removeClass('glowIcon')
        })
    </script>
</body>

</html>
<?php
   include('db.php');
  
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form 
      
      $myusername = mysqli_real_escape_string($con,$_POST['user']);
      $mypassword = mysqli_real_escape_string($con,$_POST['pass']); 
      
      $sql = "SELECT id FROM login WHERE usname = '$myusername' and pass = '$mypassword'";
      $result = mysqli_query($con,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         
         $_SESSION['user'] = $myusername;
         
         header("location: home.php");
      }else {
         echo '<script>alert("Your Login Name or Password is invalid") </script>' ;
      }
   }
?>


