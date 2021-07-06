<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "top_destination".
 *
 * @property int $id
 * @property string $dstip
 * @property int $bandwidth
 * @property string $session
 */
class TopDestination extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'top_destination';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bandwidth'], 'number'],
            [['dstip', 'hostname', 'bandwidth', 'session'], 'required'],
            [['dstip', 'hostname', 'session'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'dstip' => 'Destination IP',
            'hostname' => 'Hostname',
            'bandwidth' => 'Bandwidth (GB)',
            'session' => 'Session',
        ];
    }
}
