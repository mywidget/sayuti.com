<script>
$(document).ready(function(){
    $('input[rel="tooltip"]').tooltip();
});
</script>
<?php
//error_reporting(0);
	include "../../g-asset/conn_db.php";
	include "../../g-asset/web_function.php";
	include "../../g-asset/library_function.php";
if(isset($_POST['telp']))
{
$telp=$_POST['telp'];
$query1=mysql_query("select id_konsumen,telp from konsumen  where telp='$telp'");
$row1=mysql_num_rows($query1);
$row=mysql_fetch_array($query1);

if($row1==0){
echo "<span class='glyphicon glyphicon-ok-circle green' data-toggle='tooltip' title='No. Telp. Ok'></span>";
}else{
echo "<a href='?panel=konsumen&act=view&id=".$row['id_konsumen']."'><span class='glyphicon glyphicon-remove-circle red' data-toggle='tooltip' title='No. Telp. sudah ada'></span></a>";
}
}
if(isset($_POST['email']))
{
$email=$_POST['email'];
if(eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email))
{
$query1=mysql_query("select email from konsumen  where email='$email'");
$row1=mysql_num_rows($query1);
if($row1==0){
echo "<span class='glyphicon glyphicon-ok-circle green' data-toggle='tooltip' title='email tersedia'></span>";
}
else
{
echo "<span class='glyphicon glyphicon-remove-circle red' data-toggle='tooltip' title='email sudah digunakan'></span>";
} 
}
}
?>