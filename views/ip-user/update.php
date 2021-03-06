<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IpUser */

$this->title = Yii::t('app', 'Update Ip User: {name}', [
    'name' => $model->id,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'IP Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="ip-user-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
