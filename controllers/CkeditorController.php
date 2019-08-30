<?php

namespace app\controllers;

use app\models\CkeditorUploadForm;
use Yii;
use yii\helpers\Url;
use yii\web\UploadedFile;

class CkeditorController extends \yii\web\Controller
{
    public function actionStore()
    {
        $model = new CkeditorUploadForm();
        
        if (Yii::$app->request->isPost) {
//            $model->upload = UploadedFile::getInstance($model, 'upload');
            $model->upload = UploadedFile::getInstanceByName('upload');
            
            if ($model->uploadFile()) {
                var_dump($model->uploadPath);
                
                $CKEditorFuncNum = $_GET['CKEditorFuncNum'];
                $url = Yii::$app->getUrlManager()->getBaseUrl().'/'.$model->uploadPath;
                $script = "<script>window.parent.CKEDITOR.tools.callFunction(".$CKEditorFuncNum.", '".$url."')</script>";
                echo $script;
            }
        }
    }

}
