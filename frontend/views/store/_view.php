<?php
/**
 * Created by PhpStorm.
 * User: shimi
 * Date: 14/02/16
 * Time: 00:33
 */
use frontend\models\Product;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var Product $model */
?>

<script>

    var  App = App || {};
    App.product = {
        pairingProducts :{
            ajaxUrl :'<?= Url::to(['store/pairing-products'])?>'
        }


    }
</script>
<div class="item  col-xs-4 col-lg-4">
    <div class="thumbnail">
        <img class="group list-group-image" src="<?= $model->image_url ?>" alt=""/>

        <div class="caption">
            <h4 class="group inner list-group-item-heading">
                <?= $model->name ?></h4>

            <p class="group inner list-group-item-text">
                <?= $model->detailes ?>

            <div class="row">
                <div class="col-xs-12 col-md-6">
                    <label class="lead" for="price-<?=$model->id?>">

                        <?= Yii::t('app','price')?>
                    </label>

                    <?= Html::input('text','','',['class'=>'form-control','id'=>'price-'.$model->id])?>
                </div>
                <div class="col-xs-12 col-md-6">
                    <a class="btn btn-success add-price-store" data-store-id="<?= $_GET['id']?>" data-product-id="<?= $model->id?>" href="#"><?= Yii::t('app','save')?></a>
                    <a class="btn btn-danger " data-store-id="<?= $_GET['id']?>" data-product-id="<?= $model->id?>" href="#">Remove</a>
                </div>
            </div>
        </div>
    </div>
</div>
