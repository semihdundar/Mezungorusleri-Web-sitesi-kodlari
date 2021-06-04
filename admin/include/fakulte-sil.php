<?php
if(!empty($_GET["ID"]))
{
	$ID=$VT->filter($_GET["ID"]);
	
	
		$veri=$VT->VeriGetir("fakulteler","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
		if($veri!=false)
		{
			$sil=$VT->SorguCalistir("DELETE FROM fakulteler","WHERE ID=?",array($ID),1);
			?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>fakulte-liste">
        <?php
		}
		else
		{
			?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>fakulte-liste">
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