<?php 
session_start();
if (isset($_SESSION["email"]))
  {
    header("location: profilepage.php");
  }
?>

<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="UTF-8">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Welcome | WanderLust</title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
    <link rel="stylesheet" href="css/login_css.css">

    <script>
    
        function validate(form)
        {
            fail = "";
            fail += validateUsername(form.username.value);
            fail += validateEmail(form.email.value);
            fail += telephoneCheck(form.password.value);
            fail += validatePassword(form.contact.value);
            if   (fail == "")   
                return true;
            else 
            { 
                alert(fail); 
                return false; 
            }
        }

        
        function telephoneCheck(str) {
            var a = /^(1\s|1|)?((\(\d{3}\))|\d{3})(\-|\s)?(\d{3})(\-|\s)?(\d{4})$/.test(str);
            alert(a);
        }
        function validateUsername(field)
        {
            if (field == "") 
              return "No Username was entered.\n";
            else if (field.length < 5)
              return "Usernames must be at least 5 characters.\n";
            else if (/[^a-zA-Z0-9_-]/.test(field))
              return "Only a-z, A-Z, 0-9, - and _ allowed in Usernames.\n";
            return "";
        }
        function validateEmail(field)
        {
            var  count = 0;
            for(var i=0;i<field.length;i++)
                if(field.charAt(i)=='@')
                    count++;
                    
            if (field == "") 
                return "No Email was entered.\n";
            else if (/[^a-zA-Z0-9.@_-]/.test(field))
                return "Only a-z, A-Z, 0-9, - , . and  _ allowed in email address.\n";
            else if ((field.indexOf(".") == 0) || (field.indexOf("@") == 0) || (field.indexOf("-") == 0) || (field.indexOf("_") == 0) )
                return "symbol . - _ @ cannot be the first character in email.";
            else if (count>1)
                return "@ symbol allowed only once in email.";
            else
                return "";
        }
        function validatePassword(field)
        {
            if (field == "") 
              return "No Password was entered.\n";
            else if (field.length < 6)
              return "Passwords must be at least 6 characters.\n";
            else if (! /[a-z]/.test(field) ||  ! /[A-Z]/.test(field) || ! /[0-9]/.test(field))
              return "Passwords require one each of a-z, A-Z and 0-9.\n";
            else
              return "";
        }
    </script>
</head>

<body>
    
    <div class="cont" style="height:650px">
        <form action="main.php" autocomplete="on" method="post">
            <div class="form sign-in">
                <a class="home_button" href="index.php"><img src="css/images/home.png" width="25px" height="25px"></a>
                <h2>Welcome</h2>
                <label>
                    <span>Username</span>
                    <input type="text" name="username" autofocus="autofocus" autocomplete="autocomplete" required="required" />
                </label>
                <label>
                    <span>Password</span>
                    <input type="password" name="password" required="required" />
                </label>
                <p class="forgot-pass"><a href="#">Forgot password?</a></p>
                <button type="submit" name="Login" class="submit">Login</button>
            </div>
        </form>
        <div class="sub-cont">
            <div class="img">
                <div class="img__text m--up">
                    <h2>Login in WanderLust</h2>
                    <p>Happy Trekking.</p>
                </div>
                <div class="img__text m--in">
                    <h2>New To WanderLust?</h2>
                    <p>Sign up and discover the wonderfull experience.</p>
                </div>
                <div class="img__btn">
                    <span class="m--up">Sign Up</span>
                    <span class="m--in">Login</span>
                </div>
            </div>
            <form action="main.php" autocomplete="on" method="post">
                <div class="form sign-up">
                    <a class="home_button_right" href="index.php"><img src="css/images/home.png" width="25px" height="25px"></a>
                    <h2>Time to feel like home,</h2>
                    
                    <label>
                        <span>Gmail ID</span>
                        <input type="email" name="email" size="100" required="required" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>">
                    </label>
                    <label>
                        <span>Select a Username</span>
                        <input type="text" id="username" name="username" size="30" required="required" autofocus="autofocus" value="<?php echo isset($_POST['contact']) ? $_POST['contact'] : '' ?>">
                        <span id="avail"></span>
                    </label>
                    <label>
                        <span>Contact</span>
                        <input type="text" name="contact" size="30" required="required" autofocus="autofocus" value="<?php echo isset($_POST['contact']) ? $_POST['contact'] : '' ?>">
                    </label>
                    <label>
                        <span>Password</span>
                        <input type="password" name="password" size="30" required="required">
                    </label>
                    <label>
                        <span>Retype Password</span>
                        <input type="password" name="retype_password" size="30" required="required">
                    </label>
                    
                    <button type="submit" id="Signup" name="Signup" class="submit">Sign Up</button>
                    
                </div>
            </form>
        </div>
    </div>
    <script  src="js/login.js"></script>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

    <script>
        $(document).ready(function(){
            $('#username').blur(function(){
                var username = $(this).val();

                $.ajax({
                    url:'main.php',
                    method:'POST',
                    data:{user_name:username},
                    success:function(data)
                    {
                        if(data != '0'){
                            $('#avail').html("<span style='color:red;' class='text-danger'>Username Not Available</span>");
                            $('#Signup').attr("disabled",true);
                             $("#Signup").fadeTo(1000, 0.4);
                             console.log(data);
                        }
                        else{
                            $('#avail').html("<span style='color:green;' class='text-success'>Username Available</span>");
                            $('#Signup').attr("disabled",false);
                            $("#Signup").fadeTo(1000, 1);
                            console.log(1)
                        }
                    }
                })
            });
        });


    </script>
</body>

</html>