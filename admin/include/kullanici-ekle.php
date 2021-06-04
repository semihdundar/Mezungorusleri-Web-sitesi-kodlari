<?php
if($_SESSION["ID"]==1)
{
}
else
{
	?>
    <meta http-equiv="refresh" content="0;url=<?=SITE?>" />
    <?php
	exit();
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Kullanıcı Ekle</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
              <li class="breadcrumb-item active">Kullanıcı Ekle</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
      <div class="row">
      <div class="col-md-12">
      <a href="<?=SITE?>kullanici-liste" class="btn btn-info" style="float:right; margin-bottom:10px; margin-left:10px;"><i class="fas fa-bars"></i> LİSTE</a> 
       <a href="<?=SITE?>kullanici-ekle" class="btn btn-success" style="float:right; margin-bottom:10px;"><i class="fa fa-plus"></i> YENİ EKLE</a>
       </div>
       </div>
       <?php
	   if($_POST)
	   {
		   if(!empty($_POST["adsoyad"]) && !empty($_POST["kullanici"]) && !empty($_POST["sifre"]) && !empty($_POST["mail"]))
		   {
			   $adsoyad=$VT->filter($_POST["adsoyad"]);
			   $kullanici=$VT->filter($_POST["kullanici"]);
			   $sifre=md5($VT->filter($_POST["sifre"]));
			   $mail=$VT->filter($_POST["mail"]);
			$kontrol=$VT->VeriGetir("kullanicilar","WHERE kullanici=?",array($kullanici),"ORDER BY ID ASC");
			if($kontrol!=false)
			{
				$ekle=false;
			}
			else
			{
				   $ekle=$VT->SorguCalistir("INSERT INTO kullanicilar","SET adsoyad=?, kullanici=?, sifre=?, mail=?, tarih=?",array($adsoyad,$kullanici,$sifre,$mail,date("Y-m-d")));
			}
			  
			   if($ekle!=false)
			   {
				    ?>
                   <div class="alert alert-success">İşleminiz başarıyla kaydedildi.</div>
                   <?php
			   }
			   else
			   {
				    ?>
                   <div class="alert alert-danger">Aynı kullanıcı ismine kayıtlı üye var!</div>
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
       <form action="#" method="post" enctype="multipart/form-data">
       <div class="col-md-8">
       <div class="card-body card card-primary">
            <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                <label>Ad Soyad</label>
                <input type="text" class="form-control" placeholder="Ad Soyad ..." name="adsoyad" required="required">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label>Kullanıcı Adı</label>
                <input type="text" class="form-control" placeholder="Kullanıcı Adı ..." name="kullanici" required="required">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label>Kullanıcı Parola</label>
                <input type="text" class="form-control" placeholder="Parola ..." name="sifre" required="required">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label>E-mail</label>
                <input type="text" class="form-control" placeholder="E-mail ..." name="mail" required="required">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">KAYDET</button>
                </div>
            </div>
            
            <!-- /.row -->
          </div>
          <!-- /.card-body -->
        </div>
        </div>
       </form>
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 
