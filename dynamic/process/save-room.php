<?php
include_once 'dbconnect.php';

//check if form is submitted
if (isset($_POST['submit']))
{
    $filename = $_FILES['room-photo']['name'];

    //upload file
    if($filename != '')
    {
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $allowed = ['pdf', 'txt', 'doc', 'docx', 'png', 'jpg', 'jpeg',  'gif'];
    
        //check if file type is valid
        if (in_array($ext, $allowed))
        {
            $roomname = $_POST['room-name'];

            // get last record id
            $sql = 'select max(id) as id from room';
            $result = mysqli_query($con, $sql);
            if ((sizeof($result)) > 0)
            {
                $row = mysqli_fetch_array($result);
                $filename = ($row['id']+1) . '-' . $filename;
            }
            else
                $filename = '1' . '-' . $filename;

            //set target directory
            $path = '../storage/';
                
            move_uploaded_file($_FILES['room-photo']['tmp_name'],($path . $filename));
            
            // insert file details into database
            $sql = "INSERT INTO room(name, fotoPath) VALUES('".$roomname ."', '".$filename."')";
            mysqli_query($con, $sql);

            header("Location: ../index.php?st=success");
        }
        else
        {
            header("Location: ../index.php?st=error");
        }
    }
    else
        header("Location: ../index.php");
}
?>