<?php

namespace app\models;

use Yii;
use yii\web\NotFoundHttpException;

/**
 * This is the model class for table "forward_traffic".
 *
 * @property int $id
 * @property string $date
 * @property string $time
 * @property string $srcip
 * @property string $dstip
 * @property string $hostname
 * @property string $app
 * @property string $appcat
 */
class ForwardTraffic extends \yii\db\ActiveRecord
{
    public $logfile;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'forward_traffic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['logfile'], 'required'],
            [['date', 'time'], 'safe'],
            [['srcip', 'dstip', 'hostname', 'app', 'appcat'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'time' => 'Time',
            'srcip' => 'Source IP',
            'dstip' => 'Destination IP',
            'hostname' => 'Hostname',
            'app' => 'Application',
            'appcat' => 'Application Category',
        ];
    }

    public static function saveFiles($file){
	    $temp = (explode(".", $file->name));
		$ext = strtolower(end($temp));
		$fileName = strtolower(preg_replace('/\s+/', '', $file->baseName)).'_'.date('Y-m-d_his');
		$saveName = $fileName.'.'.$ext;
		if($file->saveAs('localhost:8080/bpknetwork/web/uploads/'.$saveName)){
			return $saveName;
		}else{
			throw new \yii\web\NotFoundHttpException('Kesalahan Inputan File, Pastikan File Yang Anda Upload Merupakan File Dengan Nama Tidak Melebihi 255 karakter');
		}
	}
}
