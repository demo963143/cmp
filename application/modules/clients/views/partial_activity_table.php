      
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
                                        Creation <?php _trans('date'); ?>
                                    </th>
                                     <th>
                                        Reminder
                                    </th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                <?php foreach ($activities as $act) : ?>
                                <tr>
                                    <td><?php _htmlsc($act->service_name); ?></td>
                                    <td><?php _htmlsc($act->amount); ?></td>
                                    <td><?php _htmlsc(date("d-m-Y", strtotime($act->act_created_at))); ?></td>
                                    <td><?php _htmlsc($act->reminder); ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                 