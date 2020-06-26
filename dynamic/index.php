<?php
	include_once 'process/dbconnect.php';
    session_start(); //start the PHP_session function 

	$sql = "select * from room";
	$rooms = mysqli_query($con, $sql);

    if(isset($_SESSION['page_count']))
    {
         $_SESSION['page_count'] += 1;
    }
    else
    {
         $_SESSION['page_count'] = 1;
    }
     echo 'You are visitor number ' . $_SESSION['page_count'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>Belajar PHP</title>
</head>
<body>
	<h1>Data Passing</h1>
	<a href="room.php?id=1">Ruangan 1</a><br>
	<a href="room.php?id=2">Ruangan 2</a><br>
	<a href="room.php?id=3">Ruangan 3</a><br>
	<a href="room.php?id=4">Ruangan 4</a>

	<h1>CRUD dan File Upload - Download</h1>

	<h2>Tambah Ruangan</h2>
	<form action="process/save-room.php" method="post" enctype="multipart/form-data">
		<input type="text" name="room-name" placeholder="Room Name"><br>
		<input type="file" name="room-photo"><br>
		<input type="submit" name="submit" value="Simpan" >
	</form>
	
	 <?php 
     if(isset($_GET['st'])) { ?>
        <div class="alert alert-danger text-center">
        <?php if ($_GET['st'] == 'success') {
                echo "Ruangan berhasil ditambahkan!";
            }
            else
            {
                echo 'Ruangan gagal ditambahkan!';
            } ?>
        </div>
    <?php } ?>

    <h2>Lihat Ruangan</h2>
    <table>
    	<thead>
    		<th>ID</th>
    		<th>Nama Ruangan</th>
    		<th>Foto</th>
    		<th>Action</th>
    	</thead>
    	<tbody>
    		<?php
    			while($room = mysqli_fetch_array($rooms)) { ?>
                <tr>
                    <td><?php echo $room['id']; ?></td>
                    <td><?php echo $room['name']; ?></td>
                    <td>
                    	<a href="storage/<?php echo $room['fotoPath']; ?>" target="_blank">View </a> 
                    	<a href="storage/<?php echo $room['fotoPath']; ?>" download>Download</a>
                    </td>
                    <td><a href=<?php echo "process/update-room.php?id=".$room['id'] ?>>Update</a> <a href=<?php echo "process/delete-room.php?id=".$room['id'] ?>>Delete</a></td>
                </tr>
    		<?php } ?>
    	</tbody>
    </table>
    <?php session_destroy(); ?>
</body>
</html>