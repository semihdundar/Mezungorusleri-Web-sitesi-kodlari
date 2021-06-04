<?php
@session_start();
@ob_start();
define("DATA","data/");
define("SAYFA","include/");
define("SINIF","admin/class/");
include_once(DATA."baglanti.php");
define("SITE",$siteurl);

if($_POST)
{
	if(!empty($_POST["islemtipi"]))
	{
		$islemtipi=$VT->filter($_POST["islemtipi"]);

		switch ($islemtipi) {
				case "sifreIste":
				if(!empty($_POST["mailadresi"]))
				{
					$mail=$VT->filter($_POST["mailadresi"]);
					$kontrol=$VT->VeriGetir("uyeler","WHERE mail=? AND durum=?",array($mail,1),"ORDER BY ID ASC",1);
					if($kontrol!=false)
					{
						$dogrulamaKodu="RFR".rand(10000,99999);/*RFT56985*/
						$mailGonder=$VT->MailGonder($kontrol[0]["mail"],"Şifre Doğrulama","Doğrulama Kodunuz : ".$dogrulamaKodu);
						$_SESSION["dogrulamaKodu"]=$dogrulamaKodu;
						$_SESSION["uyeninSifresiIcinID"]=$kontrol[0]["ID"];
						echo "TAMAM";
					}
					else
					{
						echo "ERROR";
					}
				}
				else
				{
					echo "ERROR";
				}
				break;
			default:
				echo "ERROR";
				break;
		}

	}
	else
	{
		echo "ERROR";
	}


}
else
{
	echo "ERROR";
}


?>