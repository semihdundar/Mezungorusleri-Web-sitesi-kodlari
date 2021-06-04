<?php
if($_GET && !empty($_GET["sayfa"]))
{
 $sayfa=$_GET["sayfa"];
 if(file_exists(SAYFA.$sayfa.".php"))
 {
 	switch ($sayfa) {
 		case 'kurumsal':
 			if(!empty($_GET["seflink"]))
 			{
 				$seflink=$VT->filter($_GET["seflink"]);
	$bilgi=$VT->VeriGetir("kurumsal","WHERE seflink=? AND durum=?",array($seflink,1),"ORDER BY ID ASC",1);
				if($bilgi!=false)
				{
					$sitebaslik=stripslashes($bilgi[0]["baslik"])." - ".$sitebaslik;
					$sitedescription=stripslashes($bilgi[0]["description"]);
					$siteanahtar=stripslashes($bilgi[0]["anahtar"]);
				}
 			}
 			break;
 			case 'universite-detay':
 			if(!empty($_GET["seflink"]))
 			{
 				$seflink=$VT->filter($_GET["seflink"]);
	$bilgi=$VT->VeriGetir("universiteler","WHERE seflink=? AND durum=?",array($seflink,1),"ORDER BY ID ASC",1);
				if($bilgi!=false)
				{
					$sitebaslik=stripslashes($bilgi[0]["baslik"])." - ".$sitebaslik;
					$sitedescription=stripslashes($bilgi[0]["description"]);
					$siteanahtar=stripslashes($bilgi[0]["anahtar"]);
				}
 			}
 			break;
 			case "universiteler":
 				$sitebaslik="Üniversiteler - ".$sitebaslik;
				$sitedescription="Merak ettiğiniz üniversiteler hakkında herşey";
				$siteanahtar="üniversite, üniversite mezunları, ".$siteanahtar;
 			break;
			case "fakulte-detay":
				$seflink=$VT->filter($_GET["universite"]);
				$bilgi=$VT->VeriGetir("universiteler","WHERE seflink=? AND durum=?",array($seflink,1),"ORDER BY ID ASC",1);
				if($bilgi!=false)
				{
					$seflink2=$VT->filter($_GET["seflink"]);
					$bilgi2=$VT->VeriGetir("fakulteler","WHERE seflink=? AND universiteID=?",array($seflink2,$bilgi[0]["ID"]),"ORDER BY ID ASC",1);
					if($bilgi2!=false)
					{
						$sitebaslik=stripslashes($bilgi2[0]["baslik"])." - ".stripslashes($bilgi[0]["baslik"])." - ".$sitebaslik;
					$sitedescription=stripslashes($bilgi2[0]["baslik"]);
					$siteanahtar="fakülte, fakülte mezunları,".stripslashes($bilgi2[0]["baslik"]);
					}
					else
					{
						$sitebaslik="Fakülteler - ".stripslashes($bilgi[0]["baslik"])." - ".$sitebaslik;
					$sitedescription="Fakülteler - ".stripslashes($bilgi[0]["description"]);
					$siteanahtar="fakülte, fakülte mezunları,".stripslashes($bilgi[0]["anahtar"]);
					}
					
				}
				else
				{
 				$sitebaslik="Fakülteler - ".$sitebaslik;
				$sitedescription="Merak ettiğiniz fakülteler hakkında herşey";
				$siteanahtar="fakülte, fakülte mezunları, ".$siteanahtar;
				}
 			break;
 			case "uyelik":
 				$sitebaslik="Giriş Yap / Üye Ol - ".$sitebaslik;
				$sitedescription="Hemen yeni bir hesap oluşturun yada giriş yapın.";
				$siteanahtar="üyelik, e-ticaret üyelik, giriş yap, ".$siteanahtar;
 			break;
 			case "hesabim":
 				$sitebaslik="Hesabım - ".$sitebaslik;
				$sitedescription="Hesabınızı yönetmek için hemen başla.";
				$siteanahtar="hesabım, üyelik, e-ticaret hesabım, giriş yap, ".$siteanahtar;
 			break;
 			case "cikis":
 				$sitebaslik="Çıkış - ".$sitebaslik;
				$sitedescription="Hesabınızdan güvenle çıkış yapın.";
				$siteanahtar="hesabım, üyelik, e-ticaret hesabım, çıkış yap, ".$siteanahtar;
 			break;
 			case "sifre-belirle":
 				$sitebaslik="Şifre Belirle - ".$sitebaslik;
				$sitedescription="Hesabınızı güvene almak için yeni bir şifre belirleyin.";
				$siteanahtar="hesabım, üyelik, e-ticaret hesabım, şifre belirle, şifre iste, ".$siteanahtar;
 			break;
 			case "iletisim":
 				$sitebaslik="İletişim - ".$sitetelefon." - ".$sitebaslik;
				$sitedescription="Destek için bizimle iletişime geçin. ".$sitetelefon." | ".$siteadres;
				$siteanahtar="iletişim, ".$sitetelefon.", ".$sitemail.", ".$siteadres.", alışveriş listesi ".$siteanahtar;
 			break;
 		default:
 			/*N*/
 			break;
 	}
 }
}

?>