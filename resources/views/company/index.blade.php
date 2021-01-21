<!DOCTYPE html>
<html>
@include('layouts.yajra')
<body>

    <div class="container mt-4">
        
        <div class="col-md-6 mt-1 mb-2">
            <h2>Company</h2>

        </div>

        <div class="card">

            <div class="card-body">

                <table class="table table-bordered" id="datatable-ajax-crud">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
                <form method="get" action="{{route('home')}}">
                    <button type="button" id="addNewCompany" class="btn btn-success">Add</button>
                    <button type="submit" class="btn btn-warning">Back</button>
                </form>

            </div>

        </div>

        <div class="modal fade" id="ajax-company-model" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="ajaxCompanyModel"></h4>
                    </div>
                    <div class="modal-body">
                        <form action="javascript:void(0)" id="addEditCompanyForm" name="addEditCompanyForm"
                            class="form-horizontal" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Company Name</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter Company Name" maxlength="50" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Company Email</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="email" name="email"
                                        placeholder="Enter Email" maxlength="50" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Website</label>
                                <div class="col-sm-12">
                                    <input type="text" class="form-control" id="website" name="website"
                                        placeholder="Enter website link" required="">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">Company Logo</label>
                                <div class="col-sm-6 pull-left">
                                    <input type="file" class="form-control" id="logo" name="logo" required="">
                                </div>
                                <div class="col-sm-6 pull-right">
                                    <img id="preview-logo"
                                        src="https://www.riobeauty.co.uk/images/product_logo_not_found.gif"
                                        alt="preview logo" style="max-height: 250px;">
                                </div>
                            </div>

                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="btn-save" value="addNewCompany">Save
                                    changes
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript">
            $(document).ready(function() {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $('#logo').change(function() {

                    let reader = new FileReader();

                    reader.onload = (e) => {

                        $('#preview-logo').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(this.files[0]);

                });

                $('#datatable-ajax-crud').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "",
                    columns: [{
                            data: 'id',
                            name: 'id',
                            'visible': true
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false
                        },
                    ],
                    order: [
                        [0, 'desc']
                    ]
                });


                $('#addNewCompany').click(function() {
                    $('#addEditCompanyForm').trigger("reset");
                    $('#ajaxCompanyModel').html("Add Company");
                    $('#ajax-company-model').modal('show');
                    $("#logo").attr("required", "true");
                    $('#id').val('');
                    $('#preview-logo').attr('src',
                        'https://www.riobeauty.co.uk/images/product_logo_not_found.gif');


                });

                $('body').on('click', '.edit', function() {

                    var id = $(this).data('id');

                    // ajax
                    $.ajax({
                        type: "POST",
                        url: "{{ route('company.update') }}",
                        data: {
                            id: id
                        },
                        dataType: 'json',
                        success: function(res) {
                            $('#ajaxCompanyModel').html("Edit Company");
                            $('#ajax-company-model').modal('show');
                            $('#id').val(res.id);
                            $('#name').val(res.name);
                            $('#email').val(res.email);
                            $('#website').val(res.website);
                            $('#logo').removeAttr('required');

                        }
                    });

                });

                $('body').on('click', '.delete', function() {

                    if (confirm("Delete Record?") == true) {
                        var id = $(this).data('id');

                        // ajax
                        $.ajax({
                            type: "POST",
                            url: "{{ route('company.destroy') }}",
                            data: {
                                id: id
                            },
                            dataType: 'json',
                            success: function(res) {

                                var oTable = $('#datatable-ajax-crud').dataTable();
                                oTable.fnDraw(false);
                            }
                        });
                    }

                });

                $('#addEditCompanyForm').submit(function(e) {

                    e.preventDefault();

                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: "{{ route('company.store') }}",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: (data) => {
                            $("#ajax-company-model").modal('hide');
                            var oTable = $('#datatable-ajax-crud').dataTable();
                            oTable.fnDraw(false);
                            $("#btn-save").html('Submit');
                            $("#btn-save").attr("disabled", false);
                        },
                        error: function(data) {
                            console.log(data);
                        }
                    });
                });
            });

        </script>
    </div>
</body>

</html>
