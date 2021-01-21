<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Company;
use Datatables;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(Employee::select('*'))
                ->addColumn('name', function ($inspection) {
                    return $inspection->full_name;
                })
                ->addColumn('action', 'employee.action')
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);

        }

        $companies = Company::latest()->get();
        return view('employee.index',[
            'companies' => $companies,
        ]);
    }

    public function store(Request $request)
    {

        $employeeId = $request->id;

        $employee = Employee::updateOrCreate(
            [
                'id' => $employeeId,
            ],
            [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company' => $request->company,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

        return Response()->json($employee);

    }

    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $employee = Employee::where($where)->first();

        return Response()->json($employee);
    }

    public function destroy(Request $request)
    {
        $employee = Employee::where('id', $request->id)->delete();

        return Response()->json($employee);
    }
}
