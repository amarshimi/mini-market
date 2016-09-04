/**
 * Created by shimi on 16/02/16.
 */

var Product = function () {

    var elements = {},
        selectors = {},
        self = this;

    this.init = function () {

        selectors = self.initSettings();

        elements = self.initElements();
        self.attachEvents();

    };

    this.initElements = function () {

        var elements = {};
        elements.$addToCart = $(selectors.settings.selectors.addToCart);
        elements.$removeFromCart = $(selectors.settings.selectors.removeFromCart);
        elements.$addPriceStore = $(selectors.settings.selectors.addPriceStore);

        return elements;

    };

    this.attachEvents = function () {
        elements.$addToCart.on('click', addToCart);
        elements.$removeFromCart.on('click', removeFromCart);
        elements.$addPriceStore.on('click', pairingProducts);
    };

    var addToCart = function () {
        var $id = $(this).data(selectors.settings.data.productId);
        $.ajax({
            method: "POST",
            url: App.product.addToCart.ajaxUrl,
            data: {productId: $id}
        }).success(function (html) {
            alert(html);
        });
    };

    var removeFromCart = function () {
        var $id = $(this).data(selectors.settings.data.productId);
        $.ajax({
            method: "POST",
            url: App.product.removeFromCart.ajaxUrl,
            data: {productId: $id}
        }).success(function (html) {
            alert(html);
        });
    }


    var pairingProducts = function () {
        var $id = $(this).data(selectors.settings.data.productId);
        var $storeId = $(this).data(selectors.settings.data.storeId);
        var $price = $(this).parent().parent().find(selectors.settings.selectors.inputText).val();

        console.log($price);
        $.ajax({
            method: "POST",
            url: App.product.pairingProducts.ajaxUrl,
            data: {productId: $id , storeId: $storeId , price : $price}
        }).success(function (html) {
            alert(html);
        });
    }

};

Product.prototype.initSettings = function () {

    return {
        settings: {
            selectors: {
                addToCart: '.add-to-cart',
                removeFromCart: '.remove-from-cart',
                addPriceStore: '.add-price-store',
                inputText: 'input[type=text]'
            },
            data: {
                productId: 'product-id',
                storeId : 'store-id'
            }
        }

    }

}

$(function () {

    var product = new Product();
    product.init();
});

