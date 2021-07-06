<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TopApp */

$this->title = Yii::t('app', 'Create Top App');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Top Apps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-app-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
