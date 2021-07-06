<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TopDestination */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="top-destination-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'dstip')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bandwidth')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'session')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
