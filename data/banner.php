<!--==================================================================== 
							Start Slider Section 
	=====================================================================-->
	<section class="slider-area">
		<div class="camera_wrap main-slider">
        <?php
			$banner=$VT->VeriGetir("banner","WHERE durum=?",array(1),"ORDER BY sirano ASC");
			if($banner!=false)
			{
				for ($i=0; $i <count($banner) ; $i++) { 
				?>
                <div data-thumb="<?=SITE?>images/banner/<?=$banner[$i]["resim"]?>" data-src="<?=SITE?>images/banner/<?=$banner[$i]["resim"]?>">
                <div class="camera_caption text-center">
                	<h5 class="fadeInUp animated"><?=stripslashes($banner[$i]["baslik"])?></h5>
                    <h1 class="fadeInDown animated"><?=stripslashes($banner[$i]["aciklama"])?></h1>
                    <?php
                        if(!empty($banner[$i]["url"]))
                        {
                            ?>
                            <a href="<?=$banner[$i]["url"]?>" class="btn1 fadeInLeft animated">İncele</a>
                            <a href="<?=SITE?>iletisim" class="btn2 fadeInRight animated">İletişim</a>
                            <?php
                        }
                    ?>
					
                </div>
            </div>
				<?php
				}
			}
			?>
            
            
            
        </div><!-- #camera_wrap_1 -->
	</section>
	<!--==================================================================== 
							End	Slider Section 
	=====================================================================-->