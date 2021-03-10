<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Datatables;
use Illuminate\Http\Request;

class CompanyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $companies = Company::all();
        if (request()->ajax()) {
            return datatables()->of($companies)
                ->addColumn('action', 'company.action')
                ->addColumn('logo', function ($companies) {
                    $url = "storage/images/$companies->logo";
                    return $url;
                })
                ->rawColumns(['action', 'company.image'])
                ->addIndexColumn()
                ->make(true);
        }
        return view('company.index');
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'name'      =>  'required',
        ]);

        $companyId = $request->id;

        if ($companyId) {

            $company = Company::find($companyId);

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');
                $path = $logo->store('public/images');
                $logoName = $logo->hashName();
                $company->logo = $logoName;
            }
        } else {
            $path = $request->file('logo')->store('public/images');
            $company = new Company;
            $company->logo = $path;
        }

        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->save();

        return Response()->json($company);

    }

    public function update(Request $request)
    {
        $where = array('id' => $request->id);
        $company = Company::where($where)->first();

        return Response()->json($company);
    }

    public function destroy(Request $request)
    {
        $company = Company::where('id', $request->id)->delete();

        return Response()->json($company);
    }
}
