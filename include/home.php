<?php
include_once(DATA."banner.php");
?>


<div class="partner-area ptb-1" style="background:#F0F2F5;">
		<div class="container">
        <div class="text-center pb-1">
						<h2>Popüler Üniversiteler</h2>
					</div>
			<div class="row">
				<div class="col-md-12">
					<div class="tum">
                    <?php
				$puanlar=$VT->VeriGetir2("universiteID, SUM(puan) AS puan, durum","yorumlar","WHERE durum=?",array(1),"GROUP BY universiteID ORDER BY puan DESC",50);
				
				if($puanlar!=false)
				{
					for($i=0;$i<count($puanlar);$i++)
					{
						$universiteler=$VT->VeriGetir("universiteler","WHERE durum=? AND ID=?",array(1,$puanlar[$i]["universiteID"]),"ORDER BY ID ASC",1);
						if($universiteler!=false)
						{
							
								$puaniIse=$puanlar[$i]["puan"];
								if(!empty($universiteler[0]["resim"])){$resim=$universiteler[0]["resim"];}else{$resim="varsayilan.png";}
								?>
								<div class="partner-item">
									 <a href="<?=SITE?>universite-detay/<?=$universiteler[0]["seflink"]?>"><img src="<?=SITE?>images/universiteler/<?=$resim?>" alt="<?=stripslashes($universiteler[0]["baslik"])?>" style="height:100px; width:100px;"></a>
								</div>
								
								<?php
						}
						
					}
				}
				
				?>
					</div>
				</div>
			</div>
		</div>
	</div>
<!--==================================================================== 
							Start About Section 
	=====================================================================-->
	<section class="about-area ptb-1" id="about">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
					<div class="section-top text-center pb-1">
						<h2>Biz Kimiz?</h2>
                        <p>Bizimle ilgili merak ettiğiniz herşeye buradan ulaşabilirsiniz.</p>
					</div>
				</div>
			</div> <!--/End Section Top-->
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="about-img">
                        <img src="<?=SITE?>assets/images/about.jpg" alt="about-image">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="row">
                    <?php
                    $iconlar=array("info","question-circle-o","bicycle","trophy");
                        $kurumsal=$VT->VeriGetir("kurumsal","WHERE durum=?",array(1),"ORDER BY sirano ASC",4);
                        if($kurumsal!=false)
                        {
                            for ($i=0; $i <count($kurumsal) ; $i++) { 
                               ?>
                               <div class="col-md-6 col-sm-6">
                               <a href="<?=SITE?>kurumsal/<?=$kurumsal[$i]["seflink"]?>">
                            <div class="single-about-item text-center">
                                <div class="about-icon">
                                    <i class="fa fa-<?=$iconlar[$i]?>"></i>
                                </div>
                                <h3><?=stripslashes($kurumsal[$i]["baslik"])?></h3>
                                <p><?=mb_substr(strip_tags(stripslashes($kurumsal[$i]["metin"])),0,120,"UTF-8")?>...</p>
                            </div>
                            </a>
                        </div> <!-- /End single about item -->
                               <?php
                            }
                        }
                        ?>
                        
                    </div>
                </div>
            </div>
		</div>
	</section> <!--/section -->
	<!--==================================================================== 
							End	About Section 
	=====================================================================-->
    

	<!-- ===================================================================
							Start Testimonial Section
	=====================================================================-->
	<section class="testimonial-area ptb-1">
        <div class="overlay1" style="background: linear-gradient(to right, #363795, #005C97); opacity: 0.98;"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                    <div class="section-top text-center pb-2">
                        <h2 class="white">Mezun Görüşleri</h2>
                    </div>
                </div>
            </div> <!--/End Section Top-->
            <div class="row">
                <div class="col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1">
                    <div class="client-say text-center owl-carousel">
                    <?php
				/*burada bölüm hakkında paylaşılan yorumlar yer alacak*/
				$yorumlar=$VT->VeriGetir("yorumlar","WHERE puan>? AND durum=?",array(2,1),"ORDER BY ID DESC",10);
				if($yorumlar!=false)
				{
					for($i=0;$i<count($yorumlar);$i++)
					{
						$universte=$VT->VeriGetir("universiteler","WHERE ID=?",array($yorumlar[$i]["universiteID"]),"ORDER BY ID ASC",1);
				
						$uyeBilgisi=$VT->VeriGetir("uyeler","WHERE ID=?",array($yorumlar[$i]["uyeID"]),"ORDER BY ID ASC",1);
						if($uyeBilgisi!=false && $universte!=false)
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
                        <div class="client-single-item">
                            <p class="white"><i class="fa fa-quote-left"></i><?=stripslashes($yorumlar[$i]["metin"])?><i class="fa fa-quote-right"></i></p>
                            <div class="client-img">
                                <img src="<?=SITE?>images/uyeler/<?=$uyeresim?>" alt="client-image" style="height:80px;">
                            </div>
                            <span><?=$uyeBilgisi[0]["ad"]." ".$uyeBilgisi[0]["soyad"]?></span>
                            <span style="font-size:12px; display:block; clear:both; padding-top:0px; margin-top:-12px;"><?=stripslashes($universte[0]["baslik"])?></span>
                        </div> <!-- End single client item -->
                        
                        <?php
						}
					}
				}
				?>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
	<!-- ===================================================================
							End Testimonial Section
	=====================================================================-->