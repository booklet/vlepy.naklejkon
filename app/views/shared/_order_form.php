<form id="new-order" class="form" action="<?= Routing::path('order_new') ?>" method="POST">
    <div class="container container--720">
        <h3 class="title title--underscore">Zamów vlepki</h3>
        <?php Alerts::display(); ?>
        <div class="new-order__available-sizes">

            <table class="" width="">
                <tr>
                    <td>50x50 mm <span>(33,00 zł)</span></td>
                    <td>70x50 mm <span>(38,00 zł)</span></td>
                </tr>
                <tr>
                    <td>70x70 mm <span>(45,00 zł)</span></td>
                    <td>70x100 mm <span>(56,00 zł)</span></td>
                </tr>
                <tr>
                    <td>100x100 mm <span>(76,00 zł)</span></td>
                    <td>70x150 mm <span>(76,00 zł)</span></td>
                </tr>
                <tr>
                    <td>120x120 mm <span>(138,00 zł)</span></td>
                    <td>70x200 mm <span>(107,00 zł)</span></td>
                </tr>
                <tr>
                    <td>150x150 mm <span>(138,00 zł)</span></td>
                    <td>100x150 mm <span>(97,00 zł)</span></td>
                </tr>
                <tr>
                    <td>50x100 mm <span>(45,00 zł)</span></td>
                    <td>100x200 mm <span>(138,00 zł)</span></td>
                </tr>
                <tr>
                    <td>50x150 mm <span>(62,00 zł)</span></td>
                    <td>A6 (105x148 mm) <span>(107,00 zł)</span></td>
                </tr>
                <tr>
                    <td>50x200 mm <span>(88,00 zł)</span></td>
                    <td>A5 (148x210 mm) <span>(199,00 zł)</span></td>
                </tr>
            </table>
        </div>
        <div class="new-order__add-product">
            <div class="flexbox flexbox--grid flexbox--justify-center flexbox--align-center">
                <div class="col col--25p">
                    <div class="form-group mg-none">
                        <label>Wymiar</label>
                        <select id="product-dimensions" class="form-control">
                            <option value="50x50 mm" data-price="33.00" selected>50x50 mm</option>
                            <option value="70x70 mm" data-price="45.00">70x70 mm</option>
                            <option value="100x100 mm" data-price="76.00">100x100 mm</option>
                            <option value="120x120 mm" data-price="138.00">120x120 mm</option>
                            <option value="150x150 mm" data-price="138.00">150x150 mm</option>
                            <option value="50x100 mm" data-price="45.00">50x100 mm</option>
                            <option value="50x150 mm" data-price="62.00">50x150 mm</option>
                            <option value="50x200 mm" data-price="88.00">50x200 mm</option>
                            <option value="70x50 mm" data-price="38.00">70x50 mm</option>
                            <option value="70x100 mm" data-price="56.00">70x100 mm</option>
                            <option value="70x150 mm" data-price="76.00">70x150 mm</option>
                            <option value="70x200 mm" data-price="107.00">70x200 mm</option>
                            <option value="100x150 mm" data-price="97.00">100x150 mm</option>
                            <option value="100x200 mm" data-price="138.00">100x200 mm</option>
                            <option value="A6 (105x148 mm)" data-price="107.00">A6 (105x148 mm)</option>
                            <option value="A5 (148x210 mm)" data-price="199.00">A5 (148x210 mm)</option>
                        </select>
                    </div>
                </div>
                <div class="col col--25p">
                    <div class="form-group mg-none">
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
                    <div class="form-group mg-none">
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
            <button class="btn btn--disabled" type="submit">Dalej</button>
        </div>
    </div>
</form>
