<?php
/**
 * Created by PhpStorm.
 * User: riash_000
 * Date: 3/31/2015
 * Time: 2:13 AM
 */
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fully Validated Form Using PHP</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap-theme.min.css">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <style>
        body {padding-top:20px;}
        .error {color: #FF0000;}
    </style>
</head>

<body>
<?php
 //Define Blank Variables

$nameErr = $emailErr = $websiteErr = $genderErr = "";
$name = $email = $website = $gender = $comment = "";

if($_SERVER["REQUEST_METHOD"]== "POST"){

    //Name with Validation
    if(empty($_POST["name"])){
        $nameErr = "Name is Required";
    }else{
        $name = given_input($_POST["name"]);
        //check the Name is Valid or Not (Letters and WhiteSpace)

        if(!preg_match("/^[a-zA-Z]*$/",$name)){
            $nameErr = "Only letters and White Space is Allowed. ";
        }
    }

    //Email with Validation
    if(empty($_POST["email"])){
        $emailErr = "Email is Required.";
    }else{
        $email = given_input($_POST["email"]);

        //checking if the Email is valid or not
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $emailErr = "Invalid Email Format.";
        }
    }

    //Website with Validation
    if(empty($_POST["website"])){
        $websiteErr="";
    }else{
        $website = given_input($_POST["website"]);

        //check if the website is valid or not
        if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
            $websiteErr = "Invalid URL";
        }
    }

    //Comment

    if(empty($_POST["comment"])){
        $comment = "";
    }else{
        $comment = given_input($_POST["comment"]);
    }

    //Gender

    if(empty($_POST["gender"])){
        $genderErr ="Gender is Required";
    }else{
        $gender = given_input($_POST["gender"]);
    }
}

function given_input($data){

    $data = trim($data);
    $data = htmlspecialchars($data);
    $data = stripslashes($data);
    return $data;
}
?>



<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="well well-sm">
                <form class="form-horizontal" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
                    <fieldset>
                        <legend class="text-center">PHP Validated Form</legend>

                        <!-- Name input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="name">Name</label>
                            <div class="col-md-9">
                                <input id="name" name="name" type="text" placeholder="Your name" class="form-control">
                                <span class="error">*<?php echo $nameErr; ?></span>
                            </div>
                        </div>

                        <!-- Email input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="email">Your E-mail</label>
                            <div class="col-md-9">
                                <input id="email" name="email" type="text" placeholder="Your email" class="form-control">
                                <span class="error">*<?php echo $emailErr; ?></span>
                            </div>
                        </div>

                        <!-- Website input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="website">Website</label>
                            <div class="col-md-9">
                                <input id="website" name="website" type="text" placeholder="Your Website" class="form-control">
                                <span class="error"><?php echo $websiteErr; ?></span>
                            </div>
                        </div>

                        <!-- Message body -->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="message">Your message</label>
                            <div class="col-md-9">
                                <textarea class="form-control" id="message" name="comment" placeholder="Please enter your message here..." rows="5"></textarea>
                            </div>
                        </div>

                        <!-- Radio input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="gender">Your Gender: </label>
                            <div class="col-md-9">
                                <label class="radio-inline">
                                    <input name="gender" type="radio"  value="female">Female
                                </label>
                                <label class="radio-inline">
                                    <input  name="gender" type="radio" value="male">Male
                                    <span class="error">*<?php echo $genderErr; ?></span>
                                </label>
                            </div>
                        </div>
                        <!-- Form actions -->
                        <div class="form-group">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="well well-sm">

                <?php
                echo "<h3>Thank Your For Submitting Your Information </h3>"."<br/>";
                echo "Your Name: ". $name."<br/><br/>";
                echo "Your E-mail: ". $email."<br/><br/>";
                echo "Your Web Address: ". $website."<br/><br/>";
                echo "Your Comments: ". $comment."<br/><br/>";
                echo "Your are: ". $gender."<br/><br/>";
                ?>

            </div>
        </div>
    </div>
</div>


</body>

</html>