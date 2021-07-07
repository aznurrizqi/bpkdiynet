<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "active_user".
 *
 * @property int $id
 * @property string $on_date
 * @property int $user_number
 */
class ActiveUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'active_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['on_date', 'user_number'], 'required'],
            [['on_date'], 'safe'],
            [['user_number'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'on_date' => 'On Date',
            'user_number' => 'User Number',
        ];
    }
}
