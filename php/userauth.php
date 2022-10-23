<?php

require_once "../config.php";

//register users
function registerUser($fullnames, $email, $password, $gender, $country){
    //create a connection variable using the $conn variable in config.php
       //check if user with this email already exist in the database
   
     $sql= "INSERT INTO Students (full_names, country, email, gender, password)
            VALUES('$fullnames', '$country', '$email', '$gender', '$password');";
    
    global $conn;
    $search= mysqli_query($conn,"SELECT email FROM Students WHERE email= '$email' ");
    $result= mysqli_fetch_object($search);

    if(!$result){
        $addUser= mysqli_query($conn, $sql);
        echo " User Successfully Registered";
    } else{
        echo "user already exist";
    }
    
    }




//login users
function loginUser($email, $password){
    //create a connection variable using the $conn variable in config.php
    global $conn;
    //echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";
    //open connection to the database and check if email exist in the database
    //if it does, check if the password is the same with what is given
    //if true then set user session for the user and redirect to the dasbboard


    //$query= "SELECT email, password FROM Students WHERE email= '$email' AND password='$password' " ;
    $result= mysqli_query($conn,"SELECT full_names, email, password FROM Students WHERE email= '$email' AND password='$password' ");
    $array= mysqli_fetch_object($result);

    if($array){
        session_start();
       header('Location: ../dashboard.php');
       $_SESSION['username']=$array->full_names;
            exit();
    }
    else{
        header('Location: ../forms/login.html');
        //echo '<script language= "javascript"> alert("incorrect email or password" ); </script>';
    
}
}




function resetPassword($email, $password){
    //create a connection variable using the $conn variable in config.php
    //$conn = db();
    //echo "<h1 style='color: red'>RESET YOUR PASSWORD (IMPLEMENT ME)</h1>";

    //open connection to the database and check if username exist in the database
    //if it does, replace the password with $password given

    global $conn;
    $result= mysqli_query($conn,"SELECT email, password FROM Students WHERE email= '$email' ");
    $search= mysqli_fetch_object($result);

    if($search){
        $old_pass=$search->password;
        mysqli_query($conn, "UPDATE students set password=REPLACE(password,'$old_pass', '$password') WHERE email='$email' ");
        
       echo "password reset successfully, you can now login with the new details";
    
           exit();
    }
    echo "user does not exist";

}

function getusers(){
    //open connection to the database using the $conn variable
    //return users from the database
    //loop through the users and display them on a table

    global $conn;
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px' ",">",
               "<td style='width: 50px; background: blue' ",">" , $data['id'] , "</td>",
               "<td style='width: 150px'>" ,$data['full_names'] ,"</td>",
               "<td style='width: 150px'>" ,$data['email'] ,"</td>",
                "<td style='width: 150px'>", $data['gender'] , "</td>",
                "<td style='width: 150px'>", $data['country'], "</td>",

                "<td style='width: 150px' ",">",
                 "<form action='action.php' method='post'>
                <input name='id' value='",$data['id'] ,"' hidden>
                    <button type='submit', name='delete'> DELETE </button>
                    </form>",
                    "</td>",
                "</tr>";
        }
        echo "</table></table></center></body></html>";
    }
}
    

 function deleteaccount($id){
     //$conn = db();
      //delete user with the given id from the database
     global $conn;
     $sql= "DELETE  FROM students WHERE id=$id";
     $result = mysqli_query($conn, $sql);
     echo "user deleted successfully";
    
 }
 ?>