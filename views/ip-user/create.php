<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\IpUser */

$this->title = Yii::t('app', 'Create Ip User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Ip Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ip-user-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
