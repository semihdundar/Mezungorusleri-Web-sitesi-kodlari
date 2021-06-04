<?php
if(!empty($_SESSION["uyeID"]))
{
	$uyeID=$VT->filter($_SESSION["uyeID"]);
	$uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($uyeID,1),"ORDER BY ID ASC",1);
	if($uyebilgisi!=false)
	{
		?>
<div class="blog-banner-area" style="padding-top: 10px; padding-bottom: 80px; background: linear-gradient(to right, #363795, #005C97);">
	<div class="overlay1"></div>
		<div class="container" style="z-index: 999; position: absolute; left: 0; right: 0;">
			<div class="row">
				<div class="com-md-12">
					<div class="breadcrumb-area text-center">
					   <h2 style="color:#fff !important;"></h2>
					</div>
				</div>
			</div>
		</div>
	</div>
<main class="bg_gray">
		
	<div class="container margin_30">
		<div class="page_header">
	</div>
	<!-- /page_header -->
	
			<div class="row justify-content-center">
				<div class="col-xl-8 col-lg-8 col-md-8">
				<div class="box_account">
					<h3 class="new_client">Üyelik Bilgileri</h3>
					<?php
					if($_POST)
					{
						if(!empty($_POST["ozellik"]))
						{
							


							
								/*Bireysel üye ise*/
								if(!empty($_POST["ad"]) && !empty($_POST["soyad"]) && !empty($_POST["telefon"]) && !empty($_POST["ilce"]) && !empty($_POST["il"]) && !empty($_POST["universite"]) && !empty($_POST["bolum"]))
									{
										$ad=$VT->filter($_POST["ad"]);
										$soyad=$VT->filter($_POST["soyad"]);
										$telefon=$VT->filter($_POST["telefon"]);
										$ilce=$VT->filter($_POST["ilce"]);
										$il=$VT->filter($_POST["il"]);
										$universite=$VT->filter($_POST["universite"]);
										$bolum=$VT->filter($_POST["bolum"]);
											$guncelle=$VT->SorguCalistir("UPDATE uyeler","SET ad=?, soyad=?, ilce=?, ilID=?, bolum=?, telefon=?, tipi=?, durum=?, tarih=? WHERE ID=?",array($ad,$soyad,$ilce,$il,$bolum,$telefon,1,1,date("Y-m-d"),$uyebilgisi[0]["ID"]),1);
											$universiteler=$VT->VeriGetir("universiteler","WHERE durum=? AND seflink=?",array(1,$universite),"ORDER BY baslik ASC",1);
											if($universiteler!=false)
											{
												$guncelle=$VT->SorguCalistir("UPDATE uyeler","SET universiteID=? WHERE ID=?",array($universiteler[0]["ID"],$uyebilgisi[0]["ID"]),1);
											}
											$_SESSION["uyeAdi"]=$ad;
											$uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($uyebilgisi[0]["ID"],1),"ORDER BY ID ASC",1);
											?>
										<div class="alert alert-success">Hesabınız başarıyla güncellendi.</div>
										<?php
										
									}
									else
									{
										?>
										<div class="alert alert-danger">Boş bıraktığınız alanları doldurunuz.</div>
										<?php
									}

							

							
						}
					}
					?>
					<form action="#" method="post">
						<input type="hidden" name="ozellik" value="1">
					<div class="form_container">
						<div class="form-group">
							<input type="email" class="form-control" name="mail" id="email_2" placeholder="E-mail" value="<?=$uyebilgisi[0]["mail"]?>">
						</div>
						<hr>
						<div class="private box">
							<div class="row no-gutters">
								<div class="col-md-6 pr-1">
									<div class="form-group">
										<input type="text" name="ad" class="form-control" placeholder="İsim*" value="<?=$uyebilgisi[0]["ad"]?>">
									</div>
								</div>
								<div class="col-md-6 pl-1">
									<div class="form-group">
										<input type="text" name="soyad" class="form-control" placeholder="Soyisim" value="<?=$uyebilgisi[0]["soyad"]?>">
									</div>
								</div>
								<div class="col-md-12">
									<!-- adres -->
								</div>
							</div>
							<!-- /row -->
							<div class="row no-gutters">
								<div class="col-md-6 pr-1">
									<!-- il kodu -->
									
									<div class="form-group">
										<div class="custom-select-form">
											<select class="wide add_bottom_10 form-control" name="il" id="country">
												<?php
												$iller=$VT->VeriGetir("il");
												if($iller!=false)
												{
												for ($i=0; $i <count($iller) ; $i++) { 
													if($uyebilgisi[0]["ilID"]==$iller[$i]["ID"])
													{
														?>
														<option value="<?=$iller[$i]["ID"]?>" selected="selected"><?=$iller[$i]["ADI"]?></option>
														<?php
													}
													else
													{
														?>
														<option value="<?=$iller[$i]["ID"]?>"><?=$iller[$i]["ADI"]?></option>
														<?php
													}
														

													}
												}
												?>
											</select>
										</div>
									</div>
									
								</div>
								<div class="col-md-6 pl-1">
									<!-- ilçe kodu -->
									
									<div class="form-group">
										<input type="text" name="ilce" class="form-control" placeholder="İlçe" value="<?=$uyebilgisi[0]["ilce"]?>">
									</div>
								</div>
							</div>
							<!-- /row -->
							
							<div class="row no-gutters">
								<div class="col-md-6 pr-1">
									<!-- üniversiteler -->
									<div class="form-group">
										<div class="custom-select-form">
											<select class="form-control" name="universite">
												<?php
												$universiteler=$VT->VeriGetir("universiteler","WHERE durum=?",array(1),"ORDER BY baslik ASC");
												if($universiteler!=false)
												{
												for ($i=0; $i <count($universiteler) ; $i++) { 
														?>
														<option value="<?=$universiteler[$i]["seflink"]?>"<?php if($universiteler[$i]["ID"]==$uyebilgisi[0]["universiteID"]){echo ' selected="selected"';}?>><?=stripslashes($universiteler[$i]["baslik"])?></option>
														<?php

													}
												}
												?>
											</select>
										</div>
									</div>
									
								</div>
								<div class="col-md-6 pl-1">
									<div class="form-group">
										<input type="text" name="bolum" class="form-control" placeholder="Bölümünüz" required="required"  value="<?=$uyebilgisi[0]["bolum"]?>">
									</div>
									
								</div>
							</div>
							<!-- /row -->
                            <div class="row no-gutters">
								<div class="col-md-6 pr-1">
									<!-- telefon -->
									<div class="form-group">
										<input type="text" name="telefon" class="form-control" placeholder="Telefon" value="<?=$uyebilgisi[0]["telefon"]?>">
									</div>
									
								</div>
							</div>
							<!-- /row -->
							
						</div>
						<!-- /private -->
						
						<!-- /company -->
						
						<div class="text-center"><input type="submit" value="Hesabı Güncelle" class="btn btn-success full-width" style="display:block; width:100%;"></div>
					</div>
				</form>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->
			</div>
			<div class="col-xl-4 col-lg-4 col-md-8">
				<div class="box_account">
					<h3 class="client">Şifre Değiştir</h3>
					<?php
					if($_POST)
					{
						if(!empty($_POST["giris"]))
						{
							if(!empty($_POST["esifre"]) && !empty($_POST["sifre"]))
							{
								$esifre=md5($VT->filter($_POST["esifre"]));
								$sifre=md5($VT->filter($_POST["sifre"]));
								if($uyebilgisi[0]["sifre"]==$esifre)
								{
									$sifreguncelle=$VT->SorguCalistir("UPDATE uyeler","SET sifre=? WHERE ID=?",array($sifre,$uyebilgisi[0]["ID"]),1);
									?>
										<div class="alert alert-success">Şifreniz başarıyla güncellendi.</div>
										<?php
								}
								else
								{
									?>
										<div class="alert alert-danger">Eski şifreniz doğrulanamadı!</div>
										<?php
								}
							}
							else
							{
								?>
										<div class="alert alert-danger">Boş bıraktığınız alanları doldurunuz.</div>
										<?php
							}
						}
					}
					?>
					<form action="#" method="post">
						<input type="hidden" name="giris" value="1">
					<div class="form_container">
						<div class="form-group">
							<input type="password" class="form-control" name="esifre" id="password_in" value="" placeholder="Eski Parola*">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="sifre" id="password_in" value="" placeholder="Yeni Parola*">
						</div>
						<div class="text-center"><input type="submit" value="Şifremi Güncelle" class="btn btn-primary full-width" style="display:block; width:100%;"></div>
						
					</div>
				</form>
                
                
                <?php
					if($_POST)
					{
						if(!empty($_POST["foto"]))
						{
							if(!empty($_FILES["resim"]["name"]))
							{
								$yukle=$VT->upload("resim","images/uyeler/");
								if($yukle!=false)
								{
									$resimguncelle=$VT->SorguCalistir("UPDATE uyeler","SET resim=? WHERE ID=?",array($yukle,$uyebilgisi[0]["ID"]),1);
									$uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($uyeID,1),"ORDER BY ID ASC",1);
									$_SESSION["uyeResim"]=$uyebilgisi[0]["resim"];
									?>
										<div class="alert alert-success">Resminiz başarıyla güncellendi.</div>
										<?php
								}
								else
								{
									?>
										<div class="alert alert-danger">Resim uygun formatta değil!</div>
										<?php
								}
							}
							else
							{
								?>
										<div class="alert alert-danger">Bir resim seçiniz.</div>
										<?php
							}
						}
					}
					?>
					<form action="#" method="post" enctype="multipart/form-data" style="background: #fafafa; border: 1px solid #ddd; padding: 10px; margin-top: 20px;">
						<input type="hidden" name="foto" value="1">
					<div class="form_container">
                    <?php
					if(!empty($uyebilgisi[0]["resim"]))
							{
								$uyeresim=$uyebilgisi[0]["resim"];
							}
							else
							{
								$uyeresim="avatar.png";
							}
							?>
                            <img src="<?=SITE?>images/uyeler/<?=$uyeresim?>" style="width: 100px; height: 100px; margin: 10px 0px; border-radius: 100%; margin-left: auto; margin-right: auto; display: block;" />
                            <?php
					?>
						<div class="form-group">
							<input type="file" class="form-control" name="resim">
						</div>
						<div class="text-center">
                        <input type="submit" value="Profil Resmini Güncelle" class="btn btn-warning full-width" style="display:block; width:100%;">
                        </div>
						
					</div>
				</form>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->
				
			</div>
			
		</div>
		<!-- /row -->
		</div>
		<!-- /container -->
	</main>
	<!--/main-->
		<?php
	}
	else
	{
		?>
		<meta http-equiv="refresh" content="0;url=<?=SITE?>uyelik">
		<?php
		exit();
	}
}
else
{
	?>
		<meta http-equiv="refresh" content="0;url=<?=SITE?>uyelik">
		<?php
		exit();
}
?>
