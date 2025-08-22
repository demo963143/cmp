  
                      <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>
                                        <?php _trans('service_name'); ?>
                                    </th>
                                    <th>
                                        <?php _trans('price'); ?>
                                    </th>
                                     <th>
                                        <?php _trans('date'); ?>
                                    </th>
                                </tr>
                            </thead>
                            
                            <tbody>
                               
                                <?php foreach ($invoices as $inv) : ?>
                                <tr>
                                    <td><?php _htmlsc($inv->item_name); ?></td>
                                    <td><?php _htmlsc($inv->item_price*$inv->item_quantity*(100+$inv->tax_rate_percent)/100); ?></td>
                                    <td><?php _htmlsc(date("d-m-Y", strtotime($inv->item_date_added))); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                  