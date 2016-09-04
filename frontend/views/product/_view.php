<?php
/**
 * Created by PhpStorm.
 * User: shimi
 * Date: 14/02/16
 * Time: 00:33
 */
use frontend\models\Product;
use yii\helpers\Url;

/* @var Product $model */
?>

<script>

    var  App = App || {};
    App.product = {
        addToCart :{
            ajaxUrl :'<?= Url::to(['order/add-to-cart'])?>'
        },
        removeFromCart :{
            ajaxUrl :'<?= Url::to(['order/add-to-cart'])?>'
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
                    <p class="lead">
                        <?= $model->price ?></p>
                </div>
                <div class="col-xs-12 col-md-6">
                    <a class="btn btn-success add-to-cart" data-product-id="<?= $model->id?>" href="#">Add</a>
                    <a class="btn btn-danger remove-from-cart" data-product-id="<?= $model->id?>" href="#">Remove</a>
                </div>
            </div>
        </div>
    </div>
</div>
