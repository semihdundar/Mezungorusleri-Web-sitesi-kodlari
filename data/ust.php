<!--==================================================================== 
							Start Header Section 
	=====================================================================-->
    <section class="top_header_area ustUyeBar">
	    <div class="container">
            <ul class="nav navbar-nav top_nav navbar-right">
            <?php
            if(!empty($_SESSION["uyeID"]))
            {
                echo '<li style="padding: 15px 0px 0px; color: #fff;">Hoşgeldiniz '.$_SESSION["uyeAdi"].',</li>';
                ?>
                <li><a href="<?=SITE?>hesabim"><i class="fa fa-user"></i>Hesabım</a></li>
                <li><a href="<?=SITE?>cikis-yap" style="padding-left: 0;"><i class="fa fa-sign-in"></i>Çıkış</a></li>
                <?php
            }
            else
            {
                ?>
                <li><a href="<?=SITE?>uyelik"><i class="fa fa-user"></i>Giriş Yap / Üye Ol</a></li>
                <?php
            }
            ?>
										
                
            </ul>
	    </div>
	</section>

	<header class="header-area">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-3">
                    <div class="logo"> <!--/Start Logo Area -->
                        <a href="<?=SITE?>">
                        	<img src="<?=SITE?>images/logobeyaz.png" class="beyazlogo" />
                            <img src="<?=SITE?>images/logosiyah.png" class="siyahlogo" />
						</a>
                    </div> <!--/End Logo Area -->
                </div>
				 <div class="col-md-9 col-sm-9">
                    <div class="main-menu"> <!-- Start Menu Area -->
                        <div class="navbar">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse">
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                    	<a class="smoth-scroll" href="<?=SITE?>">ANASAYFA</a>
                                    </li>
                                    <?php
										$kurumsal=$VT->VeriGetir("kurumsal","WHERE durum=?",array(1),"ORDER BY sirano ASC",1);
										if($kurumsal!=false)
										{
											for ($i=0; $i <count($kurumsal) ; $i++) { 
												?>
											<li><a href="<?=SITE?>kurumsal/<?=$kurumsal[$i]["seflink"]?>" class="smoth-scroll">KURUMSAL</a></li>
												<?php
											}
										}
										?>
                                    <li>
                                    	<a class="smoth-scroll" href="<?=SITE?>universiteler">ÜNİVERSİTELER</a>
                                    </li>
                                    <li>
                                    	<a class="smoth-scroll" href="<?=SITE?>iletisim">İLETİŞİM</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> <!--/End Menu Area -->
                </div>
			</div>
		</div>
	</header> <!--/End Header Area -->
	<!--==================================================================== 
							End	Header Section 
	=====================================================================-->