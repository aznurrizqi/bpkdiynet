<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TopDestination */

$this->title = Yii::t('app', 'Create Top Destination');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Top Destinations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-destination-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
