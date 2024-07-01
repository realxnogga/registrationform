<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Form</title>
    <link rel="stylesheet" href="design.css" type="text/css">
</head>

<body>
    <div id="mainCon">
        <button class="button" id="viewrecordButton" onclick="window.location='table.php'">VIEW RECORD</button>
        <main>
            <div id="heading">
                <div id="img-txt">
                    <img src="images/edit-contact.svg" alt="contact form icon">
                    &nbsp&nbsp
                    <h1>Contact form</h1>
                </div>

                <div id="line">

                </div>
            </div>

            <form method="post">

                <section class="con" id="wrapperUsername">
                    <!-- for full name -->
                    <div>
                        <label for="firstname">First name</label><br>

                        <div id="wrapper-for-username-field">
                            <div id="wrapper-image-for-username">
                                <img src="images/fname-lname.svg" alt="email icon">
                            </div>
                            <input type="text" id="firstname" name="firstname" placeholder="Enter your first name" required>

                        </div>
                    </div>
                    <!-- for last name -->
                    <div>
                        <label for="lastname">Last name</label><br>
                        <div id="wrapper-for-username-field">
                            <div id="wrapper-image-for-username">
                                <img src="images/fname-lname.svg" alt="email icon">
                            </div>
                            <input type="text" id="lastname" name="lastname" placeholder="Enter your last name" required>

                        </div>
                    </div>
                </section>
                <!-- for email -->
                <section class="con">
                    <label for="email">Email</label><br>
                    <div id="wrapper-field">
                        <div id="wrapper-icon">
                            <img src="images/email.svg" alt="email icon">
                        </div>
                        <input type="email" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                </section>
                <!-- for subject -->
                <section class="con">
                    <label for="subject">Choose a subject:</label><br>
                    <div id="wrapper-field">
                        <div id="wrapper-icon">
                            <img src="images/menu-book-outline.svg" alt="email icon">
                        </div>
                        <select id="subject" name="subject" required>
                            <option value="" disabled selected>choose here</option>
                            <option value="Integrative Programming">Integrative Programming</option>
                            <option value="Networking 2">Networking 2</option>
                            <option value="Principle of Web Design">Principle of Web Design</option>
                            <option value="Client Server">Client Server</option>
                        </select>
                    </div>

                </section>
                <!-- for gender -->
                <section class="con" id="wrapper-genderAndInterest">
                    <div>
                        <h3>Gender</h3>
                        <hr>
                        <input type="radio" id="male" name="gender" value="Male" required>
                        <label for="male">Male</label><br>
                        <input type="radio" id="female" name="gender" value="Female" required>
                        <label for="female">Female</label><br>
                    </div>
                    <!-- for topic -->
                    <div>
                        <h3>Topic or Interest</h3>
                        <hr>
                        <input type="checkbox" id="datatypes" name="topic[]" value="Datatypes">
                        <label for="datatypes">Datatypes</label><br>
                        <input type="checkbox" id="variables" name="topic[]" value="Variables">
                        <label for="variables">Variables</label><br>
                        <input type="checkbox" id="operators" name="topic[]" value="Operators">
                        <label for="operators">Operators</label><br>
                        <input type="checkbox" id="array" name="topic[]" value="Array">
                        <label for="array">Array</label><br>
                        <input type="checkbox" id="loops" name="topic[]" value="Loops">
                        <label for="loops">Loops</label><br>
                    </div>
                </section>
                <!-- for message -->
                <section class="con">
                    <label for="textarea">Enter your message</label><br>
                    <textarea id="textarea" name="textarea" cols="30" rows="10"></textarea>
                </section>
                <section class="con">
                    <input class="button" id="submitButton" type="submit" value="Submit" name="submitButton">
                </section>

            </form>

        </main>
    </div>

</body>

</html>

<?php
include 'connection.php';

if (isset($_POST['submitButton'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $gender = $_POST['gender'];
    $topic1 = $_POST['topic1'];
    $topic2 = $_POST['topic2'];
    $topic3 = $_POST['topic3'];
    $textarea = $_POST['textarea'];

    $checkbox = $_POST['topic'];
    $temp_topic = "";
    foreach ($checkbox as $temp_topic1) {
        $temp_topic .= $temp_topic1 . ",";
    }


    $query = "INSERT INTO user(firstname, lastname, email, subject, gender, topic, message)
    VALUES ('$firstname', '$lastname', '$email', '$subject', '$gender', '$temp_topic', '$textarea')";

    $query_run = mysqli_query($con, $query);

    if ($query_run) {
        echo "<script>alert('New record has been added successfully!')</script>";
        echo "<script>window.location = 'contact_form.php'</script>";
    } else {
        echo "Something went wrong!";
    }
}
?>