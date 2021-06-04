<?php
@session_start();
@ob_start();
define("DATA","data/");
define("SAYFA","include/");
define("SINIF","class/");
include_once(DATA."baglanti.php");
define("SITE",$siteURL."admin/");
define("ANASITE",$siteURL);
if(!empty($_POST["tablo"]) && !empty($_POST["ID"]) && $_FILES && !empty($_FILES["file"]["tmp_name"]))
	{
			 $tablo=$VT->filter($_POST["tablo"]);
 			 $ID=$VT->filter($_POST["ID"]);
 			 $resim=$VT->uploadMulti("file",$tablo,$ID,"../images/resimler/");
				 
	}
if($_POST)
{
	
	if(!empty($_POST["tablo"]) && !empty($_POST["ID"]) && !empty($_POST["durum"]))
	{
		$tablo=$VT->filter($_POST["tablo"]);
		$ID=$VT->filter($_POST["ID"]);
		$durum=$VT->filter($_POST["durum"]);
		$guncelle=$VT->SorguCalistir("UPDATE ".$tablo,"SET durum=? WHERE ID=?",array($durum,$ID),1);
		if($guncelle!=false)
		{
			echo "TAMAM";
		}
		else
		{
			echo "HATA";
		}
	}
	else
	{
		echo "BOS";
	}
}
?>