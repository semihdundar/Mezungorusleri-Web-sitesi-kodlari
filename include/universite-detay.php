<?php
if(!empty($_GET["seflink"]))
{
	$seflink=$VT->filter($_GET["seflink"]);
	$bilgi=$VT->VeriGetir("universiteler","WHERE seflink=? AND durum=?",array($seflink,1),"ORDER BY ID ASC",1);
	if($bilgi!=false)
	{
		if(!empty($bilgi[0]["resim"])){$resim=$bilgi[0]["resim"];}else{$resim="varsayilan.png";}
		?>
<div class="blog-banner-area">
	<div class="overlay1"></div>
		<div class="container" style="z-index: 9; position: absolute; left: 0; right: 0;">
			<div class="row">
				<div class="com-md-12">
					<div class="breadcrumb-area text-center">
					   <h2 style="color:#fff !important;"><?=stripslashes($bilgi[0]["baslik"])?></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    <img src="<?=SITE?>images/universiteler/<?=$resim?>" class="unilogo" alt="<?=stripslashes($bilgi[0]["baslik"])?>">
    
  <section class="blog-container pt-1">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
                <?php
				$puanlaruni=$VT->VeriGetir2("universiteID, SUM(puan) AS puan, SUM(durum) AS durumtoplam, durum","yorumlar","WHERE durum=? AND universiteID=?",array(1,$bilgi[0]["ID"]),"GROUP BY universiteID ORDER BY puan DESC",1);
						if($puanlaruni!=false){$puanA=$puanlaruni[0]["puan"]; $bolumA=$puanlaruni[0]["durumtoplam"];}else{$puanA=0;$bolumA=1;}
						$puanToplam=round($puanA/$bolumA);
				?>
                <p><strong>Üniversite Puanı :</strong> 
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
					<?=stripslashes($bilgi[0]["metin"])?>
                    
                   
                    
				</div>
				<div class="col-md-12">
                <h3 style="margin-top: 40px; border-bottom: 1px solid #ddd; padding: 0 0px 10px; margin-bottom: 40px;">Fakülteler ve Yüksekokullar</h3>
                <div class="row">
                <?php
				$fakulteler=$VT->VeriGetir("fakulteler","WHERE durum=? AND universiteID=?",array(1,$bilgi[0]["ID"]),"ORDER BY sirano ASC");
				if($fakulteler!=false)
				{
					for ($i=0;$i<count($fakulteler);$i++) { 
						$puanlar=$VT->VeriGetir2("urunID, SUM(puan) AS puan, SUM(durum) AS durumtoplam, durum","yorumlar","WHERE durum=? AND urunID=?",array(1,$fakulteler[$i]["ID"]),"GROUP BY urunID ORDER BY puan DESC",1);
						if($puanlar!=false){$puan=$puanlar[0]["puan"]; $bolum=$puanlar[0]["durumtoplam"];}else{$puan=0;$bolum=1;}
						$puanhesap=round($puan/$bolum);
						?>
						<div class="col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 10px;" id="<?=mb_substr(stripslashes($fakulteler[$i]["baslik"]),0,1,"UTF-8")?>">
                            <div class="single-post-item">
                                <div class="blog-img lucy">
                                    <a href="<?=SITE?>fakulte-detay/<?=$bilgi[0]["seflink"]?>/<?=$fakulteler[$i]["seflink"]?>"><img src="<?=SITE?>images/universiteler/<?=$resim?>" alt="<?=stripslashes($fakulteler[$i]["baslik"])?>"></a>
                                </div>
                                <a href="<?=SITE?>fakulte-detay/<?=$bilgi[0]["seflink"]?>/<?=$fakulteler[$i]["seflink"]?>">
                                <h5 class="bslk"><?=stripslashes($fakulteler[$i]["baslik"])?></h5><br />
                                <p style="margin-top: 6px; color:#ff9800;"><?php
                                if($puanhesap==5)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    /<strong><?=$puanhesap.".0"?></strong>
                                    <?php
								}
								else if($puanhesap==4)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    /<strong><?=$puanhesap.".0"?></strong>
                                    <?php
								}
								else if($puanhesap==3)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    /<strong><?=$puanhesap.".0"?></strong>
                                    <?php
								}
								else if($puanhesap==2)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    /<strong><?=$puanhesap.".0"?></strong>
                                    <?php
								}
								else if($puanhesap==1)
								{
									?>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    <i class="fa fa-star-o"></i>
                                    /<strong><?=$puanhesap.".0"?></strong>
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
                                
                                </p>
                                </a>
                            </div>
                        </div>
						<?php
					}
				}
				?>
                
                </div>
                
                 <?php
				$sql=$VT->VeriGetir("resimler","WHERE tablo=? AND KID=?",array("universiteler",$bilgi[0]["ID"]),"ORDER BY ID ASC");
				if($sql!=false)
				{
					?>
                    <h3 style="margin-top: 40px; border-bottom: 1px solid #ddd; padding: 0 0px 10px; margin-bottom: 40px;">Üniversite Galerisi</h3>
                    <div class="row">
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
                        <div class="col-md-3 col-sm-4 col-12 product" >
							<a href="<?=SITE?>images/resimler/<?=$resim?>" class="highslide" onclick="return hs.expand(this)">
								<i><img src="<?=SITE?>images/resimler/<?=$resim?>" alt="galeri" /></i>
							</a>
						</div>
						<?php
					}
					?>
                    </div>
					<?php
				}
				?>
                </div>
			</div>
		</div>
	</section>  
    
		<?php
	}
}
?>
