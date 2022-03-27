<?php
function plugin($url='',$js='',$seo='',$seo_prod='',$module=''){
global $db;
if($url=='komentar' AND $js==1){
$sql = $db->query("SELECT * FROM `plugin` WHERE id='1' AND pub='0'");
if($sql->num_rows >0){
$data=$sql->fetch_array();
	$plugin = "[".$data['plugin_arr']."]";
	$var = json_decode($plugin);
	$pages = $var[0]->pages;
	$site_name = $var[0]->site_name;
	$app_id = $var[0]->app_id;
$html = '<meta property="og:url" content="'.canonical($module,$seo,$seo_prod).'" />
	<meta property="og:type" content="website"/>
	<meta property="og:title" content="'.judul($seo).'" />
	<meta property="og:description" content="'.desc($module,$seo).'" />
	<meta property="og:image" content="'.gambar($module,$seo).'"/>
	<meta property="fb:pages" content="'.$pages.'" />
	<meta property="og:site_name" content="'.$site_name.'" />
	<meta property="fb:app_id" content="'.$app_id.'" />';
}else{
$html ='';
}
}elseif($url=='komentar' AND $js==2){
$sql = $db->query("SELECT * FROM `plugin` WHERE id='1' AND pub='0'");
if($sql->num_rows >0){
$data=$sql->fetch_array();
	$plugin = "[".$data['plugin_arr']."]";
	$var = json_decode($plugin);
	$app_id = $var[0]->app_id;
$html = "<div id='fb-root'></div>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '$app_id',
      xfbml      : true,
      version    : 'v6.0'
    });
    FB.AppEvents.logPageView();
  };
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = '//connect.facebook.net/en_US/sdk.js';
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
</script>";
}else{
$html ='';
}
}elseif($url=='komentar' AND $js==3){
$sql = $db->query("SELECT * FROM `plugin` WHERE id='1' AND pub='0'");
if($sql->num_rows >0){
$data=$sql->fetch_array();
	$plugin = "[".$data['plugin_arr']."]";
	$var = json_decode($plugin);
	$site_name = $var[0]->site_name;
$html ='<h3>Komentar</h3>
<div class="comments-list" style="margin-left: 0">
	<div class="comment-block">
		<div class="fb-comments" data-colorscheme="light" data-href="'.$site_name.'/'.$seo.'" data-numposts="5" data-width="620"></div>
	</div>
</div>';
}else{
$html ='';
}
}elseif($url=='map'){
$sql = $db->query("SELECT * FROM `plugin` WHERE id='4' AND pub='0'");
if($sql->num_rows >0){
	$data=$sql->fetch_array();
	$plugin = "[".$data['plugin_arr']."]";
	$var = json_decode($plugin);
	$embed = $var[0]->embed;
$html = '<div id="map">
<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$embed.'"></iframe>';
}else{
$html ='';
}
}elseif($url=='tag'){
$html ='<ul class="'.$js.'">';
	$type = explode(',',$seo);
	$html.= "<li><span>TAGS</span></li>";
	foreach($type as $tags) {
	$sqltag = $db->query("select * from tag where tag_seo ='$tags' AND type='$module'");
    $num_rows=$sqltag->num_rows;
	if ($num_rows > 0 ) {
	$rows=$sqltag->fetch_array();
	$html.= '<li><a href="/tag/'.$rows['tag_seo'].'">'.$rows['nama_tag'].'</a></li>';
		}
	}
$html .= '</ul>';
}elseif($url=='share'){
$html ='<ul class=" td-post-small-box social-media mt-10">
		<li><a href="https://www.facebook.com/sharer/sharer.php?u='.$seo.'"><i class="fa fa-facebook"></i></a> </li>
		<li><a href="https://twitter.com/home?status='.$seo.'"><i class="fa fa-twitter"></i></a></li>
		<li><a href="https://plus.google.com/share?url='.$seo.'"><i class="fa fa-google-plus"></i></a> </li>
	<li><span>SHARE</span></li>
	</ul>';
}elseif($url=='ana'){
$sql = $db->query("SELECT * FROM `plugin` WHERE id='3' AND pub='0'");
if($sql->num_rows >0){
	$data=$sql->fetch_array();
	$plugin = "[".$data['plugin_arr']."]";
	$var = json_decode($plugin);
	$partnerid = $var[0]->partnerid;
$html = "<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', '$partnerid', 'auto');
  ga('send', 'pageview');
  </script>";
}else{
$html ='';
}
}elseif($url=='cse' AND $js=1){
$sql = $db->query("SELECT * FROM `plugin` WHERE id='2' AND pub='0'");
if($sql->num_rows >0){
$html = '<div class="widget widget_search">
								<div class="site-search-area">
									<form name="cse" action="/cari/"  accept-charset="utf-8" id="site-searchform">
										<div>
											<input class="input-text" name="q" id="q" placeholder="Cari Data/Produk..." type="text" required >
											<input id="searchsubmit" value="Search" type="submit">
										</div>
									</form>
								</div><!-- end site search -->
</div>';
// $html = '<div class="top-search">
                    // <div class="container">
                        // <div class="input-group">
						// <span class="input-group-addon"><i class="fa fa-search"></i></span>
						// <form name="cse" action="/cari/"  accept-charset="utf-8">
							// <input class="form-control cari" id="q" name="q" type="text" placeholder="Pencarian berita..." required="required" />
						// </form> 
						// <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                        // </div>
                    // </div>
                // </div>';
}else{
$html = '<div class="top-search">
                    <div class="container">
                        <div class="input-group">
						<span class="input-group-addon"><i class="fa fa-search"></i></span>
						<form name="cse" action="/cari/"  accept-charset="utf-8">
						<div class="col-xs-12 col-sm-5 col-md-7">
							<input class="form-control cari" id="q" name="q" type="text" placeholder="Pencarian berita..." required="required" />
							</div>
							<div class="col-xs-12 col-sm-5 col-md-3">
							<select name="pencarian" id="year" required>
    <option value="0">-- Pilih --</option>
    <option value="Berita">Berita</option>
    <option value="Video">Video</option>
    <option value="Foto">Foto</option>
    <option value="Agenda">Agenda</option>
    <option value="Regulasi">Regulasi</option>
</select>
						</div> 
<div class="col-xs-12 col-sm-5 col-md-1">
<span class="input-group-addon"><button class="btn" id="cari"><i class="fa fa-search"></i></button></span>
						</div> 
						</form> 
						<span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
                        </div>
                    </div>
                </div>';
}
}elseif($url=='csep'){
$sql = $db->query("SELECT * FROM `plugin` WHERE id='2' AND pub='0'");
if($sql->num_rows >0){
	$data=$sql->fetch_array();
	$plugin = "[".$data['plugin_arr']."]";
	$var = json_decode($plugin);
	$partnerid = $var[0]->partnerid;
$html = "<script>
var myCallback = function() {
  if (document.readyState == 'complete') {
    // Document is ready when CSE element is initialized.
    // Render an element with both search box and search results in div with id 'test'.
    google.search.cse.element.render(
        {
          div: 'pencarian',
          tag: 'search'
         });
  } else {
    // Document is not ready yet, when CSE element is initialized.
    google.setOnLoadCallback(function() {
       // Render an element with both search box and search results in div with id 'test'.
        google.search.cse.element.render(
            {
              div: 'pencarian',
              tag: 'search'
            });
    }, true);
  }
};

// Insert it before the CSE code snippet so that cse.js can take the script
// parameters, like parsetags, callbacks.
window.__gcse = {
  parsetags: 'explicit',
  callback: myCallback
};

(function() {
  var cx = '$partnerid'; // Insert your own Custom Search engine ID here
  var gcse = document.createElement('script'); gcse.type = 'text/javascript';
  gcse.async = true;
  gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(gcse, s);
})();
</script>";

// $html = "<script src='https://www.google.com/jsapi' type='text/javascript'></script>
// <script type='text/javascript'> 
// google.load('search', '1', {language : 'id', style : src='$js/css/search.min.css'});
// google.setOnLoadCallback(function() {
// var customSearchOptions = {};  var customSearchControl = new google.search.CustomSearchControl(
  // '$partnerid', customSearchOptions);
// customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
// var options = new google.search.DrawOptions();
// options.enableSearchboxOnly('$seo');
// customSearchControl.draw('cse-search-form', options);
// }, true);
// google.load('search', '1', {language : 'id', style : google.loader.themes.V2_DEFAULT});
// google.setOnLoadCallback(function() {
// var customSearchOptions = {};  var customSearchControl = new google.search.CustomSearchControl(
  // '$partnerid', customSearchOptions);
// customSearchControl.setResultSetSize(google.search.Search.FILTERED_CSE_RESULTSET);
// customSearchControl.draw('cse');
// function parseParamsFromUrl() {
  // var params = {};
  // var parts = window.location.search.substr(1).split('\x26');
  // for (var i = 0; i < parts.length; i++) {
	// var keyValuePair = parts[i].split('=');
	// var key = decodeURIComponent(keyValuePair[0]);
	// params[key] = keyValuePair[1] ?
		// decodeURIComponent(keyValuePair[1].replace(/\+/g, ' ')) :
		// keyValuePair[1];
  // }
  // return params;
// }

// var urlParams = parseParamsFromUrl();
// var queryParamName = 'q';
// if (urlParams[queryParamName]) {
  // customSearchControl.execute(urlParams[queryParamName]);
// }
// }, true);
// </script>";
}else{
$html ='';
}
}
return $html;
}
function pesan(){
global $db;
$sql = $db->query("select * from kotak_masuk where status=0 order by id desc limit 5");
$hrml ='';
while($row=$sql->fetch_array()){
$html .= '<li><!-- start message -->
                        <a href="?panel=pesan&act=baca&id='.$row['id'].'">
                          <div class="pull-left">
                            <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
                          </div>
                          <h4>
                            '.$row['nama'].'
                            <small><i class="fa fa-clock-o"></i>'.$row['tanggal'].'</small>
                          </h4>
                          <p>'.kata($row['pesan'],50).'</p>
                        </a>
                      </li><!-- end message -->';
}
return $html;
}

function kontakwa($status,$js='',$slug=''){
global $db;
if($status==1){
$sql = $db->query("SELECT * FROM fo where pub='0' order by id asc");
$hrml ='';
while($data=$sql->fetch_array()){
$html .='<li class="col-sm-2 col-md-2 col-lg-2">
	<a href="#"><img src="'.$js.'/img/clients/'.$data['slug'].'.png" width="210" alt="" /></a>
	</li>';
}
return $html;
}elseif($status==2){
$sql = $db->query("SELECT * FROM `fo` where slug='$slug' AND pub='0'");
$data=$sql->fetch_array();
if($data['active']!=''){
	$act = $data['active'];
}else{
	$act = '';
}
	$plugin = "[".$data['data']."]";
	$var = json_decode($plugin);
	$namal = $var[0]->namal;
	$namap = $var[0]->namap;
	$telp = $var[0]->telp;
$html ='<div class="'.$act.' item">
		<div class="testimonial-item">
			<div class="icon"><i class="fa fa-quote-right"></i></div>
			<blockquote>
				<p>Hubungi Front Office kami :</p>
				<p>Call/SMS/WA</p>
				<p>'.$telp.'</p>
			</blockquote>
			<div class="testimonial-review">
				<img src="'.$js.'/img/clients/'.$slug.'_m.png" alt="'.$namal.'">
				<h1>'.$namal.'<small>'.$namap.'</small></h1>
				<a href="https://wa/me/'.cleans($telp).'?text=Assalamualaikum '.$namal.'"><img style="float:right" src="'.$js.'/img/wa.png" alt="'.$namal.'" width="50"></a>
			</div>
		</div>
</div>';
return $html;
}elseif($status==3){
$sql = $db->query("SELECT * FROM fo where pub='0' order by id asc");
$hrml ='';
while($data=$sql->fetch_array()){
if($data['active']!=''){
	$act = $data['active'];
}else{
	$act = '';
}
	$plugin = "[".$data['data']."]";
	$var = json_decode($plugin);
	$namal = $var[0]->namal;
	$namap = $var[0]->namap;
	$telp = $var[0]->telp;
$html .='<div class="'.$act.' item">
		<div class="testimonial-item">
			<div class="icon"><i class="fa fa-quote-right"></i></div>
			<blockquote>
				<p>Hubungi Front Office kami :</p>
				<p>Call/SMS/WA</p>
				<p>'.$telp.'</p>
			</blockquote>
			<div class="testimonial-review">
				<img src="'.$js.'/img/clients/'.$data['slug'].'_m.png" alt="'.$namal.'">
				<h1>'.$namal.'<small>'.$namap.'</small></h1>
				<a href="https://wa.me/'.cleans($telp).'?text=Assalamualaikum '.$namal.'"><img style="float:right" src="'.$js.'/img/wa.png" alt="'.$namal.'" width="50" data-placement="left" data-toggle="tooltip" title="Chat '.$namal.'"></a>
			</div>
		</div>
</div>';
}
return $html;
}elseif($status==4){
$sql = $db->query("SELECT * FROM fo where pub='0' order by id asc");
$html ='';
while($data=$sql->fetch_array()){
if($data['active']!=''){
	$act = $data['active'];
}else{
	$act = '';
}
	$plugin = "[".$data['data']."]";
	$var = json_decode($plugin);
	$namal = $var[0]->namal;
	$namap = $var[0]->namap;
	$telp = $var[0]->telp;
	$gbr = $var[0]->gambar;
$html .='<li class="col-sm-2 col-md-2 col-lg-2">
			<a href="https://api.whatsapp.com/send?phone='.cleans($telp).'&text=Assalamualaikum%20'.$namal.'" target="_blank" data-placement="bottom" data-toggle="tooltip"  title="Klik untuk Chat dengan '.$namal.'"><img src="'.$js.'/img/clients/'.$gbr.'" width="200" alt="" /></a>
		 </li>';
}
return $html;
}elseif($status==5){
$sql = $db->query("SELECT * FROM fo where pub='0' order by id asc");
$html ='';
while($data=$sql->fetch_array()){
if($data['active']!=''){
	$act = $data['active'];
}else{
	$act = '';
}
	$plugin = "[".$data['data']."]";
	$var = json_decode($plugin);
	$namal = $var[0]->namal;
	$namap = $var[0]->namap;
	$telp = $var[0]->telp;
	$gbr = $var[0]->gambar;
$html .='<li class="fab-buttons__item hidden-xs">
      <a href="https://api.whatsapp.com/send?phone='.cleans($telp).'&text=Assalamualaikum%20'.$namal.'" class="fab-buttons__link" data-tooltip="'.$namal.'">
        <i class="icon-material icon-material_'.$data['slug'].'"></i>
      </a>
    </li>';
}
return $html;
}elseif($status==6){
$sql = $db->query("SELECT * FROM fo where pub='0' order by id asc");
$html ='';
while($data=$sql->fetch_array()){
if($data['active']!=''){
	$act = $data['active'];
}else{
	$act = '';
}
	$plugin = "[".$data['data']."]";
	$var = json_decode($plugin);
	$namal = $var[0]->namal;
	$namap = $var[0]->namap;
	$telp = $var[0]->telp;
	$gbr = $var[0]->gambar;
$html .='<li class="fab-buttons__item hidden-md">
      <a href="https://wa.me/'.cleans($telp).'?text=Assalamualaikum%20'.$namal.'" class="fab-buttons__link" data-tooltip="'.$namal.'">
        <i class="icon-material icon-material_'.$data['slug'].'"></i>
      </a>
    </li>';
}
return $html;
}elseif($status==7){
$sql = $db->query("SELECT * FROM fo where pub='0' order by id asc");
$html ='';
while($data=$sql->fetch_array()){
if($data['active']!=''){
	$act = $data['active'];
}else{
	$act = '';
}
	$plugin = "[".$data['data']."]";
	$var = json_decode($plugin);
	$namal = $var[0]->namal;
	$namap = $var[0]->namap;
	$telp = $var[0]->telp;
	$gbr = $var[0]->gambar;
$html .='<li class="hidden-xs"><a class="'.$data['slug'].'" href="https://api.whatsapp.com/send?phone='.cleans($telp).'&text=Assalamualaikum%20'.$namal.'%20Mau%20tanya%20bingkai%20ini%20'.$js.'"  data-placement="bottom" data-toggle="tooltip" title="Chat '.$namal.'" target="_blank"></a></li>';
}
return $html;
}elseif($status==8){
$sql = $db->query("SELECT * FROM fo where pub='0' order by id asc");
$html ='';
while($data=$sql->fetch_array()){
if($data['active']!=''){
	$act = $data['active'];
}else{
	$act = '';
}
	$plugin = "[".$data['data']."]";
	$var = json_decode($plugin);
	$namal = $var[0]->namal;
	$namap = $var[0]->namap;
	$telp = $var[0]->telp;
	$gbr = $var[0]->gambar;
$html .='<li class="hidden-xs"><a class="'.$data['slug'].'" href="https://api.whatsapp.com/send?phone='.cleans($telp).'&text=Assalamualaikum%20'.$namal.'"  data-placement="bottom" data-toggle="tooltip" title="Chat '.$namal.'"></a></li>';
}
return $html;
}
}
?>