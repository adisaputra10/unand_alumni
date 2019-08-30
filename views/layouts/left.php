<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use app\models\Menu;
use app\assets\AppAsset;
use app\models\BiodataCalon;
use app\models\Identitasalumni;

$akun = Identitasalumni::findOne(Yii::$app->user->identity->id);
$userNama = $akun->namalengkap;
if (strlen($userNama) > 15) {
    $pengguna = substr($userNama, 0, 15) . '...';
    $penggunaFull = $userNama;
} else {
    $pengguna = $userNama;
    $penggunaFull = $userNama;
}
?>
<!--overflow-y: auto;overflow-x: hidden;-->
<aside class="main-sidebar" style="height: 100%;overflow-y: auto;overflow-x: hidden;">
    <section class="sidebar">
        <div class="user-panel" style="margin-bottom: 0px;padding-bottom: 0px;">
            <div class="pull-left image">

                <?php
                if ($akun->foto == '') {
                    echo Html::img(Url::to(['/site/image', 'filename' => 'nobody.png']), ['class' => 'img-circle', 'alt' => 'User Image']);
                } else {
                    echo Html::img(Url::to(['/site/getfoto', 'filename' => $akun->foto]), ['class' => 'img-circle', 'alt' => 'User Image']);
                }
                ?>
            </div>
            <div class="pull-left info">
                <p>
                    <a href="#" title="<?php echo $penggunaFull; ?>"><?php echo $pengguna; ?></a>
                </p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <?php
        $menu = new Menu();
        echo dmstr\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu'],
            'items' => [
                    ['label' => 'MAIN NAVIGATION', 'icon' => 'fa fa-home', 'options' => ['class' => 'header']],
                    ['label' => 'Home', 'icon' => 'home', 'url' => ['/site/index']],
                   // ['label' => 'Update Profil', 'icon' => 'tag', 'url' => ['/site/post']],
                 ['label' => 'Update Profil ', 'icon' => 'history', 'url' => ['/daftar/identitas-alumni/update']],
                      // ['label' => 'Berita', 'icon' => 'calendar', 'url' => ['/daftar/post/index']],
                   
                    ['label' => 'View Biodata', 'icon' => 'user-secret', 'url' => ['/daftar/identitas-alumni/view']],
                    ['label' => 'Data Lulusan Fakultas ', 'icon' => 'key', 'url' => ['/daftar/wisuda-wisudawan/index']],
                
            ]
        ]);
        ?>
    </section>
</aside>
