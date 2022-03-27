<html>
<head>
<script>
function sav() {
    str = document.getElementById("harga").value; 
    str2 = document.getElementById("jumlah").value; 
    str3 = document.getElementById("diskon").value; 
    str4 = document.getElementById("nta").value; 
    str5 = document.getElementById("tax").value; 
    str6 = document.getElementById("keterangan").value; 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","save.php?harga="+str+"&jumlah="+str2+"&diskon="+str3+"&nta="+str4+"&tax="+str5+"&keterangan="+str6,true);
	//	xmlhttp.open("GET","saveView.php?q=itemid="+itemid+"&userid="+userid,true);
        xmlhttp.send();
    
}
</script>
</head>
<body>

<form>
<input type="text" name="harga" id="harga" onkeyup="sav()">
<input type="text" name="jumlah" id="jumlah" onkeyup="sav()">
<input type="text" name="diskon" id="diskon" onkeyup="sav()">
<input type="text" name="nta" id="nta" onkeyup="sav()">
<input type="text" name="tax" id="tax" onkeyup="sav()">
<input type="text" name="keterangan" id="keterangan" onkeyup="sav()">
</form>
<br>
<div id="txtHint"><b>Person info will be listed here...</b></div>

</body>
</html>