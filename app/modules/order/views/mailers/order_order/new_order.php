<div>Klient: <b><?= $customer_first_name ?>&nbsp;<?= $customer_last_name ?></b></div>
<div>E-mail: <b><?= $customer_email ?></b></div>
<div>Adres: <b><?= $street ?> <?= $house_number ?>, <?= $zip_code ?> <?= $city ?></b></div>
<br />
<div><b>Wybrane vlepki:</b></div>
<ul>
    <?php foreach ($products as $product): ?>
        <li>
            <?= $product['dimensions'] ?>
            (<?= Config::get('package_size') * $product['quantity'] ?> szt):
            <b><?= $product['file']['name'] ?></b>
        </li>
    <?php endforeach; ?>
</ul>
