@extends('layouts.dashboard')

@section('content')


    <div class="container mt-4">
        <div class="mdl-card__title">
            <h1 class="mdl-card__title-text">Employee table</h1>
        </div>
        <div class="card">
            <div class="card-body table-responsive">
                <table class="table table-bordered" id="ajax-crud-datatable">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
                <form method="get" action="{{ route('home') }}">
                    <a class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-teal"
                        onClick="add()" href="javascript:void(0)">
                        <i class="material-icons">create</i>Add</a>
                    <button type="submit"
                        class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-red">
                        <i class="material-icons">exit_to_app</i>Back</button>
                </form>
            </div>
        </div>
    </div>

@endsection
<!-- boostrap employee model -->
@section('modal')


    <div class="modal fade" id="employee-modal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="EmployeeModal"></h4>
                </div>
                <div class="modal-body">
                    <form action="javascript:void(0)" id="EmployeeForm" name="EmployeeForm" class="form-horizontal"
                        method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label required">First Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    placeholder="First Name" maxlength="50" required="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label required">Last Name</label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" id="last_name" name="last_name"
                                    placeholder="Last Name" maxlength="50" required="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label required">Company</label>
                            <div class="col-sm-12">
                                <select name="company" id="company" class="form-control">
                                    <option value="0">--Select Company--</option>
                                    @foreach ($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Email</label>
                            <div class="col-sm-12">
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Email" maxlength="50" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Phone</label>
                            <div class="col-sm-12">
                                <input type="number" class="form-control" id="phone" name="phone"
                                    placeholder="Phone" >
                            </div>
                        </div>
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" id="btn-save">Save changes
                            </button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection


@section('script')

    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#ajax-crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'full_name',
                        searchable: false

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
        });

        function add() {
            $('#EmployeeForm').trigger("reset");
            $('#EmployeeModal').html("Add Employee");
            $('#employee-modal').modal('show');
            $('#id').val('');
        }

        function editFunc(id) {
            $.ajax({
                type: "POST",
                url: "{{ url('update-employee') }}",
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(res) {
                    $('#EmployeeModal').html("Edit Employee");
                    $('#employee-modal').modal('show');
                    $('#id').val(res.id);
                    $('#first_name').val(res.first_name);
                    $('#last_name').val(res.last_name);
                    $('#company').val(res.company);
                    $('#phone').val(res.phone);
                    $('#email').val(res.email);
                }
            });
        }

        function deleteFunc(id) {
            if (confirm("Delete Record?") == true) {
                var id = id;
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ url('delete-employee') }}",
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#ajax-crud-datatable').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        }
        $('#EmployeeForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: "POST",
                url: "{{ url('store-employee') }}",
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: (data) => {
                    $("#employee-modal").modal('hide');
                    var oTable = $('#ajax-crud-datatable').dataTable();
                    oTable.fnDraw(false);
                    $("#btn-save").html('Submit');
                    $("#btn-save").attr("disabled", false);
                },
                error: function(data) {
                    console.log(data);
                }
            });
        });

    </script>
@endsection
