    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>New Prescription</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Default box -->
            <div class="card card-outline card-primary rounded-0 shadow">
                <div class="card-header">
                    <h3 class="card-title">Add New Prescription</h3>

                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                <!-- best practices-->
                    <form method="post">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                                <label>Select Patient</label>
                                <select id="patient" name="patient" class="form-control form-control-sm rounded-0" required="required">
                                    <?php echo $patients;?>
                                </select>
                            </div>

                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-10">
                                <div class="form-group">
                                    <label>Visit Date</label>
                                    <div class="input-group date" id="visit_date" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-sm rounded-0 datetimepicker-input" data-target="#visit_date" name="visit_date" required="required" data-toggle="datetimepicker" autocomplete="off"/>
                                        <div class="input-group-append" data-target="#visit_date" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
          
                            <div class="col-lg-3 col-md-3 col-sm-4 col-xs-10">
                                <div class="form-group">
                                    <label>Next Visit Date</label>
                                        <div class="input-group date" id="next_visit_date" data-target-input="nearest">
                                            <input type="text" class="form-control form-control-sm rounded-0 datetimepicker-input" data-target="#next_visit_date" name="next_visit_date" data-toggle="datetimepicker" autocomplete="off"/>
                                            <div class="input-group-append" data-target="#next_visit_date" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix">&nbsp;</div>

                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <label>BP</label>
                                <input id="bp" class="form-control form-control-sm rounded-0" name="bp" required="required" />
                            </div>
    
                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <label>Weight</label>
                                <input id="weight" name="weight" class="form-control form-control-sm rounded-0" required="required" />
                            </div>

                            <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
                                <label>Disease</label>
                                <input id="disease" required="required" name="disease" class="form-control form-control-sm rounded-0" />
                            </div>

                        </div>

                        <div class="col-md-12"><hr /></div>
                        <div class="clearfix">&nbsp;</div>

                        <div class="row">
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                                <label>Description</label>
                                <input id="description" class="form-control form-control-sm rounded-0">
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <label>Quantité</label>
                                <input id="quantity" class="form-control form-control-sm rounded-0">
                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                                <label>Prix Unitaire</label>
                                <input id="pu" class="form-control form-control-sm rounded-0" />
                            </div>

                            <div class="col-lg-1 col-md-1 col-sm-6 col-xs-12">
                                <label>&nbsp;</label>
                                <button id="add_to_list" type="button" class="btn btn-primary btn-sm btn-flat btn-block">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="clearfix">&nbsp;</div>

                        <div class="row table-responsive">
                            <table id="facture_list" class="table table-striped table-bordered">
                                <colgroup>
                                    <col width="5%">
                                    <col width="50%">
                                    <col width="10%">
                                    <col width="15%">
                                    <col width="15%">
                                    <col width="5%">
                                </colgroup>
                                <thead class="bg-primary">
                                    <tr>
                                    <th>Ref</th>
                                    <th>Description</th>
                                    <th>Quantité</th>
                                    <th>P.U</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="current_factures_list"></tbody>
                            </table>
                        </div>

                        <div class="clearfix">&nbsp;</div>

                        <div class="row">
                            <div class="col-md-10">&nbsp;</div>
                            <div class="col-md-2">
                                <button type="submit" id="submit" name="submit" class="btn btn-primary btn-sm btn-flat btn-block">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>

<script>
    $(document).ready(function() {
        $('#facture_list').find('td').addClass("px-2 py-1 align-middle")
        $('#facture_list').find('th').addClass("p-1 align-middle")
        $('#visit_date, #next_visit_date').datetimepicker({
            format: 'L'
        });
    
        $("#add_to_list").click(function() {
            var description = $("#description").val().trim();
            var quantity = $("#quantity").val().trim();
            var pu = $("#pu").val().trim();

            var oldData = $("#current_factures_list").html();

            if(description !== '' && quantity !== '' && pu !== '') {
            var inputs = '';
            inputs = inputs + '<input type="hidden" name="descriptions[]" value="'+description+'">';
            inputs = inputs + '<input type="hidden" name="quantities[]" value="'+quantity+'">';
            inputs = inputs + '<input type="hidden" name="pus[]" value="'+pu+'">';


            var tr = '<tr>';
            tr = tr + '<td class="px-2 py-1 align-middle">'+serial+'</td>';
            tr = tr + '<td class="px-2 py-1 align-middle">'+description+'</td>';
            tr = tr + '<td class="px-2 py-1 align-middle">'+quantity+'</td>';
            tr = tr + '<td class="px-2 py-1 align-middle">'+pu + inputs +'</td>';

            tr = tr + '<td class="px-2 py-1 align-middle text-center"><button type="button" class="btn btn-outline-danger btn-sm rounded-0" onclick="deleteCurrentRow(this);"><i class="fa fa-times"></i></button></td>';
            tr = tr + '</tr>';
            oldData = oldData + tr;
            serial++;

            $("#current_factures_list").html(oldData);

            $("#medicine").val('');
            $("#packing").val('');
            $("#quantity").val('');
            $("#pu").val('');

            } else {
            showCustomMessage('Please fill all fields.');
            }

        });

    });

    function deleteCurrentRow(obj) {
        var rowIndex = obj.parentNode.parentNode.rowIndex;
      
        document.getElementById("facture_list").deleteRow(rowIndex);
    }
</script>