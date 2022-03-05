<?php
$password = $_POST['passwordlama'];
$password1 = $_POST['passwordbaru'];
$password2 = $_POST['passwordbaru2'];

$kueri = mysql_query("SELECT * FROM user WHERE id_user = '$_SESSION[username]'");
$hasil = mysql_fetch_array($kueri);

if ($password == $hasil['password']) {
	if ($password1 == $password2) {
		$kueri = mysql_query("UPDATE user set password='$password2' WHERE id_user = '$_SESSION[username]'");
		echo '<script>window.location="index.php?admin"</script>';
	} else {
		?>
		<script type="text/javascript">
			confirm('Password baru tidak cocok');
		</script>
		<?php
		echo '<script>window.location="index.php?admin&p=password"</script>';
	}
} else {
	?>
	<script type="text/javascript">
		confirm('Password lama tidak cocok');
	</script>
	<?php
	echo '<script>window.location="index.php?admin&p=password"</script>';
}
?>