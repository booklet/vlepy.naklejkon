<form id="new-order" class="form" action="<?= Routing::path('order_new') ?>" method="POST">
    <a class="anchor" name="zamow"></a>
    <div class="container container--1200">
        <?php Alerts::display(); ?>
        <div class="card bg-dark">
            <div class="card-body">
                <div class="text-white">
                    <h3 class="title mg-b0">Zamów vlepki</h3>
                    <div class="text-std text-18 text-center mg-b30">
                        Aby złożyć zamówienie, wybierz z formularze poniżej
                        określony wymiar vlepek oraz ilość. Jeżeli masz więcej
                        niż jeden projekt,<br />po prostu dodaj kolejną pozycję
                        w formularzu. Następnie przejdź dalej, aby podać dane do
                        wysłyki.
                    </div>
                </div>
                <div class="bg-gray pd-t60 pd-b15">
                    <div class="container container--720">
                        <div class="new-order__add-product">
                            <div class="flexbox flexbox--grid flexbox--justify-center flexbox--align-center">
                                <div class="col col--25p">
                                    <div class="form-group mg-0">
                                        <label>Wymiar</label>
                                        <select id="product-dimensions" class="form-control">
                                            <option value="50x50 mm" data-price="33.00" selected>50x50 mm</option>
                                            <option value="60x60 mm" data-price="36.00">60x60 mm</option>
                                            <option value="70x70 mm" data-price="45.00">70x70 mm</option>
                                            <option value="80x80 mm" data-price="64.00">80x80 mm</option>
                                            <option value="90x90 mm" data-price="64.00">90x90 mm</option>
                                            <option value="100x100 mm" data-price="76.00">100x100 mm</option>
                                            <option value="120x120 mm" data-price="138.00">120x120 mm</option>
                                            <option value="150x150 mm" data-price="138.00">150x150 mm</option>
                                            <option value="70x50 mm" data-price="38.00">70x50 mm</option>
                                            <option value="100x50 mm" data-price="45.00">100x50 mm</option>
                                            <option value="100x70 mm" data-price="56.00">100x70 mm</option>
                                            <option value="150x50 mm" data-price="62.00">150x50 mm</option>
                                            <option value="150x70 mm" data-price="76.00">150x70 mm</option>
                                            <option value="150x100 mm" data-price="97.00">150x100 mm</option>
                                            <option value="200x100 mm" data-price="138.00">200x100 mm</option>
                                            <option value="200x150 mm" data-price="199.00">200x150 mm</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col col--25p">
                                    <div class="form-group mg-0">
                                        <label>Ilość</label>
                                        <select id="product-quantity" class="form-control">
                                            <option value="1" selected>500 szt</option>
                                            <option value="2">1000 szt</option>
                                            <option value="3">1500 szt</option>
                                            <option value="4">2000 szt</option>
                                            <option value="5">2500 szt</option>
                                            <option value="6">3000 szt</option>
                                            <option value="7">3500 szt</option>
                                            <option value="8">4000 szt</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col col--25p">
                                    <div class="form-group mg-0">
                                        <label>Cena</label>
                                        <div id="product-price" class="form-control color-green">33,00&nbsp;zł</div>
                                    </div>
                                </div>
                                <div class="col col--25p">
                                    <div id="add-product" class="btn btn--primary btn--fill-width">Dodaj</div>
                                </div>
                            </div>
                        </div>
                        <ul id="products-list" class="new-order__products"></ul>
                        <div class="new-order__summary">
                            <div id="total-price" class="total-price">
                                Łącznie: <span>0,00 zł</span>
                            </div>
                            <button class="btn btn--disabled text-24" type="submit">Dalej</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
