/**
 * Created by shimi on 28/02/16.
 */
var User = function () {

    var elements = {},
        selectors = {},
        self = this;

    this.init = function () {

        selectors = self.initSettings();

        elements = self.initElements();
        self.attachEvents();
        getLocation();
    };

    this.initElements = function () {

        var elements = {};
        elements.$latitude = $(selectors.settings.selectors.latitude);
        elements.$longitude = $(selectors.settings.selectors.longitude);

        return elements;

    };

    this.attachEvents = function () {
    };


    function getLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition);
        } else {
            alert("Geolocation is not supported by this browser.");
        }
    }
    function showPosition(position) {
        elements.$latitude.val(position.coords.latitude);
        elements.$longitude.val(position.coords.longitude);
    }

};

Product.prototype.initSettings = function () {

    return {
        settings: {
            selectors: {
                latitude: '#latitude',
                longitude: '#longitude'
            }
        }
    }
}

$(function () {

    var user = new User();
    user.init();
});