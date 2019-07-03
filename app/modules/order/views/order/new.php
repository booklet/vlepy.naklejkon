<?php include 'app/views/shared/_intro_banner.php'; ?>

<form id="order" class="form" action="<?= Routing::path('order_create') ?>" method="POST" enctype="multipart/form-data">
    <div class="container container--540">
        <div class="title title--underscore">Wybrane naklejki</div>
        <div class="order__products">
            <?php $total_price = 0.00; ?>
            <?php foreach ($params['products'] as $product): ?>
                <?php $total_price += $product['total_price']; ?>
                <div class="product product--<?= $product['uid'] ?>">
                    <input type="hidden" name="products[<?= $product['uid'] ?>][uid]" value="<?= $product['uid'] ?>" />
                    <input type="hidden" name="products[<?= $product['uid'] ?>][dimensions]" value="<?= $product['dimensions'] ?>" />
                    <input type="hidden" name="products[<?= $product['uid'] ?>][quantity]" value="<?= $product['quantity'] ?>" />
                    <input type="hidden" name="products[<?= $product['uid'] ?>][price]" value="<?= $product['price'] ?>" />
                    <input type="hidden" name="products[<?= $product['uid'] ?>][total_price]" value="<?= $product['total_price'] ?>" />

                    <div class="product__name"><?= $product['dimensions'] ?></div>
                    <div class="product__file">
                        <input id="file-<?= $product['uid'] ?>" type="file" name="projects[<?= $product['uid'] ?>]" accept="application/pdf,image/jpeg,image/png" required />
                        <label for="file-<?= $product['uid'] ?>">Dodaj plik</label>
                    </div>
                    <div class="product__quantity"><?= $product['quantity'] * Config::get('package_size') ?>&nbsp;szt</div>
                    <div class="product__price"><?= to_pln($product['total_price']) ?></div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="order__shipment">
            <div class="order__shipment__name">
                <?= Config::get('shipping_name') ?>
            </div>
            <div class="order__shipment__price">
                <?= to_pln(Config::get('shipping_price')) ?>
            </div>
        </div>
        <div class="order__total-price">
            Łącznie: <span><?= to_pln($total_price + Config::get('shipping_price')) ?></span>
        </div>
        <div class="title title--small title--underscore">Szczegóły zamówienia</div>
        <div class="order__customer">
            <div class="flexbox flexbox--grid">
                <div class="col col--5">
                    <div class="form-group">
                        <label for="">Imię</label>
                        <input class="order__customer-first-name form-control" type="text" name="order[customer_first_name]" required />
                    </div>
                </div>
                <div class="col col--7">
                    <div class="form-group">
                        <label for="">Nazwisko</label>
                        <input class="order__customer-last-name form-control" type="text" name="order[customer_last_name]" required />
                    </div>
                </div>
                <div class="col col--12">
                    <div class="form-group">
                        <label for="">E-mail</label>
                        <input class="order__email form-control" type="email" name="order[customer_email]" required />
                    </div>
                </div>
                <div class="col col--12">
                    <div class="form-group">
                        <label for="">Numer telefonu</label>
                        <input class="order__phone-number form-control" type="text" name="order[customer_phone_number]" required />
                    </div>
                </div>
                <div class="col col--8">
                    <div class="form-group">
                        <label for="">Ulica</label>
                        <input class="order__street form-control" type="text" name="order[street]" required />
                    </div>
                </div>
                <div class="col col--4">
                    <div class="form-group">
                        <label for="">Nr domu</label>
                        <input class="order__house-number form-control" type="text" name="order[house_number]" required />
                    </div>
                </div>
                <div class="col col--3">
                    <div class="form-group">
                        <label for="">Kod pocztowy</label>
                        <input class="order__zip-code form-control" type="text" name="order[zip_code]" required />
                    </div>
                </div>
                <div class="col col--9">
                    <div class="form-group">
                        <label for="">Miasto</label>
                        <input class="order__city form-control" type="text" name="order[city]" required />
                    </div>
                </div>
            </div>
        </div>
        <div class="text-right mg-t30">
            <button class="btn btn--primary" type="submit">
                Zamawiam z obowiązkiem zapłaty
            </button>
        </div>
    </div>
</form>

<?php // include 'app/views/shared/_insta_gallery.php'; ?>
