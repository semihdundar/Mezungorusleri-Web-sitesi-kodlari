<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?=SITE?>" class="brand-link">
      <img src="<?=SITE?>dist/img/AdminLTELogo.png" alt="Mehmet ULUS Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">YÖNETİM PANELİ</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=SITE?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?=$_SESSION["adsoyad"]?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
              <!-- <li class="nav-item">
            <a href="<?=SITE?>modul-ekle" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Modül Ekle
               
              </p>
            </a>
          </li>-->

           <li class="nav-item">
            <a href="<?=SITE?>banner-liste" class="nav-link">
              <i class="nav-icon fas fa-image"></i>
              <p>
                Banner
               
              </p>
            </a>
          </li>

          


          <?php
			 $moduller=$VT->VeriGetir("moduller","WHERE durum=?",array(1),"ORDER BY ID ASC");
			 if($moduller!=false)
			 {
				 for($i=0;$i<count($moduller);$i++)
				 {
					 ?>
            <li class="nav-item">
                        <a href="<?=SITE?>liste/<?=$moduller[$i]["tablo"]?>" class="nav-link">
                          <i class="far fa-circle nav-icon"></i>
                          <p><?=$moduller[$i]["baslik"]?></p>
                        </a>
                      </li>
                      
                     <?php
				 }
			 }
			 ?>

                <li class="nav-item">
                        <a href="<?=SITE?>fakulte-liste" class="nav-link">
                          <i class="far fa-building nav-icon"></i>
                          <p>Fakülteler</p>
                        </a>
                      </li>

<li class="nav-item">
            <a href="<?=SITE?>yorumlar" class="nav-link">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Yorumlar
               <?php
               $yeniyorumlar=$VT->VeriGetir("yorumlar","WHERE durum=?",array(2));
               if($yeniyorumlar!=false)
               {
                ?>
                <span class="right badge badge-danger"><?=count($yeniyorumlar)?></span>
                <?php
               }
               ?>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=SITE?>mesajlar" class="nav-link">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Mesajlar
               <?php
               $yenimesajlar=$VT->VeriGetir("mesajlar","WHERE durum=?",array(1));
               if($yenimesajlar!=false)
               {
                ?>
                <span class="right badge badge-danger"><?=count($yenimesajlar)?></span>
                <?php
               }
               ?>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="<?=SITE?>seo-ayarlari" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Seo Ayarları
              </p>
            </a>
          </li>
           <li class="nav-item">
            <a href="<?=SITE?>iletisim-ayarlari" class="nav-link">
              <i class="nav-icon fas fa-users-cog"></i>
              <p>
                İletişim Ayarları
              </p>
            </a>
          </li>
         <li class="nav-item">
            <a href="<?=SITE?>cikis" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
                Çıkış Yap
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>