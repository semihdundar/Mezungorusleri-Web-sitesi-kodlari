<?php
if(!empty($_GET["universite"]) && !empty($_GET["seflink"]))
{
	$universite=$VT->filter($_GET["universite"]);
	$seflink=$VT->filter($_GET["seflink"]);
	$bilgi=$VT->VeriGetir("universiteler","WHERE seflink=? AND durum=?",array($universite,1),"ORDER BY ID ASC",1);
	if($bilgi!=false)
	{
		$fakulte=$VT->VeriGetir("fakulteler","WHERE seflink=? AND durum=? AND universiteID=?",array($seflink,1,$bilgi[0]["ID"]),"ORDER BY ID ASC",1);
		if($fakulte!=false)
		{
		if(!empty($bilgi[0]["resim"])){$resim=$bilgi[0]["resim"];}else{$resim="varsayilan.png";}
		?>
        <?php
				$puanlaruni=$VT->VeriGetir2("urunID, SUM(puan) AS puan, SUM(durum) AS durumtoplam, durum","yorumlar","WHERE durum=? AND urunID=?",array(1,$fakulte[0]["ID"]),"GROUP BY urunID ORDER BY puan DESC",1);
						if($puanlaruni!=false){$puanA=$puanlaruni[0]["puan"]; $bolumA=$puanlaruni[0]["durumtoplam"];}else{$puanA=0;$bolumA=1;}
						$puanToplam=round($puanA/$bolumA);
				?>
               
<div class="blog-banner-area">
	<div class="overlay1"></div>
		<div class="container" style="z-index: 9; position: absolute; left: 0; right: 0;">
			<div class="row">
				<div class="com-md-12">
					<div class="breadcrumb-area text-center">
					   <h2 style="color:#fff !important;"><?=stripslashes($fakulte[0]["baslik"])?></h2>
                       <p style="color:#fff;"><?=stripslashes($bilgi[0]["baslik"])?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
    <?php
	if($_POST)
	{
		 if(!empty($_SESSION["uyeID"]))
         {
			if(!empty($_POST["metin"]))
			{
				$metin=$VT->filter($_POST["metin"]);
				$puan=$VT->filter($_POST["puan"]);
				$uyeID=$VT->filter($_SESSION["uyeID"]);
				if($puan<0 || $puan>5){$puan=5;}
				$yorumkaydet=$VT->SorguCalistir("INSERT INTO yorumlar","SET uyeID=?, universiteID=?, urunID=?, puan=?, metin=?, durum=?, tarih=?",array($uyeID,$bilgi[0]["ID"],$fakulte[0]["ID"],$puan,$metin,2,date("Y-m-d")));
				
			}
		 }
	}
	?>
    <img src="<?=SITE?>images/universiteler/<?=$resim?>" class="unilogo" alt="<?=stripslashes($bilgi[0]["baslik"])?>">
    
  <section class="blog-container pt-1" style="background:#F0F2F5;">
		<div class="container">
			<div class="row">
				<div class="col-md-3">
                
                <h3 style="padding-bottom: 5px; border-bottom: 1px solid #ddd; margin-bottom: 10px;">Fakülte Puanı</h3>
                 <p style="padding-bottom: 5px; margin-bottom: 20px;">
                <span style="margin-top: 6px; color:#ff9800;"><?php
                                if($puanToplam==5)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    /<strong><?=$puanToplam.".0"?></strong>
                                    <?php
								}
								else if($puanToplam==4)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    /<strong><?=$puanToplam.".0"?></strong>
                                    <?php
								}
								else if($puanToplam==3)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    /<strong><?=$puanToplam.".0"?></strong>
                                    <?php
								}
								else if($puanToplam==2)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    /<strong><?=$puanToplam.".0"?></strong>
                                    <?php
								}
								else if($puanToplam==1)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    /<strong><?=$puanToplam.".0"?></strong>
                                    <?php
								}
		
								else
								{
									?>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
									/<strong><?="0.0"?></strong>
                                    <?php
								}
								?>
                                
                                </span>
                </p>
                <h3 style="padding-bottom: 5px; border-bottom: 1px solid #ddd; margin-bottom: 10px;">Diğer Fakülteler</h3>
                <ul class="digerbolum">
                <?php
				$fakulteler=$VT->VeriGetir("fakulteler","WHERE durum=? AND universiteID=? AND ID<>?",array(1,$bilgi[0]["ID"],$fakulte[0]["ID"]),"ORDER BY sirano ASC");
				if($fakulteler!=false)
				{
					for ($i=0;$i<count($fakulteler);$i++) { 
						
						?>
						<li><a href="<?=SITE?>fakulte-detay/<?=$bilgi[0]["seflink"]?>/<?=$fakulteler[$i]["seflink"]?>"><i class="fa fa-angle-right"></i> <?=stripslashes($fakulteler[$i]["baslik"])?></a></li>
						<?php
					}
				}
				?>
                </ul>
                <hr />
                
                <?php
				$sql=$VT->VeriGetir("resimler","WHERE tablo=? AND KID=?",array("universiteler",$bilgi[0]["ID"]),"ORDER BY ID ASC");
				if($sql!=false)
				{
					?>
                    <h3 style="padding-bottom: 5px; border-bottom: 1px solid #ddd; margin-bottom: 10px;">Üniversite Galerisi</h3>
                    <div class="row">
                    <div class="col-md-12">
                    <div class="partner-slider">
						
                    <?php
					for($x=0;$x<count($sql);$x++)
					{
						if(!empty($sql[$x]["resim"]))
					{
						$resim=$sql[$x]["resim"];
					}
					else
					{
						$resim="varsayilan.png";
					}
						?>
                        <div class="partner-item">
							<a href="<?=SITE?>images/resimler/<?=$resim?>" class="highslide" onclick="return hs.expand(this)">
								<i><img src="<?=SITE?>images/resimler/<?=$resim?>" alt="galeri" /></i>
							</a>
						</div>
						<?php
					}
					?>
                    </div>
                    </div>
                    </div>
					<?php
				}
				?>
                </div>
                <div class="col-md-5">
                <div class="row">
                <?php
            if(!empty($_SESSION["uyeID"]))
            {
				if(!empty($_SESSION["uyeResim"]))
							{
								$uyeresimR=$_SESSION["uyeResim"];
							}
							else
							{
								$uyeresimR="avatar.png";
							}
               ?>
               <div class="col-md-12 sosyalCanv">
                <div class="row">
                <div class="col-md-2">
                <img src="<?=SITE?>images/uyeler/<?=$uyeresimR?>" style="width: 100%; height: 50px; margin: 10px 0px;  border-radius: 100%;" />
                </div>
                <div class="col-md-10">
                <div class="nedusunuyon"  data-toggle="modal" data-target="#exampleModal">
                Ne düşünüyorsun <?=$_SESSION["uyeAdi"]?>?
                </div>
                </div>
                </div>
                </div>
               <?php
            }
           
            ?>
                
                
                <?php
				/*burada bölüm hakkında paylaşılan yorumlar yer alacak*/
				$yorumlar=$VT->VeriGetir("yorumlar","WHERE urunID=? AND durum=?",array($fakulte[0]["ID"],1),"ORDER BY ID DESC");
				if($yorumlar!=false)
				{
					for($i=0;$i<count($yorumlar);$i++)
					{
						$uyeBilgisi=$VT->VeriGetir("uyeler","WHERE ID=?",array($yorumlar[$i]["uyeID"]),"ORDER BY ID ASC",1);
						if($uyeBilgisi!=false)
						{
							if(!empty($uyeBilgisi[0]["resim"]))
							{
								$uyeresim=$uyeBilgisi[0]["resim"];
							}
							else
							{
								$uyeresim="avatar.png";
							}
						?>
                        <div class="col-md-12 sosyalCanv">
                        <div class="row">
                            <div class="col-md-2">
                            <img src="<?=SITE?>images/uyeler/<?=$uyeresim?>" style="width: 100%; height: 50px; margin: 10px 0px;  border-radius: 100%;" />
                            </div>
                            <div class="col-md-10">
                            	<strong style="margin-top: 20px; display: block;"><?=$uyeBilgisi[0]["ad"]." ".$uyeBilgisi[0]["soyad"]?></strong>
                                <span style="font-size: 11px;"><?=date("d/m/Y",strtotime($yorumlar[$i]["tarih"]))?></span>
                                
                                <span class="puandurum" title="<?=$yorumlar[$i]["puan"]?> Puan Verdi">
                                <?php
								if($yorumlar[$i]["puan"]==5)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <?php
								}
								else if($yorumlar[$i]["puan"]==4)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <?php
								}
								else if($yorumlar[$i]["puan"]==3)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <?php
								}
								else if($yorumlar[$i]["puan"]==2)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <?php
								}
								else if($yorumlar[$i]["puan"]==1)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <?php
								}
								else
								{
									?>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
									/<strong><?="0.0"?></strong>
                                    <?php
								}
								?>
                                
                                </span>
                                
                                
                            </div>
                            <div class="col-md-12">
                            <p><?=stripslashes($yorumlar[$i]["metin"])?></p>
                            <?php
							$uyeninUniversitesi=$VT->VeriGetir("universiteler","WHERE ID=?",array($uyeBilgisi[0]["universiteID"]),"ORDER BY ID ASC",1);
							if($uyeninUniversitesi!=false)
							{
								?>
                                <div class="col-md-12" style="border-top: 1px solid #eee; font-size: 12px; padding: 6px 0px; margin-top: 10px;">
                                <?=stripslashes($uyeninUniversitesi[0]["baslik"])?> - <?=stripslashes($uyeBilgisi[0]["bolum"])?>
                                </div>
                                <?php
							}
							?>
                            </div>
                        </div>
                        </div>
                        <?php
						}
					}
				}
				else
				{
					?>
                    <p style="font-size: 16px; font-weight: 500; text-align: center;">Bu fakülte için hiç yorum yapılmadı. <?php if(!empty($_SESSION["uyeID"])){ echo "<br />İlk yorum yapan sen olmaya ne dersin?"; }else{?><br />Hemen <a href="<?=SITE?>uyelik">giriş yap</a> ve ilk yorumu sen yap.<?php } ?></p>
                    <?php
				}
				?>
                
                </div>
                </div>
                
                <div class="col-md-4">
                <h3 style="padding-bottom: 5px; border-bottom: 1px solid #ddd; margin-bottom: 10px;">Diğer Üniversiteler</h3>
                <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Üniversite Ara" class="form-control" style="float: right; width: 50%; margin-top: -50px; padding-right: 24px;">
                <i class="fa fa-search" style="position: absolute;right: 23px;top: 5px;"></i>
                <ul class="digerbolum" id="myUL">
                <?php
				$fakulteler=$VT->VeriGetir("universiteler","WHERE durum=? AND ID<>?",array(1,$bilgi[0]["ID"]),"ORDER BY baslik ASC");
				if($fakulteler!=false)
				{
					for ($i=0;$i<count($fakulteler);$i++) { 
						
						?>
						<li><a href="<?=SITE?>universite-detay/<?=$fakulteler[$i]["seflink"]?>" style="color:#65676b;"><i class="fa fa-angle-right"></i> <?=stripslashes($fakulteler[$i]["baslik"])?></a></li>
						<?php
					}
				}
				?>
                </ul>
                </div>
				
			</div>
		</div>
	</section>  
    
    
     <?php
            if(!empty($_SESSION["uyeID"]))
            {
               ?>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel" style="float: left; color: #000">Gönderi Oluştur</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="#" method="post" enctype="multipart/form-data">
      <div class="modal-body">
        <textarea name="metin" class="metinAlani" required="required" placeholder="Bir gönderi mesajı yazınız." style="width: 100%; height: 100px; border: 0;"></textarea>
      </div>
      <div class="modal-footer">
      <select name="puan" class="form-control" style="float:left;width: 80%;">
      <option value="5">5 Puan</option>
      <option value="4">4 Puan</option>
      <option value="3">3 Puan</option>
      <option value="2">2 Puan</option>
      <option value="1">1 Puan</option>
      </select>
        <button type="submit" class="btn btn-primary"><i class="fa fa-share"></i> Paylaş</button>
		  
		  <?php
if($_POST)
{
    echo '<script>alert("Yorumunuz Onaylandıktan sonra yayınlanacaktır."); </script>';
}
?>
		  
      </div>
      </form>
    </div>
  </div>
</div>
		<?php
			}
		}
	}
}
?>
