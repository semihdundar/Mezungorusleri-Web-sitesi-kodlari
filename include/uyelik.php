<?php
if(!empty($_SESSION["uyeID"]))
{
	?>
	<meta http-equiv="refresh" content="0;url=<?=SITE?>hesabim">
	<?php
	exit();
}
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
		
	<div class="container margin_30" style="padding-bottom:30px;">
		<div class="page_header">
	</div>
	<!-- /page_header -->
			<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="client">Giriş Yap</h3>
					<?php
					if($_POST)
					{
						if(!empty($_POST["giris"]))
						{
							if(!empty($_POST["mail"]) && !empty($_POST["sifre"]))
							{
								$mail=$VT->filter($_POST["mail"]);
								$sifre=md5($VT->filter($_POST["sifre"]));
								$kontrol=$VT->VeriGetir("uyeler","WHERE mail=? AND sifre=? AND durum=?",array($mail,$sifre,1),"ORDER BY ID ASC",1);
								if($kontrol!=false)
								{
									$_SESSION["uyeID"]=$kontrol[0]["ID"];
									$_SESSION["uyeTipi"]=$kontrol[0]["tipi"];
									$_SESSION["uyeResim"]=$kontrol[0]["resim"];
									if($kontrol[0]["tipi"]==1)
									{
										$_SESSION["uyeAdi"]=$kontrol[0]["ad"];
									}
									else
									{
										$_SESSION["uyeAdi"]=$kontrol[0]["firmaadi"];
									}
									?>
									<meta http-equiv="refresh" content="0;url=<?=SITE?>hesabim">
									<?php
								}
								else
								{
									?>
										<div class="alert alert-danger">E-mail veya şifre hatalı!</div>
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
							<input type="email" class="form-control" name="mail" id="email" placeholder="E-mail*">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="sifre" id="password_in" value="" placeholder="Parola*">
						</div>
						<div class="clearfix add_bottom_15">
							<div class="float-right"><a id="forgot" href="javascript:void(0);" style="float: right; padding-bottom: 8px;">Parolamı Unuttum?</a></div>
						</div>
						<div class="text-center"><input type="submit" value="Giriş Yap" class="btn btn-primary" style="display:block; width:100%;"></div>
						<div id="forgot_pw">
                        <p>Yeni şifrenizi belirlemek için mail adresinizi yazınız.</p>
							<div class="form-group">
								<input type="email" class="form-control sifremail" name="email" id="email_forgot" placeholder="E-mail adresiniz">
							</div>
							
							<div class="text-center"><a class="btn btn-warning" onclick="sifreIste('<?=SITE?>');" style="display:block; width:100%;">Yeni Şifre İste</a></div>
						</div>
					</div>
				</form>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->
				
			</div>
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="new_client">Ücretsiz Üye Ol</h3>
					<?php
					if($_POST)
					{
						if(!empty($_POST["ozellik"]))
						{
							
								/*Bireysel üye ise*/
								if(!empty($_POST["ad"]) && !empty($_POST["soyad"])  && !empty($_POST["telefon"])  && !empty($_POST["ilce"])  && !empty($_POST["mail"]) && !empty($_POST["sifre"]) && !empty($_POST["il"]) && !empty($_POST["universite"]) && !empty($_POST["bolum"]))
									{
										$ad=$VT->filter($_POST["ad"]);
										$soyad=$VT->filter($_POST["soyad"]);
										
										$telefon=$VT->filter($_POST["telefon"]);
										
										$ilce=$VT->filter($_POST["ilce"]);
										$mail=$VT->filter($_POST["mail"]);
										$sifre=md5($VT->filter($_POST["sifre"]));
										$il=$VT->filter($_POST["il"]);
										$universite=$VT->filter($_POST["universite"]);
										$bolum=$VT->filter($_POST["bolum"]);
										$kontrol=$VT->VeriGetir("uyeler","WHERE mail=?",array($mail),"ORDER BY ID ASC",1);
										if($kontrol!=false)
										{
											/*hesabı oluştumayacağız.*/
											?>
										<div class="alert alert-danger">Bu hesap zaten mevcut. Lütfen giriş yapınız.</div>
										<?php
										}
										else
										{
											$universiteler=$VT->VeriGetir("universiteler","WHERE durum=? AND seflink=?",array(1,$universite),"ORDER BY baslik ASC",1);
											if($universiteler!=false)
											{
											/*üye kaydını yap*/
											$ekle=$VT->SorguCalistir("INSERT INTO uyeler","SET ad=?, soyad=?, mail=?, sifre=?, universiteID=?, bolum=?, ilce=?, ilID=?,  telefon=?, tipi=?, durum=?, tarih=?",array($ad,$soyad,$mail,$sifre,$universiteler[0]["ID"],$bolum,$ilce,$il,$telefon,1,1,date("Y-m-d")));
											?>
										<div class="alert alert-success">Hesabınız başarıyla oluşturuldu. Artık giriş yapabilirsiniz.</div>
                                        
										<?php
											}
											else
											{
												?>
										<div class="alert alert-danger">Üniversite ve bölümünüzü seçiniz.</div>
										<?php
											}
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
						<input type="hidden" name="ozellik" value="1">
					<div class="form_container">
						<div class="form-group">
							<input type="email" class="form-control" name="mail" id="email_2" placeholder="E-mail*" required="required">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="sifre" id="password_in_2" value="" placeholder="Parola" required="required">
						</div>
						<hr>
						<div class="private box">
							<div class="row no-gutters">
								<div class="col-md-6 pr-1">
									<div class="form-group">
										<input type="text" name="ad" class="form-control" placeholder="İsim*" required="required">
									</div>
								</div>
								<div class="col-md-6 pl-1">
									<div class="form-group">
										<input type="text" name="soyad" class="form-control" placeholder="Soyisim*" required="required">
									</div>
								</div>
								<!-- adres -->
							</div>
							<!-- /row -->
							<div class="row no-gutters">
								<div class="col-md-6 pr-1">
									<!-- il kodu -->
									
									<div class="form-group">
										<div class="custom-select-form">
											<select class="form-control" name="il" id="country">
												<?php
												$iller=$VT->VeriGetir("il");
												if($iller!=false)
												{
												for ($i=0; $i <count($iller) ; $i++) { 
														?>
														<option value="<?=$iller[$i]["ID"]?>"><?=$iller[$i]["ADI"]?></option>
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
										<input type="text" name="ilce" class="form-control" placeholder="İlçe*" required="required">
									</div>
								</div>
							</div>
							<!-- /row -->
							
							<div class="row no-gutters">
								<div class="col-md-6 pr-1">
									<div class="form-group">
										<div class="custom-select-form">
											<select class="form-control" name="universite" >
												<?php
												$universiteler=$VT->VeriGetir("universiteler","WHERE durum=?",array(1),"ORDER BY baslik ASC");
												if($universiteler!=false)
												{
												for ($i=0; $i <count($universiteler) ; $i++) { 
														?>
														<option value="<?=$universiteler[$i]["seflink"]?>"><?=stripslashes($universiteler[$i]["baslik"])?></option>
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
										<input type="text" name="telefon" class="form-control" placeholder="Telefon*" required="required" >
									</div>
								</div>
							</div>
							<!-- /row -->
                            <div class="row no-gutters">
								<div class="col-md-6 pr-1">
									<div class="form-group">
										<input type="text" name="bolum" class="form-control" placeholder="Bölümünüz*" required="required">
									</div>
								</div>
							</div>
							<!-- /row -->
                            
							
						</div>
						<!-- /private -->
						
						<!-- /company -->
						
						<div class="text-center"><input type="submit" value="Hesap Oluştur" class="btn btn-success" style="display:block; width:100%;"></div>
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