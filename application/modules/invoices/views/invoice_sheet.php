<div id="headerbar">
    <h1 class="headerbar-title">Invoice Sheet</h1>

    <div class="headerbar-item pull-right">
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('invoices/recurring/createinvoicesheet'); ?>">
            <i class="fa fa-plus"></i> <?php _trans('new'); ?>
        </a>
    </div>
</div>

<style>
    .table {
        margin: 0 0 0px;
    }
</style>

<div id="content" class="table-content">

    <div id="filter_results">
        <div class="table-responsive">
            <table class="table table-striped">

                <thead>
                    <tr>
                        <th>SI Number</th>
                        <th>Invoice Date</th>
                        <th>Room No</th>
                        <th>Tenant Name</th>
                        <th>Rant</th>
                        <th>Miscellaneous</th>
                        <th>Old Electricity Reading</th>
                        <th>New Electricity Reading</th>
                        <th>Total Electricity Reading</th>
                        <th>Electricity Bill</th>
                        <th>Remark</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if (!empty($invoice_sheets)): ?>
                        <?php $index = 1; ?>
                        <?php foreach ($invoice_sheets as $sheet): ?>
                            <tr>
                                <td><?= htmlspecialchars($index++) ?></td>
                                <td><?= htmlspecialchars(date('d-m-Y', strtotime($sheet->invoice_date))) ?></td>
                                <td><?= htmlspecialchars($sheet->room_no) ?></td>
                                <td><?= htmlspecialchars($sheet->client_name) ?></td>
                                <td><?= htmlspecialchars($sheet->rant) ?></td>
                                <td><?= htmlspecialchars($sheet->miscellaneous) ?></td>
                                <td><?= htmlspecialchars($sheet->old_electricity_reading) ?></td>
                                <td><?= htmlspecialchars($sheet->new_electricity_reading) ?></td>
                                <td><?= htmlspecialchars($sheet->total_electricity_reading) ?></td>
                                <td><?= htmlspecialchars($sheet->electricity_bill) ?></td>
                                <td><?= htmlspecialchars($sheet->remark) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="9">No invoice data found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>