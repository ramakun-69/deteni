<?php
$dir = "../../file/";
$nama_file = $_GET['file'];
$path_file = $dir . $nama_file;
$ctype = "application/octet-stream";
if (!empty($path_file) && file_exists($path_file)) { /*check keberadaan file*/
    header("Pragma:public");
    header("Expired:0");
    header("Cache-Control:must-revalidate");
    header("Content-Control:public");
    header("Content-Description: File Transfer");
    header("Content-Type: $ctype");
    header("Content-Disposition:attachment; filename=\"" . basename($path_file) . "\"");
    header("Content-Transfer-Encoding:binary");
    header("Content-Length:" . filesize($path_file));
    flush();
    readfile($path_file);
    exit();
} else {
    echo "File Tidak Ditemukan!";
}
