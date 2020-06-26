<?php

	//untuk menghapus cookie sebelum expired time terlewati, set waktu ke waktu yang sudah dilewati
 	setcookie("user_name", "zahrahaaf", time() - 10,'/');
 	echo "Menghapus cookie";
?>