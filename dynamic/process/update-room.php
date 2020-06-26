<?php
$id = $_GET['id'];

include_once 'dbconnect.php';

$res 	= mysqli_query($con, "select * from room where id=$id");
$room 	= mysqli_fetch_array($res); 

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
            $filename = $id . '-' . $filename;

            //set target directory
            $path = '../storage/';
                
            move_uploaded_file($_FILES['room-photo']['tmp_name'],($path . $filename));
            
            // insert file details into database
            $sql = "UPDATE room SET name='$roomname', fotoPath='$filename' WHERE id=$id";
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

<h2>Update Ruangan</h2>
<form action="" method="post" enctype="multipart/form-data">
	<input type="text" name="room-name" value="<?php echo $room['name']; ?>"><br>
	<input type="file" name="room-photo"><br>
	<input type="submit" name="submit" value="Simpan Perubahan" >
</form>