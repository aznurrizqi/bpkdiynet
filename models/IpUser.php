<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ip_user".
 *
 * @property int $id
 * @property string $ip
 * @property string $user
 */
class IpUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ip_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ip', 'user'], 'required'],
            [['ip', 'user'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'IP',
            'user' => 'Pengguna',
        ];
    }
}
