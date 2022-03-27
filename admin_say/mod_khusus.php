<?php
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=http://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
//error_reporting(0);
if (empty($_SESSION['namauser']) AND empty($_SESSION['passuser'])){
header('location:../login.php');
}else{
function imgMulti($func,$type,$dir){
$open = '<script type="text/javascript">
function '.$func.'(textarea) {
    window.KCFinder = {
        callBackMultiple: function(files) {
            window.KCFinder = null;
            textarea.value = "";
            for (var i = 0; i < files.length; i++)
                textarea.value += files[i] + "#\n";
        }
    };
    window.open("../kcfinder/browse.php?type='.$type.'&dir='.$dir.'",
        "kcfinder_multiple", "status=0, toolbar=0, location=0, menubar=0, " +
        "directories=0, resizable=1, scrollbars=0, width=800, height=600"
    );
}
</script>';
return $open;
}
function ImgUser($func,$type,$dir){
?>
<script type="text/javascript">

function <?=$func;?>(field) {
    window.KCFinder = {
        callBack: function(url) {
            field.value = url;
            window.KCFinder = null;
        }
    };
    window.open('../kcfinder/browse.php?type=images&dir=images/user', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}

</script>
<?php
}
function ImgAgen($func,$type,$dir){
?>
<script type="text/javascript">

function <?=$func;?>(field,link,id) {
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            field.value = link+url;
            var img = new Image();
            img.src = url;
            img.onload = function() {
				$('#imgs'+id).attr('src', link+url);
            }
        }
    };
    window.open('../kcfinder/browse.php?type=<?=$type;?>&dir=<?=$dir;?>', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}

</script>
<?php
}
function LinkImg($func,$type,$dir){ ?>
<script type="text/javascript">
function <?=$func;?>(field,link) {
    window.KCFinder = {
        callBack: function(url) {
            field.value = link+url;
            window.KCFinder = null;
        }
    };
    window.open('../kcfinder/browse.php?type=<?=$type;?>&dir=<?=$type;?>', 'kcfinder_textbox',
        'status=0, toolbar=0, location=0, menubar=0, directories=0, ' +
        'resizable=1, scrollbars=0, width=800, height=600'
    );
}

</script>
<?php }
function IMGopen($func,$type,$dir){
?>
<script type="text/javascript">
function <?=$func;?>(div) {
    window.KCFinder = {
        callBack: function(url) {
            window.KCFinder = null;
            div.innerHTML = '<div style="margin:5px">Loading...</div>';
            var img = new Image();
            img.src = url;
            img.onload = function() {
                div.innerHTML = '<img id="img" src="' + url + '" />';
                var img = document.getElementById('img');
                var o_w = img.offsetWidth;
                var o_h = img.offsetHeight;
                var f_w = div.offsetWidth;
                var f_h = div.offsetHeight;
                if ((o_w > f_w) || (o_h > f_h)) {
                    if ((f_w / f_h) > (o_w / o_h))
                        f_w = parseInt((o_w * f_h) / o_h);
                    else if ((f_w / f_h) < (o_w / o_h))
                        f_h = parseInt((o_h * f_w) / o_w);
                    img.style.width = f_w + "px";
                    img.style.height = f_h + "px";
                } else {
                    f_w = o_w;
                    f_h = o_h;
                }
                img.style.marginLeft = parseInt((div.offsetWidth - f_w) / 2) + 'px';
                img.style.marginTop = parseInt((div.offsetHeight - f_h) / 2) + 'px';
                img.style.visibility = "visible";
				document.getElementById("imgs").value=url;
            }
        }
    };
    window.open('../kcfinder/browse.php?type=<?=$type;?>&dir=<?=$dir;?>',
        'kcfinder_image', 'status=0, toolbar=0, location=0, menubar=0, ' +
        'directories=0, resizable=1, scrollbars=0, width=800, height=600'
    );
	
}
</script>
<?php
}
}
?>
