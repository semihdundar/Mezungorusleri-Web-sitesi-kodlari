<?php
if(!empty($_GET["ID"]))
{
  $ID=$VT->filter($_GET["ID"]);

    $veri=$VT->VeriGetir("fakulteler","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);
    if($veri!=false)
    {
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Fakülte Düzenle</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
              <li class="breadcrumb-item active">Fakülte Düzenle</li>
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
      <a href="<?=SITE?>fakulte-liste" class="btn btn-info" style="float:right; margin-bottom:10px; margin-left:10px;"><i class="fas fa-bars"></i> LİSTE</a> 
       <a href="<?=SITE?>fakulte-ekle" class="btn btn-success" style="float:right; margin-bottom:10px;"><i class="fa fa-plus"></i> YENİ EKLE</a>
       </div>
       </div>
       <?php
	   if($_POST)
	   {
		   if(!empty($_POST["baslik"]) && !empty($_POST["sirano"]) && !empty($_POST["universiteID"]))
		   {
			   $baslik=$VT->filter($_POST["baslik"]);
			   $seflink=$VT->seflink($baslik);
         $universiteID=$VT->filter($_POST["universiteID"]);
			   $sirano=$VT->filter($_POST["sirano"]);
			   
					   $duzenle=$VT->SorguCalistir("UPDATE fakulteler","SET baslik=?, seflink=?, universiteID=?, sirano=?, tarih=?  WHERE ID=?",array($baslik,$seflink,$universiteID,$sirano,date("Y-m-d"),$veri[0]["ID"]),1);
				   
			   
			   if($duzenle!=false)
			   {
				    ?>
                   <div class="alert alert-success">İşleminiz başarıyla kaydedildi.</div>
                   <?php
			   }
			   else
			   {
				    ?>
                   <div class="alert alert-danger">İşleminiz sırasında bir sorunla karşılaşıldı. Lütfen daha sonra tekrar deneyiniz.</div>
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
                  <label>Üniversite Seç</label>
                  <select class="form-control select2" style="width: 100%;" name="universiteID">
                    <?php
					$universiteler=$VT->VeriGetir("universiteler","","","ORDER BY baslik ASC");
                    if($universiteler!=false)
                    {
                        for($i=0;$i<count($universiteler);$i++)
                        {
                            if($universiteler[$i]["ID"]==$veri[0]["universiteID"])
                            {
                                ?>
                            <option value="<?=$universiteler[$i]["ID"]?>" selected="selected"><?=stripslashes($universiteler[$i]["baslik"])?></option>
                            <?php
                            }
                            else
                            {
                                ?>
                            <option value="<?=$universiteler[$i]["ID"]?>"><?=stripslashes($universiteler[$i]["baslik"])?></option>
                            <?php
                            }
                            
                        }
                    }
					?>
                  </select>
                </div>
              <!-- /.col -->
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label>Başlık</label>
                <input type="text" class="form-control" placeholder="Başlık ..." name="baslik" value="<?=$veri[0]["baslik"]?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label>Sıra No</label>
                <input type="number" class="form-control" placeholder="Sıra No ..." name="sirano" style="width:100px;" value="<?=$veri[0]["sirano"]?>">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <label>Url</label>
                <input type="text" class="form-control" placeholder="Url ..." name="url">
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
  <?php
  }
  else
  {
    echo "Hatalı bilgi gönderildi.";
  }
}
else
{
  echo "Bu sayfaya erişim izniniz bulunmamaktadır.";
}
?>
