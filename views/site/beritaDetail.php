<?php

use yii\helpers\Html;
use app\models\IndonesiaDate;
use app\components\AppVersion;
use yii\helpers\Url;
use app\models\AppGroup;

$version = new AppVersion();
$inDate = new IndonesiaDate();


/* @var $this yii\web\View */

$this->title = 'Pengumuman dan Informasi';
?>
<div class="site-index">

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
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-info-circle"></i>
                    Pengumuman dan Informasi
                </div> <?php //var_dump($berita); 
               ?>
                <div class="panel-body">
                    <h4><a href="<?php echo Url::to(['berita', 'act' => 'more', 'key' => $berita->beritaKey]); ?>"> <?php  echo $berita->beritaJudul; ?></a></h4>
                    <h5 style="font-style: italic;font-size: 12px;margin-top: -8px;">Last Update <?php echo $inDate->setDateTime($berita->beritaWktPublic); ?></h5>
                    <div style="margin-bottom: 25px;">
                        <?php echo $berita->beritaIsi; ?>
                    </div>
                    <a href="<?php echo Url::to(['berita', 'act' => 'list']); ?>" style="font-style: italic;">Daftar Pengumuman dan Informasi lainya...</a>
                </div>
            </div>
        </div>
    </div>
</div>





 
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