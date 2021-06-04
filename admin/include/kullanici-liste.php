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
            <h1 class="m-0 text-dark">Kullanıcılar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
              <li class="breadcrumb-item active">Kullanıcılar</li>
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
       <a href="<?=SITE?>kullanici-ekle" class="btn btn-success" style="float:right; margin-bottom:10px;"><i class="fa fa-plus"></i> YENİ EKLE</a>
       </div>
       </div>
       <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:50px;">Sıra</th>
                  <th>Ad Soyad</th>
                  <th style="width:200px;">Kullanıcı</th>
                  <th style="width:80px;">Tarih</th>
                  <th style="width:120px;">İşlem</th>
                </tr>
                </thead>
                <tbody>
                <?php
				$veriler=$VT->VeriGetir("kullanicilar","WHERE ID>?",array(1),"ORDER BY ID ASC");
				if($veriler!=false)
				{
					$sira=0;
					for($i=0;$i<count($veriler);$i++)
					{
						$sira++;
						?>
                        <tr>
                          <td><?=$sira?></td>
                          <td><?php
						  echo stripslashes($veriler[$i]["adsoyad"]);
						  ?>
                          </td>
                          <td>
                          <?php
						  echo stripslashes($veriler[$i]["kullanici"]);
						  ?>
                          </td>
                          <td><?=$veriler[$i]["tarih"]?></td>
                          <td>
                          <a href="<?=SITE?>kullanici-duzenle/<?=$veriler[$i]["ID"]?>" class="btn btn-warning btn-sm">Düzenle</a>
                          <a href="<?=SITE?>kullanici-sil/<?=$veriler[$i]["ID"]?>" class="btn btn-danger btn-sm">Kaldır</a>
                          </td>
                        </tr>
                        <?php
					}
				}
				?>               
                </tbody>
                <tfoot>
                <tr>
                  <th>Sıra</th>
                  <th>Ad Soyad</th>
                  <th>Kullanıcı</th>
                  <th>Tarih</th>
                  <th>İşlem</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
       
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 
