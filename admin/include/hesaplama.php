<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Nakliye Hesabı / Sipariş</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
              <li class="breadcrumb-item active">Nakliye - Sipariş</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
       <form action="#" method="get" enctype="multipart/form-data">
       <div class="col-md-12">
       <div class="card-body card card-primary">
            <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                <label>Başlanacak Şehir</label>
                <input type="text" class="form-control" placeholder="İstanbul ..." name="konum1" required="required">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Hedef Şehir</label>
                <input type="text" class="form-control" placeholder="Ankara ..." name="konum2" required="required">
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                <label>Yol Tipi</label>
                <select class="form-control" name="tipi">
                <option value="Karayolu">Karayolu</option>
                <option value="Havayolu">Havayolu</option>
                <option value="Denizyolu">Denizyolu</option>
                </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">HESAPLA</button>
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
    <?php
	if($_GET)
	{
		if(!empty($_GET["konum1"]) && !empty($_GET["konum2"]) && !empty($_GET["tipi"]) && !$_POST)
		{
			?>
             <section class="content">
              <div class="container-fluid">
               <form action="#" method="post" enctype="multipart/form-data">
               <div class="col-md-12">
               <div class="card-body card card-primary">
            <div class="row">
               <div class="col-md-3"><span style="font-size: 13px; color: #8d8d8d;">Başlama Şehir : </span><strong style="color:#9C27B0;"><?=stripslashes($_GET["konum1"])?></strong>  </div>
               <div class="col-md-3"><span style="font-size: 13px; color: #8d8d8d;">Hedef Şehir : </span><strong style="color:#8bc34a;"><?=stripslashes($_GET["konum2"])?></strong></div>
               <div class="col-md-2"><span style="font-size: 13px; color: #8d8d8d;">Yol Tipi : </span><strong style="color:#ff9800;"><?=stripslashes($_GET["tipi"])?></strong></div>
               <div class="col-md-2"><span style="font-size: 13px; color: #8d8d8d;">Kilometre : </span><strong style="color:#2196f3;"><?=$km=rand(100,400)?></strong></div>
               <div class="col-md-2"><span style="font-size: 13px; color: #8d8d8d;">Tutar : </span><strong style="color:#E91E63;"><?=$tutar=($km*3.40)?> TL</strong></div>
               </div>
               
               <input type="hidden" name="tutar" value="<?=$tutar?>" />
               <input type="hidden" name="km" value="<?=$km?>" />
               <div class="col-md-12">
                    <div class="form-group">
                    <button type="submit" class="btn btn-block btn-success" style="margin-top: 28px !important; width: 200px; float: right;">SİPARİŞ OLUŞTUR</button>
                    </div>
                </div>
                </div>
               </div>
              </form>
              </div>
              </section>
            <?php
		}
		else if($_POST)
		{
			if(!empty($_GET["konum1"]) && !empty($_GET["konum2"]) && !empty($_GET["tipi"]) && !empty($_POST["tutar"]) && !empty($_POST["km"]))
			{
				/*sipariş ekle*/
				$konum1=$VT->filter($_GET["konum1"]);
				$konum2=$VT->filter($_GET["konum2"]);
				$tipi=$VT->filter($_GET["tipi"]);
				$tutar=$VT->filter($_POST["tutar"]);
				$km=$VT->filter($_POST["km"]);
				$kullaniciID=$VT->filter($_SESSION["ID"]);
				$ekle=$VT->SorguCalistir("INSERT INTO siparisler","SET kullaniciID=?, konum1=?, konum2=?, tipi=?, km=?, fiyat=?, tarih=?",array($kullaniciID,$konum1,$konum2,$tipi,$km,$tutar,date("Y-m-d")));
				?>
                <div class="alert alert-success">Siparişiniz oluşturulmuştur. Lütfen bekleyiniz.</div>
                <meta http-equiv="refresh" content="2;url=<?=SITE?>siparisler" />
                <?php
			}
		}
	}
	?>
    <!-- /.content -->
  </div>
 
