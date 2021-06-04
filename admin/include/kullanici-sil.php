<?php
if(!empty($_GET["ID"]) && $_SESSION["ID"]==1)
{
	
	$ID=$VT->filter($_GET["ID"]);
	
		$veri=$VT->VeriGetir("kullanicilar","WHERE ID=? AND ID<>?",array($ID,1),"ORDER BY ID ASC",1);
		if($veri!=false)
		{
			$sil=$VT->SorguCalistir("DELETE FROM kullanicilar","WHERE ID=?",array($ID),1);
			?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>kullanici-liste">
        <?php
		}
		else
		{
			?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>kullanici-liste">
        <?php
		}
 
	
}
else
{
	?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>">
        <?php
}
 ?>