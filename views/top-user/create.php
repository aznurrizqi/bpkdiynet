<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\TopUser */

$this->title = Yii::t('app', 'Create Top User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Top Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="top-user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
