<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>
<div class="pairing-products-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="products" class="row list-group">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemView' => '_view',
        ]);
        ?>


    </div>
</div>
