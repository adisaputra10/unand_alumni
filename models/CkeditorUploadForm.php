<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;

class CkeditorUploadForm extends Model
{
    public $upload;
    public $uploadPath;

    public function rules()
    {
        return [
            [['upload'], 'file', 'skipOnEmpty' => false],
        ];
    }
    
    public function uploadFile()
    {
        if ($this->validate()) {
            $this->uploadPath = 'ckeditor/' . $this->upload->baseName . '.' . $this->upload->extension;
            $this->upload->saveAs($this->uploadPath);
            return true;
        } else {
            return false;
        }
    }
}
