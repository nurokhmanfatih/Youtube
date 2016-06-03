<?php
function date_id ( $date )
  {
    $en = array('January','February','March','May','June','July','August','October','December','Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
    $id = array('Januari','Februari','Maret','Mei','Juni','Juli','Agustus','Oktober','Desember','Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu');
    return str_replace ( $en, $id, $date );
  }
 function Terbilang($satuan){
	$huruf = array ("", "satu", "dua", "tiga", "empat", "lima", "enam", 
	"tujuh", "delapan", "sembilan", "sepuluh","sebelas");
	if ($satuan < 12)
	 return " ".$huruf[$satuan];
	elseif ($satuan < 20)
	 return Terbilang($satuan - 10)." belas";
	elseif ($satuan < 100)
	 return Terbilang($satuan / 10)." puluh".
	 Terbilang($satuan % 10);
	elseif ($satuan < 200)
	 return " seratus".Terbilang($satuan - 100);
	elseif ($satuan < 1000)
	 return Terbilang($satuan / 100)." ratus".
	 Terbilang($satuan % 100);
	elseif ($satuan < 2000)
	 return " seribu".Terbilang($satuan - 1000); 
	elseif ($satuan < 1000000)
	 return Terbilang($satuan / 1000)." ribu".
	 Terbilang($satuan % 1000); 
	elseif ($satuan < 1000000000)
	 return Terbilang($satuan / 1000000)." juta".
	 Terbilang($satuan % 1000000); 
	elseif ($satuan >= 1000000000)
	 echo "Angka terlalu Besar";
	}
 ?>