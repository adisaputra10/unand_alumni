<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\daftar\models\TracerStudySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tracer Studies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tracer-study-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
    
<?php 
 include_once( dirname(__FILE__) . "/../../../../database.php");
?>









    <div class="panel-body" style="padding:3px;">
        <div class="table-responsive">
            <table class="table-bordered table-condensed table-striped" style="margin-bottom: 5px;width: 100%;">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 40px;text-align: center;">No</th>
                        <th rowspan="2" style="width: 200px;text-align: left;">Program Studi</th>
                        <th rowspan="2" style="width: 100px;text-align: center;">Jenjang</th>
                        <th colspan="2" style="width: 100px;text-align: center;">Jumlah</th>
                        <th rowspan="2" style="width: 80px;text-align: center;">Sub Total</th>
                    </tr>
                    <tr>
                        <th style="width: 50px;text-align: center;">L</th>
                        <th style="width: 50px;text-align: center;">P</th>
                    </tr>
                </thead>
                <tbody>
                  
                           <?php 
                           
                           function jumlahL($prod_id) {
                            $tampil = mysql_query("SELECT  count(*) as total FROM identitasalumni where idprodi='$prod_id'  ");
                            $data=mysql_fetch_assoc($tampil);
                            return $data['total'];
                           // return $r;
                        }
                           
                           
                           $no=1; $tampil = mysql_query("SELECT  * FROM ref_prodi_nasional order by 	prodiJenjang ");
             while($r=mysql_fetch_array($tampil)){ ?>
                                <tr>
                                    <td style="text-align: right;"><?php echo $no; ?>  	</td>
                                    <td style="vertical-align: top;"><?php echo $r['prodiNama']; ?> </td>
                                    <td style="vertical-align: top;text-align: center;"><?php echo $r['prodiJenjang']; ?> </td>
                                    <td style="vertical-align: top;text-align: center;"><?php  echo jumlahL($r['prodiKode']); ?> </td>
                                    <td style="vertical-align: top;text-align: center;"><?php  echo jumlahL($r['prodiKode']); ?></td>
                                    <td style="vertical-align: top;text-align: center;"><?php  echo jumlahL($r['prodiKode']); ?></td>
                                </tr>
                           
                                <?php $no++;
                            }
                        
                        ?>
                        <tr>
                            <td colspan="5" style="text-align: right;"><b>Total</b></td>
                            <td style="text-align: center;"><b>total</b></td>
                        </tr>
                    
                </tbody>
            </table>
        </div>
    </div>









</div>




