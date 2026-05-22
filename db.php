<?php
//$conn = mysqli_connect('diavatly.website','diavatly','Diavatly0803@','diavatly') ;
$conn = mysqli_connect('localhost','diavatly','cntt2019','diavatly_quanly') ;
mysqli_set_charset($conn,'utf8mb4');
if (!$conn)
{
	echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>