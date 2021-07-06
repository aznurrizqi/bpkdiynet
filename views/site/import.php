<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ForwardTraffic */
/* @var $form yii\widgets\ActiveForm */

$this->title = Yii::t('app', 'Import Data');
// $this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Forward Traffics'), 'url' => ['index']];
// $this->params['breadcrumbs'][] = $this->title;
?>
<div class="forward-traffic-create">

    <div class="forward-traffic-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'logfile')->fileInput()->label('Pilih file (.XML)') ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Proses'), ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
