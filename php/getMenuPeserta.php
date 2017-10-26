<?php 
session_start(); 
if(isset($_SESSION['user'])){?>
<a href="nilai">Nilai</a>
<a href="#settings" modal-toggle="#setPeserta">Pengaturan</a>
<a href="logout"><span class="fa fa-sign-out"></span> Keluar</a>
<?php }else{ ?>
<a href="#" modal-toggle="#login">Masuk</a>
<a href="#" modal-toggle="#register">Daftar</a>
<?php } ?>