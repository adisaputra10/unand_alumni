<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\modules\daftar\models\IdentitasAlumniSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Identitas Alumni';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="identitas-alumni-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
 
    </p>

   
 
                


</div>

<?php

/* date_default_timezone_set('Asia/Jakarta');
$server = "localhost";
$username = "root";
$password = "";
$database = "app_basic";

mysql_connect($server,$username,$password);
mysql_select_db($database);
$tampil = mysql_query("SELECT * FROM identitasalumni ");

while($r=mysql_fetch_array($tampil)){
    echo "$r[nim]<br>";

} */




//include "../a.php";
include_once( dirname(__FILE__) . "/../../../../database.php");
//echo dirname(__FILE__);
//$url = Yii::app()->basePath;
//echo "$url";



  
?>

<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 
<div class="panel panel-default" style="margin-top: -15px;">
    <div class="panel-heading" style="padding: 1px;">
        <?php
      
        ?>
        <div style="clear: both;"></div>
    </div>
    <div class="panel-body" style="padding:3px;">
        <div class="table-responsive">
            <br>
      <form action="?ko=ko" method="GET" >
     
      <table border=0 width="600px">
      <tr>
      <td> Filter</td>
      <td>    <select class="form-control" id="sel1" name="data">
        <option value="">Tahun Angkatan  </option>
        <?php 
             $tampil = mysql_query("SELECT distinct angkatan FROM identitasalumni ");
             while($r=mysql_fetch_array($tampil)){
        ?>
        <option><?php echo $r['angkatan']; ?></option>
 
        <?php 
             }
        ?>

      </select> </td>
      <td> <input type="submit" name='save' class="btn btn-success"value="Pilih"> </td>
      </tr>
      </table>
      </form> 
      
      <br>
      <a class="btn btn-success" href="/web/alumni/web/daftar/identitas-alumni/create">Add  Alumni</a><br>

            <br>
            
            <table class="table-bordered table-condensed table-striped" style="margin-bottom: 5px;width: 100%;">
                <thead>
                    <tr>
                    <th style="width: 40px;text-align: left;">No </th>
                        <th style="width: 1500px;text-align: left;">No Alumni</th>
                        <th style="width: 1500px;text-align: left;">Username</th>
                        <th style="width: 1500px;text-align: left;">Password</th>
                        
                        <th style="width: 1500px;text-align: left;">Nama Lengkap</th>
                        <th style="width: 1500px;text-align: left;">NIM</th>
                        <th style="width: 1500px;text-align: left;">Action</th>
                    </tr>
                
                </thead>
                <tbody>
                    
                    <?php $no=1; 
                    if(isset($_GET['save'])){
                        $data=$_GET['data'];
                        //echo "aa $data";
                        $tampil = mysql_query("SELECT * FROM identitasalumni where angkatan like '%$data%'");
                    }else{
                       // echo "sss";

                        $tampil = mysql_query("SELECT * FROM identitasalumni ");
                    }


                  //  $tampil = mysql_query("SELECT * FROM identitasalumni ");
                    while($r=mysql_fetch_array($tampil)){
                    ?>
                                <tr>
                                <td style="vertical-align: top;">1 </td>
                                    <td style="vertical-align: top;"><?php echo $r['idalumni']; ?> </td>
                                    <td style="vertical-align: top;">  <?php echo $r['username']; ?> </td>
                                    <td style="vertical-align: top;"> <?php echo $r['password']; ?>  </td>
                                    <td style="vertical-align: top;"> <?php echo $r['namalengkap']; ?> </td>
                                    <td style="vertical-align: top;"><?php echo $r['nim']; ?>  </td>
                                    <td style="vertical-align: top;">
                                     <a href="/web/alumni/web/daftar/identitas-alumni/view?id=<?php echo $r['idalumni']; ?>" title="View" aria-label="View" data-pjax="0"><span class="glyphicon glyphicon-eye-open"></span></a>
                                     <a href="/web/alumni/web/daftar/identitas-alumni/update?id=<?php echo $r['idalumni']; ?>" title="Update" aria-label="Update" data-pjax="0"><span class="glyphicon glyphicon-pencil"></span></a> 
                                     <a href="/web/alumni/web/daftar/identitas-alumni/delete?id=<?php echo $r['idalumni']; ?>" title="Delete" aria-label="Delete" data-pjax="0" data-confirm="Are you sure you want to delete this item?" data-method="post"><span class="glyphicon glyphicon-trash"></span></a>
                                    
                                     </td>
                                </tr>
                   
                    <?php }  ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

