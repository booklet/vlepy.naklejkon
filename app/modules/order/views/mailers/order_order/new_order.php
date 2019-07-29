<div>Klient: <b><?= $customer_first_name ?>&nbsp;<?= $customer_last_name ?></b></div>
<div>E-mail: <b><?= $customer_email ?></b></div>
<div>Numer tel: <b><?= $customer_phone_number ?></b></div>
<div>Ulica: <b><?= $street ?>&nbsp;<?= $house_number ?></b></div>
<div>Miasto: <b><?= $zip_code ?>&nbsp;<?= $city ?></b></div>
<div>Wartość: <b><?= to_pln($total_price) ?></b></div>
<br />
<div><b>Wybrane vlepki:</b></div>
<ul>
    <?php foreach ($products as $product): ?>
        <li>
            <?= $product['dimensions'] ?>
            (<b><?= to_pln($product['total_price']) ?></b>, <?= Config::get('package_size') * $product['quantity'] ?> szt):
            <b><?= $product['file']['name'] ?></b>
        </li>
    <?php endforeach; ?>
</ul>
