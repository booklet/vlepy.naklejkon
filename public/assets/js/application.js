(function($) {
    $.fn.elemExists = function(callback = null) {
        if ($(this).length) {
            if (callback && typeof callback == 'function') {
                callback.call(this);
            }

            return true;
        }

        return false;
    };

    $(function() {
        $('#reviews .reviews-wrapper').elemExists(function() {
            this.slick({
                autoplay: true,
                autoplaySpeed: 6000,
                infinite: true,
                speed: 600,
                draggable: true
            });
        });

        $('#insta-gallery .instafeed').elemExists(function() {
            this.eappsInstagramFeed({
                api: '/public/assets/js/instashow/api/',
                source: '@vlepy',
                width: 'auto',
                height: 'auto',
                lang: 'pl',
                columns: 4,
                rows: 2,
                gutter: 10,
                responsive: {
                    "400": { "columns": 1, "rows": 1, },
                    "800": { "columns": 2, "rows": 1, },
                    "1200": { "columns": 4, "rows": 2, },
                },
                colorGalleryOverlay: 'rgba(224, 0, 30, 0.8)'
            });
        });
    });
})( jQuery );
