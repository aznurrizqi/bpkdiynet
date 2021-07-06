<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "top_app".
 *
 * @property int $id
 * @property string $application
 * @property int $bandwidth
 * @property string $session
 */
class TopApp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'top_app';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['bandwidth'], 'number'],
            [['application', 'bandwidth', 'session'], 'required'],
            [['application', 'session'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'application' => 'Application',
            'bandwidth' => 'Bandwidth (GB)',
            'session' => 'Session',
        ];
    }
}
