<script>
$(document).ready(function(){
    $('input[rel="tooltip"]').tooltip();
});
</script>
<?php
//error_reporting(0);
	include "../g-asset/conn_db.php";
	include "../g-asset/web_function.php";
	include "../g-asset/library_function.php";
if(isset($_POST['idakun']))
{
$idakun=$_POST['idakun'];
$query1=mysql_query("select id_akun from master_akun  where id_akun='$idakun'");
$row1=mysql_num_rows($query1);
if($row1==0){
echo "<span class='glyphicon glyphicon-ok-circle green' data-toggle='tooltip' title='Ok'></span>";
}else{
echo "<span class='glyphicon glyphicon-remove-circle red' data-toggle='tooltip' title='ID sudah ada'></span>";
}
}
if(isset($_POST['nama']))
{
$nama=$_POST['nama'];
$query1=mysql_query("select nama_akun from master_akun  where nama_akun='$nama'");
$row1=mysql_num_rows($query1);
if($row1==0){
echo "<span class='glyphicon glyphicon-ok-circle green' data-toggle='tooltip' title='nama akun bisa digunakan'></span>";
}
else
{
echo "<span class='glyphicon glyphicon-remove-circle red' data-toggle='tooltip' title='nama akun sudah ada'></span>";
} 
}
?>