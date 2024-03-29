(function($) {
    // Custom validator methods
    $.validator.addMethod('zipCode', function(v, el) { return v.match(/^[0-9]{2}\-[0-9]{3}$/); }, 'Wprowadź kod w formacie nn-nnn.');
    $.validator.addMethod('phoneNumber', function(v, el) { return v.match(/^(\+48)?\s?[0-9]{3}\s?[0-9]{3}\s?[0-9]{3}$/); }, 'Prosze wpisać poprawny numer telefonu (9 cyfr).');

    $.fn.elemExists = function(callback = null) {
        if ($(this).length) {
            if (callback && typeof callback == 'function') {
                callback.call(this);
            }

            return true;
        }

        return false;
    };

    var toPLN = function(price) {
        return price.toFixed(2).toString().replace('.', ',') + '&nbsp;zł';
    }

    var generateUID = function(length = 32) {
        var hex_chr = '0123456789abcdef';
        var uid = '';
        for (var i = 0; i < length; i++) {
            var a = Math.floor(Math.random() * (hex_chr.length - 1));

            uid += hex_chr.charAt(a);
        }

        return uid;
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

        $('#new-order').elemExists(function() {
            var $self = this;
            var $dimensions_selector = $('#product-dimensions');
            var $quantity_selector = $('#product-quantity');
            var $product_price = $('#product-price');
            var $add_product_btn = $('#add-product');
            var $products_list = $('#products-list');
            var $total_price = $('#total-price span');
            var $submit_btn = $('#new-order button[type=submit]');

            var products = {};

            var productsNumber = function() { return Object.keys(products).length; }
            var updateSelectedProductPrice = function() {
                let dimensions = $dimensions_selector.val();
                let quantity = $quantity_selector.val();
                let price = $dimensions_selector.find('option:selected').data('price');

                price = parseInt(price) * quantity;

                $product_price.html(toPLN(price));
            }

            var updateOrderTotalPrice = function() {
                let total_price = 0.00;

                for (var uid in products) {
                    let product = products[uid];

                    total_price += product.total_price;
                }

                $total_price.html(toPLN(total_price));
            }

            var toggleSubmitButton = function() {
                if (productsNumber() > 0) {
                    $submit_btn.removeClass('btn--disabled').addClass('btn--primary'); // .fadeIn(200)
                } else {
                    $submit_btn.removeClass('btn--primary').addClass('btn--disabled'); // .fadeOut(200)
                }
            }

            var addProduct = function() {
                var $product = $('<li class="product"></li>');
                var $wrapper = $('<div class="flexbox flexbox--grid flexbox--align-center"></div>');

                var uid = generateUID(12);
                let dimensions = $dimensions_selector.val();
                let quantity = $quantity_selector.val();
                let price = parseInt($dimensions_selector.find('option:selected').data('price'));
                let total_price = price * quantity;

                products[uid] = {
                    uid: uid,
                    dimensions: dimensions,
                    quantity: quantity,
                    price: price,
                    total_price: total_price,
                    element: $product,
                }

                $product.addClass('product--' + uid);

                $product.append('<input type="hidden" name="products[' + uid + '][uid]" value="' + uid + '" />');
                $product.append('<input type="hidden" name="products[' + uid + '][dimensions]" value="' + dimensions + '" />');
                $product.append('<input type="hidden" name="products[' + uid + '][quantity]" value="' + quantity + '" />');
                $product.append('<input type="hidden" name="products[' + uid + '][price]" value="' + price + '" />');
                $product.append('<input type="hidden" name="products[' + uid + '][total_price]" value="' + total_price + '" />');

                $wrapper.append('<div class="col col--25p"><div class="product__name">' + dimensions + '</div></div>');
                $wrapper.append('<div class="col col--25p"><div class="product__quantity">' + (quantity * 500) + ' szt</div></div>');
                $wrapper.append('<div class="col col--25p"><div class="product__price">' + toPLN(total_price) + '</div></div>');
                $wrapper.append('<div class="col col--25p text-right"><div class="product__remove"></div></div>');

                $product.append($wrapper);

                $product.on('click', '.product__remove', function() {
                    delete products[uid];

                    $product.remove();

                    updateOrderTotalPrice();
                    toggleSubmitButton();
                });

                $products_list.append($product);

                updateOrderTotalPrice();
                toggleSubmitButton();
            }

            // $submit_btn.hide();

            $dimensions_selector.on('change', updateSelectedProductPrice);
            $quantity_selector.on('change', updateSelectedProductPrice);
            $add_product_btn.on('click', addProduct);
            $self.on('submit', function(e) {
                if (productsNumber() == 0) {
                    return false;
                }
            });
        });

        $('#order').elemExists(function() {
            var $self = this;
            var $products_list = $('#order .order__products');
            var $submit_btn = $('#order button[type=submit]');

            $.validator.setDefaults({ ignore: [] });

            $self.validate({
                groups: { username: 'product__file__input' },
                lang: 'pl',
                validClass: 'valid',
                errorClass: 'invalid',
                errorPlacement: function(er, el) {
                    if (el.hasClass('product__file__input')) {
                        var $missing_files_alert = $('<div class="alert alert--error text-center">Dodaj projekty do wybranych produktów</div>');

                        $self.find('.order__products-alerts').empty().append($missing_files_alert);

                        $([document.documentElement, document.body]).animate({ scrollTop: $missing_files_alert.offset().top - 100 }, 0);

                        el.on('change', function() { $self.find('.order__products-alerts').empty() });
                    } else {
                        el.closest('.form-group').append(er);
                    }
                },
            });

            $('#order .order__products .product .product__file__input').each(function(i, el) {
                $(el).rules('add', {
                    required: true,
                    messages: { required: 'Załącz projekt do druku.' }
                });
            });

            $('#order .order__phone-number').rules('add', {
                phoneNumber: true,
                messages: { phoneNumber: 'Proszę wpisywać poprawny numer telefonu.' }
            });

            $('#order .order__zip-code').rules('add', {
                zipCode: true,
                messages: { zipCode: 'Proszę podać poprawny kod pocztowy' }
            });

            $('#rules').rules('add', {
                required: true,
                messages: { required: 'Proszę zaakceptować regulamin' }
            });

            $('#order .product input[type=file]').on('change', function() {
                let id = $(this).attr('id');
                let file = this.files[0] || null;

                if (file) {
                    $(this).next('label[for=' + id + ']').html(file.name);
                }
            });
        });
    });
})( jQuery );
