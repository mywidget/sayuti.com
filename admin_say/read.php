<?php
define("BASEPATH", gethostbyaddr($_SERVER['REMOTE_ADDR']));
session_start();
include "../class/function_cek_sesi.php";
$chek = check_sesi();
if ($chek=='puser'){
include "login.php"; 
die();
}
	include "../class/conn_db.php";
	include "../class/web_function.php";
	include "../class/icon.php";
	include "../class/alert.php";
	include "../class/library.php";
	include "../class/lang.php";
	include "../class/filter.inc.php";
	include "../class/Pagination.php";
	include "../class/mkdir_function.php";
	include "../class/timeago.php";
	include "../class/controler.php";
	include "mod_khusus.php";
	include __DIR__ . '/lib/tag.php';
	$mode 	= "panel";
	$module = $_GET['panel']; 
	$stat 	= "status"; 
	$status = !isset($_GET[$stat]) ? : filter($_GET[$stat]);
	$act 	= isset($_GET['act']) ? $_GET['act'] : '';
	$page 	= isset($_GET['page']) ? $_GET['page'] : '';
	$url 	= isset($_GET['url']) ? $_GET['url'] : '';
	$GETID = filtergint('id');
	$GETIDP = filtergint('id_produk');
	$GETIDSES = !isset($_GET['id']) ? : filterget('id');
	$level = $_SESSION['leveluser'];
	$iduser = $_SESSION['iduser'];
	// echo $GETID;
	$sq = $db->query("SELECT * from menuadmin where link='$module' AND aktif='Y'");
	$n = $sq->fetch_array();
	$id = $n['idmenu'];
	$sqli_cat1 = $db->query("SELECT * FROM user WHERE username='$_SESSION[namauser]'");
	$rows = $sqli_cat1->fetch_array();
	$id_cek = $rows['idmenu'];
	if($rows['foto']!=''){
		$foto = $rows['foto'];
	}else{
		$foto = 'dist/img/avatar04.png';
	}

$link = setting('site_url');
$title_up = setting('site_title');
$path	= setting('path');
$nama_js = setting('nama_js');
if(empty($path)){
$pathnya = '';	
}else{
$pathnya = $path.'/';	
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin SAYUTI.COM</title>
     <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.4 -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="fonts/ionicons.min.css" rel="stylesheet" type="text/css" />
	<!-- fullCalendar 2.2.5-->
    <link href="plugins/fullcalendar/fullcalendar.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/fullcalendar/fullcalendar.print.css" rel="stylesheet" type="text/css" media='print' />
    <!-- iCheck for checkboxes and radio inputs -->
    <link href="dist/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
	<!-- iCheck for checkboxes and radio inputs -->
	<link href="plugins/iCheck/minimal/blue.css" rel="stylesheet" type="text/css" />
    <!-- DATA TABLES -->
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
	<!-- FILE INPUT -->
	<link href="plugins/jasny-bootstrap/css/jasny-bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="dist/css/AdminLTE.css" rel="stylesheet" type="text/css" />
    <link href="dist/css/style.css" rel="stylesheet" type="text/css" />
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link href="dist/css/skins/_all-skins.min.css" rel="stylesheet" type="text/css" />
	<!-- Bootstrap Color Picker -->
	<link rel="stylesheet" href="plugins/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css">
    <!-- daterange picker -->
    <link href="plugins/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
	<!-- chosen -->
	<link href="plugins/chosen/chosen.css" rel="stylesheet" type="text/css" />
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
    <link href="plugins/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
    <link href="plugins/datepicker/datepicker3.css" rel="stylesheet"/>
    <link href="dist/css/dataTables.tableTools.css" rel="stylesheet"/>
    <link href="plugins/autocomplate/jquery-ui.min.css" rel="stylesheet"/>
	<link href="plugins/select2/css/select2.css" rel="stylesheet"/>
	<link href="plugins/datepicker/bootstrap-datetimepicker.min.css" rel="stylesheet"/>
	
	
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="bootstrap/js/html5shiv.min.js"></script>
        <script src="bootstrap/js/respond.min.js"></script>
    <![endif]-->
	<!--link rel="stylesheet" href="bootstrap/css/jquery-ui.css" type="text/css" /--> 
    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.2 -->
    <script src="plugins/jQueryUI/jquery-ui-1.11.2.min.js" type="text/javascript"></script>
	<!-- nestable -->
	<script src="plugins/jquery.nestable.js"></script>
    <!-- Bootstrap 3.0.3 JS -->
    <script src="dist/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="plugins/bootstrap-notify/bootstrap-notify.min.js" type="text/javascript"></script>
    <script src="dist/js/bootstrap-typeahead.js"></script>

    <!-- Bootstrap 3.0.3 JS --
    <script src="dist/js/bootstrap.min.js"></script-->
    <script src="plugins/validation.js" type="text/javascript"></script>
    <script src="dist/js/bootstrap-select.js"></script>
    <script src="plugins/jquery.form.js"></script>
    <script src="plugins/common.js"></script>
    <script src="plugins/antrian_ajax.js"></script>
	<!-- DATA TABES SCRIPT -->
<!-- bootstrap time picker -->
    <script src="plugins/moment.min.js" type="text/javascript"></script>
 <script src="plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
<?php
if($module=='und'){
?>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<?php
}else{
?>
	<script src="plugins/datatablesz/jquery.dataTables.js" type="text/javascript"></script>
	<script src="plugins/datatablesz/dataTables.bootstrap.js" type="text/javascript"></script>
<?php
}
?>

    <!-- Page Script -->	

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      // $.widget.bridge('uibutton', $.ui.button);
	  // function goBack() {
    // window.history.back();
// }
    </script>
    </head>

 <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        <!-- header logo: style can be found in header.less -->
		<?php include "menu_atas.php"; ?>
		<?php include "sidebar.php"; ?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Panel
            <small><?=$module;?></small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><?=$module;?></li>
          </ol>
        </section>
        <!-- Main content -->
        <section class="content">
   
                    <!-- Main row -->
<?php 
$pathFile = "$mode/$module/index.php";
if (file_exists($pathFile))
{
$people = explode(",",$id_cek);
if (in_array($id, $people)){
include $pathFile;
}else{
echo error_akses_panel();
}
}else {
?>
                    <div class="error-page">
                        <h2 class="headline text-info"> 404</h2>
                        <div class="error-content">
                            <h3><i class="fa fa-warning text-yellow"></i> Oops! Module <?php echo $module; ?> tidak ditemukan.</h3>
                            <p>
                               Kami tidak dapat menemukan halaman yang Anda cari. Sementara itu, Anda dapat kembali ke <a href='index.php'>return to dashboard</a> atau pilih menu lain.
                            </p>
                        </div><!-- /.error-content -->
                    </div><!-- /.error-page -->
	<?php
}
?>
		</section><!-- /.content -->
        </div><!-- ./wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a>
		  </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
            <ul class='control-sidebar-menu'>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-birthday-cake bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>
                    <p>Will be 23 on April 24th</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>
                    <p>New phone +1(800)555-1234</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>
                    <p>nora@example.com</p>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <i class="menu-icon fa fa-file-code-o bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>
                    <p>Execution time 5 seconds</p>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

            <h3 class="control-sidebar-heading">Tasks Progress</h3>
            <ul class='control-sidebar-menu'>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Custom Template Design
                    <span class="label label-danger pull-right">70%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Update Resume
                    <span class="label label-success pull-right">95%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-success" style="width: 95%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Laravel Integration
                    <span class="label label-waring pull-right">50%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
                  </div>
                </a>
              </li>
              <li>
                <a href='javascript::;'>
                  <h4 class="control-sidebar-subheading">
                    Back End Framework
                    <span class="label label-primary pull-right">68%</span>
                  </h4>
                  <div class="progress progress-xxs">
                    <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
                  </div>
                </a>
              </li>
            </ul><!-- /.control-sidebar-menu -->

          </div><!-- /.tab-pane -->

          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
            <form method="post">
              <h3 class="control-sidebar-heading">General Settings</h3>
              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Report panel usage
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Some information about this general settings option
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Allow mail redirect
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Other sets of options are available
                </p>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Expose author name in posts
                  <input type="checkbox" class="pull-right" checked />
                </label>
                <p>
                  Allow the user to show his name in blog posts
                </p>
              </div><!-- /.form-group -->

              <h3 class="control-sidebar-heading">Chat Settings</h3>

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Show me as online
                  <input type="checkbox" class="pull-right" checked />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Turn off notifications
                  <input type="checkbox" class="pull-right" />
                </label>
              </div><!-- /.form-group -->

              <div class="form-group">
                <label class="control-sidebar-subheading">
                  Delete chat history
                  <a href="javascript::;" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
                </label>
              </div><!-- /.form-group -->
            </form>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <div class='control-sidebar-bg'></div>
        </div><!-- ./wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.0
        </div>
        <strong>Copyright &copy; 2015 <a href="#"></a>.</strong> All rights reserved.
      </footer>

    <!--script src="plugins/autocomplate/auto.js"></script-->


    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
    <!-- date-range-picker -->
    <script src="plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
    
    <script src="plugins/datepicker/bootstrap-datepicker.js" type="text/javascript"></script>
    <script src="plugins/datepicker/locales/bootstrap-datepicker.id.js" type="text/javascript"></script>
    
	
   
	<!-- bootstrap color picker -->
	<script src="plugins/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
    <!-- SlimScroll 1.3.0 -->
    <script src="plugins/slimScroll/jquery.slimscroll.min.js" type="text/javascript"></script>
    <!-- iCheck 1.0.1 -->
    <script src="plugins/iCheck/icheck.min.js" type="text/javascript"></script>
	<script src="plugins/select2/js/select2.js" type="text/javascript"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js" type="text/javascript"></script>
	<!-- CK Editor -->
	<script src="plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js" type="text/javascript"></script>
	<!-- chosen -->
	<script src="plugins/chosen/chosen.jquery.js" type="text/javascript"></script>
	<!-- paging -->
	<script src="plugins/paging.js" type="text/javascript"></script> 
    <!-- fullCalendar 2.2.5 -->

    <script src="plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
	<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js" type="text/javascript"></script>
	<!-- jasny-bootstrap -->
	<script src="plugins/jasny-bootstrap/js/jasny-bootstrap.js" type="text/javascript"></script>

	<script src="plugins/customer.js"></script>
	<script type="text/javascript">
	
	function notif(m,t){
$.notify({
	message: m 
},{
	type: t,
animate: {
		enter: 'animated fadeInRight',
		exit: 'animated fadeOutRight'
	},
placement: {
		from: 'bottom',
		align: 'right'
	}
});
	}
            $(function() {

                $("#table1").dataTable();
                $('#table2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": false,
                    "bInfo": true,
                    "bAutoWidth": false
                });
                $('#table3').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": false
                });
                $('#table4').dataTable({
                    "bPaginate": false,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": false,
                    "bInfo": false,
                    "bAutoWidth": false
                });
				$('#user').dataTable({
                    "bPaginate": true,
                    "bLengthChange": false,
                    "bFilter": false,
                    "bSort": true,
                    "bInfo": false,
                    "bAutoWidth": false
                });
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
		$('#jurnal').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": false,
          "bInfo": false,
          "bAutoWidth": false
        });
		$('#akun').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": true,
          "bSort": true,
          "bInfo": false,
          "bAutoWidth": false
        });
            });
        </script>
		
	 <script type="text/javascript">
		    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    var checkin = $('#dpd1').datepicker({
    onRender: function(date) {
    return date.valueOf() < now.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    if (ev.date.valueOf() > checkout.date.valueOf()) {
    var newDate = new Date(ev.date)
    newDate.setDate(newDate.getDate() + 1);
    checkout.setValue(newDate);
    }
    checkin.hide();
    $('#dpd2')[0].focus();
    }).data('datepicker');
    var checkout = $('#dpd2').datepicker({
    onRender: function(date) {
    return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
    }
    }).on('changeDate', function(ev) {
    checkout.hide();
    }).data('datepicker');

//2/html5shiv
$(".date-picker").datepicker();
$(".date-bayar").datepicker();
$("#date-kereta-1").datepicker();
$("#date-kereta-2").datepicker();
$("#date-pesawatx").datepicker();
$("#date-beli").datepicker();
$("#date-pakai").datepicker();
//Timepicker
$(".timepicker").timepicker({
	showInputs: false,
	showSeconds: true,
	showMeridian: false,
	defaultTime: false
});

//Timepicker
$(".jamber").timepicker({
	showInputs: false,
	showSeconds: true,
	showMeridian: false,
	defaultTime: false
});
//Timepicker
$(".jamkem").timepicker({
	showInputs: false,
	showSeconds: true,
	showMeridian: false,
	defaultTime: false
});
//Timepicker kereta
$(".jamberk").timepicker({
	showInputs: false,
	showSeconds: true,
	showMeridian: false,
	defaultTime: false
});
//Timepicker kereta
$(".jamkemk").timepicker({
	showInputs: false,
	showSeconds: true,
	showMeridian: false,
	defaultTime: false
});
		
$(".date-picker").on("change", function () {
    var id = $(this).attr("id");
    var val = $("label[for='" + id + "']").text();
    $("#msg").text(val + " changed");
});
	$('#dp1').datepicker({
	format: 'yyyy-mm-dd',
	todayBtn: "linked"
	});
	$('#lunas').datepicker({
	format: 'yyyy-mm-dd'
	});	
	$('.bayar').datepicker({
	format: 'yyyy-mm-dd'
	});	
	$('#rekap').datepicker({
	format: 'mm/yyyy'
	});
	$('#tanggal').datepicker({
	format: 'dd-mm-yyyy'
	});
    $('.datepicker').datepicker({
    format: "MM yyyy",
    startView: 1,
    minViewMode: 1,
    clearBtn: true,
    language: "id",
    autoclose: true
    });
</script>
    <script type="text/javascript">
      $(function () {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        	
        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass: 'iradio_minimal-blue'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
          checkboxClass: 'icheckbox_minimal-red',
          radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green',
          radioClass: 'iradio_flat-green'
        });
		
    $('#berangkat').datepicker({
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true
    });
	$('#kembali').datepicker({
        todayBtn: "linked",
        autoclose: true,
        todayHighlight: true
    });
      });
		$('#chosen-tags').selectize({
		plugins: ['remove_button'],
		persist: true,
		create: true,
		render: {
		item: function(data, escape) {
			return '<div>' + escape(data.text) + '</div>';
					}
				}
			});

            $(document).ready(function () {
			$("#compose-textarea, #key-textarea").wysihtml5();
                 CKEDITOR.replace( 'edit' );
			   $('.fileinput').fileinput();
            });
CKEDITOR.replace( 'service', {
	uiColor: '#14B8C4',
	toolbar: [
		[ 'Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink' ],
		[ 'FontSize', 'TextColor' ]
	]
});
</script>
    </body>
</html>