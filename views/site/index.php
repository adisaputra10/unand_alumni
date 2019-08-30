<?php

use yii\helpers\Url;
use yii\helpers\Html;
use app\models\IndonesiaDate;

$inDate = new IndonesiaDate();

/* @var $this yii\web\View */

$this->title = 'Beranda';
?>
<div class="site-index">


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body center" style="padding-bottom: 0px;">
                    <div class="well">
                        <div class="panel-body center" >
                            <h4 style="font-style: italic;font-weight: bold;font-size: 20px;">Selamat datang di - Universitas Andalas</h4>
                            <p style="text-align: justify;">
                                <b><i>Sistem Informasi Alumni Fakultas di Universitas Andalas</i></b> <i></i> .
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">

            <div class="panel-heading">
                        <i class="fa fa-question-circle"></i>
                       Fakultas Farmasi
                    </div>
            
                <div class="panel-body center" style="padding-bottom: 0px;">
                <div style="margin-bottom: 10px;">
                        </div>

                        <img class="mySlides" height="500px" src="http://localhost:82/web/alumni/web/image?filename=manual%2Ffarmasi.jpg" style="width:100%">
  <img class="mySlides" height="500px" src="https://akademik.unand.ac.id/images/resized/images/resized/images/sampledata/slideshow/Pak_deri_960_300.png" style="width:100%">
  <img class="mySlides" height="500px"  src="http://localhost:82/web/alumni/web/image?filename=manual%2Ffarmasi.jpg" style="width:100%">





                </div>
            </div>
        </div>
    </div>


    




    <div class="row">
        <div class="col-lg-12" style="margin-top: -18px;">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i>
                    Pengumuman dan Informasi
                </div>
                <div class="panel-body center" style="padding-bottom: 15px;">
                    <?php
                    foreach ($berita as $valBe) {
                        ?>
                        <h4><a href="<?php echo Url::to(['berita', 'act' => 'more', 'key' => $valBe['id']]); ?>"><?php echo $valBe['title']; ?></a></h4>
                        <h5 style="font-style: italic;font-size: 12px;margin-top: -8px;">Last Update <?php echo $inDate->setDateTime($valBe['create_time']); ?></h5>
                        <div style="margin-bottom: 5px;">
                            <?php echo $valBe['content']; ?>
                        
                        </div>
                          <div style="margin-bottom: 5px;">
                            
                             <?php echo $valBe['foto']; ?>
                        </div>
                        <?php
                    }
                    ?>
                    <br/>
                    <a href="<?php echo Url::to(['berita', 'act' => 'list']); ?>" style="font-style: italic;">Daftar Pengumuman dan Informasi lainya...</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_email"></a>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.mySlides {display:none;}
</style>


<!-- Place either at the bottom in the <head> of your page or inside your CSS -->
<style type="text/css">
.flex-caption {
  width: 96%;
  padding: 2%;
  left: 0;
  bottom: 0;
  background: rgba(0,0,0,.5);
  color: #fff;
  text-shadow: 0 -1px 0 rgba(0,0,0,.3);
  font-size: 14px;
  line-height: 18px;
}
</style>
<<script>
var myIndex = 0;
carousel();

function carousel() {
  var i;
  var x = document.getElementsByClassName("mySlides");
  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";  
  }
  myIndex++;
  if (myIndex > x.length) {myIndex = 1}    
  x[myIndex-1].style.display = "block";  
  setTimeout(carousel, 5000); // Change image every 2 seconds
}
</script>