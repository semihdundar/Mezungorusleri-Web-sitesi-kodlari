<?php
if(!empty($_SESSION["uyeninSifresiIcinID"]) && !empty($_SESSION["dogrulamaKodu"]))
{


?>
<div class="blog-banner-area" style="padding-top: 10px; padding-bottom: 80px; background: #000;">
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
		<h1>Hesabı Doğrula</h1>
	</div>
	<!-- /page_header -->
			<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<?php
					if(!empty($_GET["seflink"]))
					{
						$islemtipi=$VT->filter($_GET["seflink"]);
						if($islemtipi=="dogulama")
						{
							if($_POST)
							{
								if(!empty($_POST["kod"]) && $_POST["kod"]==$_SESSION["dogrulamaKodu"])
								{
									$_SESSION["guvenlikKilidi"]="OK";
									?>
									<meta http-equiv="refresh" content="0;url=<?=SITE?>sifre-belirle/sifreIste">
									<?php
								}
							}
							?>
							<h3 class="client">Doğrulama Kodu</h3>
					
					<form action="#" method="post">
					<div class="form_container">
						<div class="form-group">
							<input type="text" class="form-control" name="kod"  placeholder="Doğrulama Kodunuz*">
						</div>
						
						
						<div class="text-center"><input type="submit" value="Doğrula" class="btn_1 full-width"></div>
						
					</div>
				</form>
							<?php
						}
						else if($islemtipi=="sifreIste" && !empty($_SESSION["guvenlikKilidi"]) && $_SESSION["guvenlikKilidi"]=="OK")
						{
							if($_POST)
							{
								if(!empty($_POST["sifre"]) && !empty($_POST["tsifre"]))
								{
									if($_POST["sifre"]==$_POST["tsifre"])
									{
										$sifre=md5($VT->filter($_POST["sifre"]));
										$uyeID=$VT->filter($_SESSION["uyeninSifresiIcinID"]);
										$guncelle=$VT->SorguCalistir("UPDATE uyeler","SET sifre=? WHERE ID=?",array($sifre,$uyeID),1);
										unset($_SESSION["guvenlikKilidi"]);
										unset($_SESSION["uyeninSifresiIcinID"]);
										unset($_SESSION["dogrulamaKodu"]);
										?>
										<div class="alert alert-success">Şifreniz başarıyla güncellendi. Lütfen giriş yapınız.</div>
										<meta http-equiv="refresh" content="3;url=<?=SITE?>uyelik">
										<?php
									}
									else
									{
										?>
									<div class="alert alert-danger">Şifreniz eşleşmiyor!</div>
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
							?>
							<h3 class="client">Yeni Şifre Belirle</h3>
					
					<form action="#" method="post">
					<div class="form_container">
						<div class="form-group">
							<input type="password" class="form-control" name="sifre"  placeholder="Yeni Şifre*">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="tsifre"  placeholder="Tekrar Şifre*">
						</div>
						
						<div class="text-center"><input type="submit" value="Şifremi Güncelle" class="btn btn-success full-width"></div>
						
					</div>
				</form>
							<?php
						}
					}
					?>
					
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
	?>