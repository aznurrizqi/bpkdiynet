<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ForwardTraffic */

$this->title = Yii::t('app', 'Create Forward Traffic');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Forward Traffics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="forward-traffic-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
