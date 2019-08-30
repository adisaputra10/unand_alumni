<?php

namespace app\modules\models;

use Yii;

/**
 * This is the model class for table "agenda".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $category_id
 * @property string $image
 * @property string $create_time
 * @property int $update_time
 * @property int $user_id
 */
class Agenda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'agenda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'content', 'category_id', 'image', 'user_id'], 'required'],
            [['content'], 'string'],
            [['category_id', 'update_time', 'user_id'], 'integer'],
            [['create_time'], 'safe'],
            [['title'], 'string', 'max' => 128],
            [['image'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'category_id' => 'Category ID',
            'image' => 'Image',
            'create_time' => 'Create Time',
            'update_time' => 'Update Time',
            'user_id' => 'User ID',
        ];
    }
}
