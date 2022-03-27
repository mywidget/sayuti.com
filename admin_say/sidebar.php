<?php
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
?>
<style>
.enable > a {
       cursor: default;
       color: #333;
       background-color: #333;
}
.disable > a {
       pointer-events: none;
       cursor: default;
       color: #333;
       background-color: #333;
}
</style>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?=$foto;?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
              <p><?= $_SESSION['namalengkap'];?></p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>
          <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
          <!-- /.search form -->
          <!-- sidebar menu: : style can be found in sidebar.less -->
<?php
	$sq = $db->query("SELECT * from user where level='$_SESSION[leveluser]'");
	$n = $sq->fetch_array();
	$idm = $n['id_level'];
	$cats=$db->query("SELECT * FROM user WHERE id_level='$idm'");
	$ns = $cats->fetch_array();
if ($_SESSION['leveluser']=='admin'){
	$sql=$db->query("select * from menuadmin where idparent='0' AND aktif='Y' order by urutan ASC");
}else{
	//$sql=$db->query("select * from menuadmin where id_level='$ns[id_level]' AND aktif='Y' order by urutan ");
	$sql=$db->query("select * from menuadmin where FIND_IN_SET('$ns[id_level]', CONCAT(id_level, ',')) AND idparent='0' AND aktif='Y' order by urutan ");
}
?>
	<ul class='sidebar-menu'>
<?php
	while ($m=$sql->fetch_array()){
	$carimenu=$db->query("select * from menuadmin where link='$module'");
	$sm=$carimenu->fetch_array();
	$qq="$sm[idparent]";
	$qz="$m[idmenu]";
	$treeview="$m[treeview]";
  	if ($qq == $qz) {
  		echo "<li class='$treeview active'>"; 
  		} else{ 
  			echo "<li class='$treeview'>"; 
  		} 
	if($m['link_on']=='Y'){ ?>
	<a href='?<?php echo ('panel='.$m['link'].'');?>'>
	<i class='fa <?=$m['class'];?>'></i><span><?=$m['nama_menu'];?></span>
	<?php if($m['classicon'] == 'Y'){ ?>
	<i class='fa fa-angle-left pull-right'></i>
	<?php } ?>
	</a>
	<?php }else{
	echo $m['nama_menu']; ?>
<?php
}
	$sub=$db->query("SELECT * FROM menuadmin WHERE idparent=$m[idmenu] AND aktif='Y' order by urutan");
	$jml=$sub->num_rows;
	// apabila sub menu ditemukan                
	if ($jml > 0){
	echo " <ul class='treeview-menu'>";                 
	while($w=$sub->fetch_array()){
	?>
	<li>
	<a href='?<?php echo ('panel='.$w['link'].'')?>'>
	<i class="fa fa-circle-o"></i> <?=$w['nama_menu'];?>
	</a>
	</li>
	<?php
		}
	echo "</ul>";
	}else{
	echo "</li>";
	}
		}
?>
	</ul> 
        </section>
        <!-- /.sidebar -->
	</aside>
	<script type="text/javascript">
      $(document).ready(function(){
 		  var str=location.href.toLowerCase();
        $('.sidebar-menu li a').each(function() {
                if (str.indexOf(this.href.toLowerCase()) > -1) {
					$("li.a active").removeClass("active");
                        $(this).parent().addClass("active"); 
                   }
                 }); 

			});
	</script>