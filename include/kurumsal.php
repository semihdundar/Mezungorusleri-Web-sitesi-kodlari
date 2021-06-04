<?php
if(!empty($_GET["seflink"]))
{
	$seflink=$VT->filter($_GET["seflink"]);
	$bilgi=$VT->VeriGetir("kurumsal","WHERE seflink=? AND durum=?",array($seflink,1),"ORDER BY ID ASC",1);
	if($bilgi!=false)
	{
		$resim=SITE."images/kurumsal/".$bilgi[0]["resim"];
		?>
<div class="blog-banner-area"<?php if(!empty($bilgi[0]["resim"])){ ?> style="background:url(<?=$resim?>);" <?php } ?>>
	<div class="overlay1"></div>
		<div class="container" style="z-index: 999; position: absolute; left: 0; right: 0;">
			<div class="row">
				<div class="com-md-12">
					<div class="breadcrumb-area text-center">
					   <h2 style="color:#fff !important;"><?=stripslashes($bilgi[0]["baslik"])?></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    
  <section class="blog-container pt-1">
		<div class="container">
			<div class="row">
				<div class="col-md-9">
					<?=stripslashes($bilgi[0]["metin"])?>
                    
                    <?php
				$sql=$VT->VeriGetir("resimler","WHERE tablo=? AND KID=?",array("kurumsal",$bilgi[0]["ID"]),"ORDER BY ID ASC");
				if($sql!=false)
				{
					?>
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
				<div class="col-md-3">
					<div class="blog-righr-sidebar">
						<div class="single-sidebar">
							<div class="cat-list">
								<ul>
                                <?php
										$kurumsal=$VT->VeriGetir("kurumsal","WHERE durum=?",array(1),"ORDER BY sirano ASC");
										if($kurumsal!=false)
										{
											for ($i=0; $i <count($kurumsal) ; $i++) { 
												?>
											<li><a href="<?=SITE?>kurumsal/<?=$kurumsal[$i]["seflink"]?>"><i class="fa fa-angle-right"></i> <?=stripslashes($kurumsal[$i]["baslik"])?></a></li>
												<?php
											}
										}
										?>
								</ul>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
	</section>  
    
		<?php
	}
}
?>
