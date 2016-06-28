<?php
//ambil file
$content = file_get_contents("http://aplikasiwebbase.com/webrfid.zip");
//simpan di server hosting baru.
$fp = fopen("/home/siskomka15/public_html/pindah.php", "w");
fwrite($fp, $content);
fclose($fp); ?>