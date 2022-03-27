<?php 
function check_sesi(){
        $hasil = 0;
		if (isset($_SESSION['mailuser'])) {
        $mail = $_SESSION['mailuser'];
        }
        if (isset($_SESSION['passuser'])) {
        $pass = $_SESSION['passuser'];
        }
        if (isset($_SESSION['namauser'])) {
        $user = $_SESSION['namauser'];
        }
		if (isset($_SESSION['leveluser'])) {
        $admin = $_SESSION['leveluser'];
        }
		if (isset($_SESSION['leveluser'])) {
        $user = $_SESSION['leveluser'];
        }    
        if (!empty($mail) and !empty($pass)){
            $hasil = 'muser';
        }
		if (empty($pass) and empty($user)){
            $hasil = 'puser';
			return true;
        }
		if (!empty($admin)){
            $hasil = 'admin';
        }
		if (!empty($user)){
            $user = 'user';
        }
		if (!empty($mail)){
            $hasil = 'mail';
        }

        return $hasil;
}