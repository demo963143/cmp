<div id="headerbar">

    <style>
        .height {
            height: 40px;
        }
    </style>

    <h1 class="headerbar-title">Add Invoice Sheet</h1>

    <div class="headerbar-item pull-right">

    </div>
</div>

<div id="content" class="table-content">

    <div id="filter_results">
        <div class="table-responsive">

            <form action="<?php echo site_url('clients/Clients/addinvoicesheet'); ?>" method="post" enctype="multipart/form-data">

              <input type="hidden" name="_ip_csrf" value="<?= $this->security->get_csrf_hash() ?>">

                <table class="table table-bordered" id="rentTable">
                    <thead>
                        <tr>
                            <th>Room No</th>
                            <th>Tenant Name</th>
                            <th>Rent</th>
                            <th>Miscellaneous</th>
                            <th>Old Reading</th>
                            <th>New Reading</th>
                            <th>Total Reading</th>
                            <th>Electricity Bill</th>
                            <th>Remark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <div style="margin-bottom: 20px;">
                        <h6 class="mb-2" style="margin:2px;">Invoice Date</h6>
                        <div>
                            <input type="date" class="form-control invoice_date" name="invoice_date" id="invoice_date"
                                style="width:30%;">
                        </div>
                    </div>
                    <input type="hidden" name="settings_electrical_bill" id="settings_electrical_bill"
                        value="<?php echo get_setting('electrical_bill', '', true); ?>">
                    <tbody id="rentTableBody">
                        <tr>
                            <td>
                                <input type="text" class="form-control height room_id" name="room_no[]" placeholder="room no" id="room_id" readonly>
                            </td>

                            <td>
                               <input type="text" class="client_name form-control height" name="tenant_name[]" placeholder="enter Tenant Name" autocomplete="off">
                            </td>

                            <td>
                                <input type="text" class="form-control height" name="rant[]" placeholder="enter rent" required>
                            </td>

                            <td><input type="text" class="form-control height" name="miscellaneous[]"
                                    placeholder="enter miscellaneous" required></td>

                            <td><input type="text" class="form-control height old-reading update_old_electric"
                                    name="old_electricity_reading[]" placeholder="Old Reading" required></td>

                            <td><input type="text" class="form-control height new-reading"
                                    name="new_electricity_reading[]" placeholder="New Reading"></td>

                            <td><input type="text" class="form-control height total-reading"
                                    name="total_electricity_reading[]" placeholder="Total Reading" readonly></td>

                            <td><input type="text" class="form-control height bill" name="electricity_bill[]"
                                    placeholder="Electricity Bill" readonly></td>

                            <td><input type="text" class="form-control height" name="remark[]" placeholder="Remark">
                            </td>

                            <td style="display:none;"><input type="hidden" id="client_id" class="form-control client_id height" name="client_id[]"></td>

                            <td><button type="button" class="btn btn-sm btn-primary" id="addRowBtn"><i
                                        class="fa fa-plus"></i> Add Row</button></td>
                        </tr>
                    </tbody>
                </table>
                
                <div>
                    <button type="submit" class="btn btn-success save">Submit</button>
                </div>
            </form>

            <script>
                document.getElementById('addRowBtn').addEventListener('click', function () {
                    const tableBody = document.getElementById('rentTableBody');
                    const newRow = document.createElement('tr');
                    newRow.innerHTML = `
                        <td><input type="text" id="room_id" class="form-control room_id height" name="room_no[]" placeholder="room no" readonly></td>
                        <td><input type="text" class="client_name form-control height" name="tenant_name[]" placeholder="enter Tenant Name" autocomplete="off"></td>
                        <td><input type="text" class="form-control height" name="rant[]" placeholder="enter rent" required></td>
                        <td><input type="text" class="form-control height" name="miscellaneous[]" placeholder="enter miscellaneous" required></td>
                        <td><input type="text" class="form-control height old-reading update_old_electric" name="old_electricity_reading[]" placeholder="Old Reading" required></td>
                        <td><input type="text" class="form-control height new-reading" name="new_electricity_reading[]" placeholder="New Reading"></td>
                        <td><input type="text" class="form-control height total-reading" name="total_electricity_reading[]" placeholder="Total Reading" readonly></td>
                        <td><input type="text" class="form-control height bill" name="electricity_bill[]" placeholder="Electricity Bill" readonly></td>
                        <td><input type="text" class="form-control height" name="remark[]" placeholder="Remark"></td>
                        <td style="display:none;"><input type="hidden" id="client_id" class="form-control client_id height" name="client_id[]"></td>
                        <td><button type="button" class="btn btn-danger btn-sm removeRow"><i class="fa fa-minus"></i> Remove</button></td>
                    `;
                    tableBody.appendChild(newRow);
                });

                document.getElementById('rentTableBody').addEventListener('click', function (e) {
                    if (e.target.classList.contains('removeRow')) {
                        e.target.closest('tr').remove();
                    }
                });

                $(document).on('keyup', '.new-reading', function () {
                    const row = $(this).closest('tr');
                    const oldReading = parseFloat(row.find('.old-reading').val()) || 0;
                    const newReading = parseFloat(row.find('.new-reading').val()) || 0;
                    const rate = parseFloat($('#settings_electrical_bill').val()) || 0;
                    const totalUsed = newReading - oldReading;
                    const totalBill = totalUsed * rate;
                    row.find('.total-reading').val(totalUsed);
                    row.find('.bill').val(totalBill.toFixed(2));
                });

                $(document).on('keyup keydown', '.client_name', function (event) {
                    let clientName = $(this).val();
                    let inputField = $(this);
                    let suggestionsList = inputField.siblings('.suggestions-list');
                    let selectedIndex = -1;
                    if (clientName.length === 0) {
                        suggestionsList.remove();
                        return;
                    }
                    if (clientName.length === 2) {
                        let base_url = "<?php echo site_url('clients/ajax/clientname_query'); ?>";
                        $.ajax({
                            url: base_url,
                            type: 'GET',
                            data: { query: clientName },
                            dataType: 'json',
                            success: function (response) {
                                console.log('Server response:', response);
                                suggestionsList.remove();
                                if (response.length > 0) {
                                    let suggestions = $('<ul class="suggestions-list" style="list-style-type:none; padding: 0; height: 188px; overflow: scroll; margin: 0; position: absolute; background: white; border: 1px solid #ccc; width: 8%; z-index: 9999;"></ul>');
                                    response.forEach(function (client, index) {
                                        let suggestionItem = $('<li class="suggestion-item" style="padding: 5px; cursor: pointer;">' + client.text + '</li>');
                                        suggestions.append(suggestionItem);
                                        suggestionItem.on('click', function () {
                                            inputField.val(client.text);
                                            suggestions.remove();

                                            let row = inputField.closest('tr');
                                            let roomInput = row.find('.room_id');
                                            // console.log("Setting room no to:", client.room_id);
                                            // console.log("Target input:", roomInput[0].outerHTML);
                                            if (client.room_id) {
                                                roomInput.val(client.room_id);  
                                            } else {
                                                roomInput.val('');
                                            }

                                            let clientInput = row.find('.client_id');
                                            if (client.id) {
                                                clientInput.val(client.id);  
                                            } else {
                                                clientInput.val('');
                                            }

                                            
                                            let elecInput = row.find('.update_old_electric');
                                            if (client.id) {
                                                elecInput.val(client.electricity_reading);  
                                            } else {
                                                elecInput.val('');
                                            }

                                        });
                                        suggestionItem.on('mouseenter', function () {
                                            suggestionItem.css('background-color', '#f0f0f0');
                                        }).on('mouseleave', function () {
                                            suggestionItem.css('background-color', '');
                                        });
                                    });
                                    inputField.after(suggestions);
                                }
                            },
                            error: function (xhr, status, error) {
                                console.error('AJAX Error:', error);
                            }
                        });
                    }
                });

                $(document).on('keydown', '.client_name', function (event) {
                    let inputField = $(this);
                    let suggestions = inputField.siblings('.suggestions-list');
                    let selectedIndex = suggestions.find('.selected').index();
                    if (suggestions.length === 0) return;
                    if (event.key === 'ArrowDown' && selectedIndex < suggestions.children().length - 1) {
                        selectedIndex++;
                    } else if (event.key === 'ArrowUp' && selectedIndex > 0) {
                        selectedIndex--;
                    } else if (event.key === 'Enter' && selectedIndex !== -1) {
                        let selectedItem = suggestions.children().eq(selectedIndex);
                        inputField.val(selectedItem.text());
                        suggestions.remove();
                        return;
                    }
                    suggestions.children().each(function (index) {
                        $(this).removeClass('selected');
                        if (index === selectedIndex) {
                            $(this).addClass('selected').css('background-color', '#e0e0e0');
                        }
                    });
                });

                $(document).on('click', function (event) {
                    if (!$(event.target).closest('.client_name').length) {
                        $('.suggestions-list').remove();
                    }
                });

            </script>

        </div>
    </div>

</div>