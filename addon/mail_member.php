<?php
error_reporting(0);
//Deteksi hanya bisa diinclude, tidak bisa langsung dibuka (direct open)
if(count(get_included_files())==1)
{
	echo "<meta http-equiv='refresh' content='0; url=https://$_SERVER[HTTP_HOST]'>";
	exit("Direct access not permitted.");
}
$isiMail = '<table style="width:100%;background:#dddddd" cellspacing="0" cellpadding="0" bgcolor="#DDDDDD" border="0" width="100%">
    <tbody>
        <tr>
            <td>
                <table style="width:100%;padding:10px" cellspacing="0" cellpadding="0" align="center" border="0" width="550">
                    <tbody>
                        <tr>
                            <td>
                                <div style="direction:ltr;max-width:600px;margin:0 auto">
                                    <table style="width:100%;background-color:#fff;text-align:left;margin:0 auto;max-width:1024px;min-width:320px" cellspacing="0" cellpadding="0" bgcolor="#ffffff" border="0">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <table style="width:100%;background-color:#77D044;height:8px" cellspacing="0" cellpadding="0" height="8" border="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table style="width:100%" cellspacing="0" cellpadding="20" bgcolor="#ffffff" border="0" width="100%">
                                                        <tbody>
                                                            <tr>
                                                                <td style="padding:20px" valign="top">
                                                                    <h2>Konfirmasi Verifikasi Member!</h2>
                                                                    <p style="direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;margin:0 0 1em 0;margin:0 0 20px 0">
                                                                        Email anda <b>'.$var['email'].'</b> Sudah Aktif dan menjadi reseller di sayuti.com
                                                                    </p>
                                                                    <p style="direction:ltr;font-size:14px;line-height:1.4em;color:#444444;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;margin:0 0 1em 0;margin:5px 0 10px 0;text-align:center">
                                                                        <a href="https://sayuti.com/" style="text-decoration:underline;color:#5F8A0F;border-radius:10em;border:1px solid #77D044;text-decoration:none;color:#fff;background-color:#5F8A0F;padding:5px 15px;font-size:16px;line-height:1.4em;font-family:Helvetica Neue,Helvetica,Arial,sans-serif;font-weight:normal" target="_blank">LOGIN AKUN</a>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
<table style="width:100%;background-color:#77D044;height:3px"  width="100%" cellspacing="5" cellpadding="5">
  <tr>
    <td><font face="Arial, Helvetica, sans-serif" size="2" color="#FFFF00"><strong>Informasi</strong><br />
</font> <font face="Arial, Helvetica, sans-serif" size="1" color="#fff"><b>CALL/SMS/WA</b> : 087771262100</font></td>
  </tr>
  <tr>
    <td bgcolor="#333333"><font face="Arial, Helvetica, sans-serif" size="2" color="#FFFF00"><strong>PEMBAYARAN</strong>
</font> <font face="Arial, Helvetica, sans-serif" size="1" color="#fff"><b>Rek. Mandiri</b> : 163-000-1980-005 a.n Ahmad Sayuti</font></td>
  </tr>
</table>
                                    <table style="width:100%;background-color:#77D044;height:3px" cellspacing="0" cellpadding="0" height="3" border="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table style="width:100%;padding-bottom:2em;color:#77D044;font-size:12px;height:18px;text-align:center;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif" cellspacing="0" cellpadding="0" align="center" border="0" width="100%">
                    <tbody>
                        <tr>
                            <td align="center"><a href="https://sayuti.com" style="text-decoration:underline;color:#77D044;font-size:14px;color:#77D044!important;text-decoration:none;font-family:&quot;Helvetica Neue&quot;,Helvetica,Arial,sans-serif;color:#555!important;font-size:14px;text-decoration:none" target="_blank">Terima Kasih telah mendaftar di <img src="https://en.gravatar.com/userimage/117832634/07fb710c4c7a645794632e00ef8f10d6.jpg" alt="" style="vertical-align:middle" height="16" border="0" width="16"> sayuti.com</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>';
?>