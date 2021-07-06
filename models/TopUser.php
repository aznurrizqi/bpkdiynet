<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "top_user".
 *
 * @property int $id
 * @property string $srcip
 * @property int $bandwidth
 * @property string $session
 */
class TopUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'top_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bandwidth'], 'number'],
            [['srcip', 'bandwidth', 'session'], 'required'],
            [['srcip', 'session'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'srcip' => 'IP',
            'bandwidth' => 'Bandwidth (GB)',
            'session' => 'Session',
        ];
    }
}
