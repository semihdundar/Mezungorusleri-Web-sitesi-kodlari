<div class="blog-banner-area">
	<div class="overlay1"></div>
		<div class="container" style="z-index: 999; position: absolute; left: 0; right: 0;">
			<div class="row">
				<div class="com-md-12">
					<div class="breadcrumb-area text-center">
					   <h2 style="color:#fff !important;">İletişim</h2>
					</div>
				</div>
			</div>
		</div>
	</div>
    
    
    <section class="contact-area ptb-1" id="contact">
		<div class="container">
		
			<div class="row">
				<div class="col-md-7 col-sm-6 col-xs 12">
					<div class="contact-field-area">
                    <?php
					if($_POST)
					{
						if(!empty($_POST["adsoyad"]) && !empty($_POST["mail"]) && !empty($_POST["mesaj"]) && !empty($_POST["telefon"]))
						{
							$adsoyad=$VT->filter($_POST["adsoyad"]);
							$mail=$VT->filter($_POST["mail"]);
							$telefon=$VT->filter($_POST["telefon"]);
							$mesaj=$VT->filter($_POST["mesaj"]);
							$mesajdetay="Ad Soyad : ".$adsoyad."<br>
							E-Mail : ".$mail."<br>
							Telefon : ".$telefon."<br>
							Mesaj : ".$mesaj."";
							$kaydet=$VT->SorguCalistir("INSERT INTO mesajlar","SET adsoyad=?, mail=?, telefon=?, metin=?, durum=?, tarih=?",array($adsoyad,$mail,$telefon,$mesaj,1,date("Y-m-d")));
							$mailgonder=$VT->MailGonder($sitemail,"Websitenizden Yeni Mesaj Var!",$mesajdetay);
							?>
                            <div class="alert alert-success">Mesajınız başarıyla gönderilmiştir.</div>
                            <?php
						}
						else
						{
							?>
                            <div class="alert alert-danger">Boş bıraktığınız alanları doldurunuz.</div>
                            <?php
						}
					}
					?>
						<form action="#" method="post">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6">
									<div class="single-contact-field">
										<input type="text"  name="adsoyad" class="text-field" id="name" placeholder="Ad Soyad" required>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6">
									<div class="single-contact-field">
										<input type="email"  name="mail" class="text-field" id="email" placeholder="E-mail" required>
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="single-contact-field">
										<input type="text"  name="telefon" class="text-field" id="subject" placeholder="Telefon">
									</div>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="single-contact-field">
										<textarea name="mesaj" id="msg" placeholder="Mesajınız"></textarea>
									</div>
									<input type="submit" name="submit" value="Gönder" id="submitButton" class="btn3" data-text="Gönder">
								</div>
							</div>
							<div id="form-messages"></div>
						</form>
					</div>
				</div>
				<div class="col-md-5 col-sm-6 col-xs-12">
					<div class="contact-info">
						<h3>Herhangi bir sorunuz varsa, lütfen bize mesaj göndermekten çekinmeyin. 24 saat içinde cevap veriyoruz.</h3>
						<ul>
							<li>
								<div class="contact-icon">
									<i class="fa fa-mobile"></i>
								</div>
								<div class="info-text">
									<strong>Telefon:</strong><br>
                                    <a href="tel:<?=$sitetelefon?>" target="_blank"><?=$sitetelefon?></a><br />
									<?php
                                    if(!empty($sitetelefon2)){?><a href="tel:<?=$sitetelefon?>" target="_blank"><?=$sitetelefon2?></a><br /><?php }
                                    ?>
                                    <?php if(!empty($sitefax)){?><a href="fax:<?=$sitefax?>" target="_blank"><?=$sitefax?></a><?php } ?>
								</div>
							</li>
							<li>
								<div class="contact-icon">
									<i class="fa fa-map-marker"></i>
								</div>
								<div class="info-text">
									<strong>Adres:</strong><br><?=$siteadres?>
								</div>
							</li>
							<li>
								<div class="contact-icon">
									<i class="fa fa-envelope-o"></i>
								</div>
								<div class="info-text">
									<strong>Email:</strong><br>
                                    <a href="mailto:<?=$sitemail?>" target="_blank"><?=$sitemail?></a>
									<?php
                                    if(!empty($sitemail2)){?><br /><a href="mailto:<?=$sitemail2?>" target="_blank"><?=$sitemail2?></a><?php }
                                    ?>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
    