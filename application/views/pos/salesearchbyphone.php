<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-12 mb-4">
            <div class="card">
                <div class="card-body">

                    <table id="table" class="table">
                        <thead>
                            <tr>
                                <th> <?= display('receipt') ?></th>
                                <th><?= display('total') ?> </th>
                                <th><?= display('paid') ?></th>
                                <th><?= display('rest') ?></th>
                                <th><?= display('depositdate') ?></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                foreach($tickets as $sale){
                                    $rest = $sale->total - $sale->paid;
                                    ?>
                                    <tr>
                                        <th> <?= sprintf("%05d", $sale->id) ?></th>
                                        <th><?= number_format((float)$sale->total, settings()->decimals, '.', '') ?> <?= settings()->currency ?></th>
                                        <th><?= number_format((float)$sale->paid, settings()->decimals, '.', '') ?></th>
                                        <th><?= number_format((float)$rest, settings()->decimals, '.', '') ?></th>
                                        <th><?= $sale->created_at ?></th>
                                        <th><button type="button" class="btn btn-success" onclick="viewReciet(<?= $sale->id ?>)">View</button></th>
                                    </tr>
                                <?php
                                }
                                ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>