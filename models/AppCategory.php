<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "app_category".
 *
 * @property int $id
 * @property string $app_category
 * @property int $bandwidth
 */
class AppCategory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app_category';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bandwidth'], 'number'],
            [['app_category', 'bandwidth'], 'required'],
            [['app_category'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'app_category' => 'App Category',
            'bandwidth' => 'Bandwidth (GB)',
        ];
    }
}
