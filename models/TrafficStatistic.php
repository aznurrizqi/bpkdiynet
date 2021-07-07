<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "traffic_statistic".
 *
 * @property int $id
 * @property string $summary_type
 * @property string $statistic
 */
class TrafficStatistic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'traffic_statistic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['summary_type', 'statistic'], 'required'],
            [['summary_type', 'statistic'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'summary_type' => 'Summary Type',
            'statistic' => 'Statistic',
        ];
    }
}
