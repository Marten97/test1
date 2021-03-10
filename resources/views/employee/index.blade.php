@extends('layouts.dashboard')

@section('content')


<div class="container mt-4">
    <div class="mdl-card__title">
        <h1 class="mdl-card__title-text">Employee table</h1>
    </div>
    <div class="card">
        <div class="row card-body input-daterange">
            <div class="col-md-4">
                <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date"
                readonly />
            </div>
            <div class="col-md-4">
                <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date"
                readonly />
            </div>
            <div class="col-md-4">
                <button type="button" name="filter" id="filter" class="btn btn-primary">Filter</button>
                <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
            </div>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered" id="ajax-crud-datatable">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Created at</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody></tbody>
                <tfoot>
                    <tr>
                        <td>
                            <input type="text" class="form-control filter-input" placeholder="Search First Name" data-column="0"/>
                        </td>
                        <td>
                            <input type="text" class="form-control filter-input" placeholder="Search Last Name" data-column="1"/>
                        </td>
                        <td>
                            <input type="text" class="form-control filter-input" placeholder="Search Email" data-column="2"/>
                        </td>
                        <td>
                            <select data-column="3" class="form-control filter-select">
                                <option value="0">Search Company</option>
                                @foreach ($companies as $company)
                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                @endforeach
                            </select>
                        </td>
                        <td></td>
                    </tr>
                </tfoot>
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
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<link href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" rel="stylesheet">

<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
integrity="sha256-sPB0F50YUDK0otDnsfNHawYmA5M0pjjUf4TvRJkGFrI=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.js"
integrity="sha256-siqh9650JHbYFKyZeTEAhq+3jvkFCG8Iz+MHdr9eKrw=" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        load_data();

        //Iniliasi datepicker pada class input
        $('.input-daterange').datepicker({
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        $('#filter').click(function () {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if (from_date != '' && to_date != '') {
                $('#ajax-crud-datatable').DataTable().destroy();
                load_data(from_date, to_date);
            } else {
                alert('Both Date is required');
            }
        });

        $('#refresh').click(function () {
            $('#from_date').val('');
            $('#to_date').val('');
            $('#ajax-crud-datatable').DataTable().destroy();
            load_data();
        });

        function load_data(from_date = '', to_date = ''){
            var table = $('#ajax-crud-datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                        url: "{{ route('employee') }}",
                        type: 'GET',
                        data:{from_date:from_date, to_date:to_date}
                    },
                columns: [
                {
                    data: 'first_name',
                    name: 'first_name'
                },
                {
                    data: 'last_name',
                    name: 'last_name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'company',
                    name: 'company'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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

            $('.filter-input').keyup(function() {
                table.column( $ (this).data('column') )
                .search( $(this).val() )
                .draw();
            });

            $('.filter-select').change(function() {
                table.column( $ (this).data('column') )
                .search( $(this).val() )
                .draw();
            });
        }

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
