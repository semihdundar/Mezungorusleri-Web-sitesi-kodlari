
<div class="blog-banner-area">
	<div class="overlay1"></div>
		<div class="container" style="z-index: 999; position: absolute; left: 0; right: 0;">
			<div class="row">
				<div class="com-md-12">
					<div class="breadcrumb-area text-center">
					   <h2 style="color:#fff !important;">Üniversiteler</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    
  <section class="blog-container  pb-1">
		<div class="container">
			<div class="row">
            <div class="col-md-12 ustHaft">
            <ul class="harfBar">
            <?php
			$harfler=array("A","B","C","Ç","D","E","F","G","Ğ","H","I","İ","J","K","L","M","N","O","Ö","P","R","S","Ş","T","U","Ü","V","Y","Z");
			for($h=0;$h<count($harfler);$h++)
			{
				?>
                <li><a href="<?=SITE?>universiteler/<?=$harfler[$h]?>"><?=$harfler[$h]?></a></li>
                <?php
			}
			?>
            </ul>
            </div>
				<?php
				if(!empty($_GET["harf"]))
				{
					$harf=$VT->filter($_GET["harf"]);
					$universiteler=$VT->VeriGetir("universiteler","WHERE durum=? AND baslik LIKE ?",array(1,$harf."%"),"ORDER BY baslik ASC");
					if($universiteler!=false)
					{
					}
					else
					{
						/*harfle başlayan üniversite bulunamamış ise tüm üniversiteleri listelesin*/
						//$universiteler=$VT->VeriGetir("universiteler","WHERE durum=?",array(1),"ORDER BY baslik ASC");
					}
				}
				else
				{
					$universiteler=$VT->VeriGetir("universiteler","WHERE durum=?",array(1),"ORDER BY baslik ASC");
				}
				
				if($universiteler!=false)
				{
					for ($i=0;$i<count($universiteler);$i++) { 
						
						if(!empty($universiteler[$i]["resim"])){$resim=$universiteler[$i]["resim"];}else{$resim="varsayilan.png";}
						$puanlaruni=$VT->VeriGetir2("universiteID, SUM(puan) AS puan, SUM(durum) AS durumtoplam, durum","yorumlar","WHERE durum=? AND universiteID=?",array(1,$universiteler[$i]["ID"]),"GROUP BY universiteID ORDER BY puan DESC",1);
						if($puanlaruni!=false){$puanA=$puanlaruni[0]["puan"]; $bolumA=$puanlaruni[0]["durumtoplam"];}else{$puanA=0;$bolumA=1;}
						$puanhesap=trim(round($puanA/$bolumA));
						?>
						<div class="uniList col-md-6 col-sm-6 col-xs-12" style="margin-bottom: 10px;" id="<?=mb_substr(stripslashes($universiteler[$i]["baslik"]),0,1,"UTF-8")?>">
                            <div class="single-post-item">
                                <div class="blog-img lucy">
                                    <a href="<?=SITE?>universite-detay/<?=$universiteler[$i]["seflink"]?>"><img src="<?=SITE?>images/universiteler/<?=$resim?>" alt="<?=stripslashes($universiteler[$i]["baslik"])?>"></a>
                                </div>
                                <a href="<?=SITE?>universite-detay/<?=$universiteler[$i]["seflink"]?>">
                                <h5 class="bslk"><?=stripslashes($universiteler[$i]["baslik"])?></h5><br />
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
                <div class="col-md-12" style="text-align: center; border-top: 1px solid #eee; margin: 10px 0 0 0; padding-top: 15px; clear:both;">
				<ul id="sayfalama" class="sayfalamaAlani"></ul>
                </div>
			</div>
		</div>
	</section>  
    
		