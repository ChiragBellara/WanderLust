<!DOCTYPE html>
<html>
<head>
	<title>Sign Up | WanderLust</title>
	<link rel="stylesheet" type="text/css" href="css/signup_css.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <script>
      function validate(form)
      {
        fail = "";
        fail += validateUsername(form.username.value);
        fail += validateEmail(form.email.value);
        fail += validatePassword(form.password.value);
        if   (fail == "")   
            return true;
        else 
        { 
            alert(fail); 
            return false; 
        }
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
	 <div class="main_div"></div>
    <a href="index.php"><img class="logo" src="css/images/logo_final.png" alt="WanderLust Logo" width="250px" height="170px"></a>
    <div class="signupbox">
    		<div class="right-box">
    			<h1>Sign Up</h1>
                <form action="signup.php" autocomplete="on" onsubmit="return validate(this)" method="post">
        			<input type="text" name="username" size="30" placeholder="Username" required="required" autofocus="autofocus">
        			<input type="email" name="email" size="100" placeholder="Email" required="required">

        			<input type="password" name="password" size="30" placeholder="Password">
        			<input type="password" name="retype_pass" placeholder="Retype Password">

        			<input type="submit" name="signup_btn" value="Sign Up">

        			<a href="login.php">Already have an account ?</a>
                </form>

    		</div>
    		<div class="left-box">
    			<div class="background"></div>
			</div>
    	</div>
</body>
</html>