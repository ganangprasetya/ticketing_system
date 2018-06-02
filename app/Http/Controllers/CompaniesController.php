<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Alert;
use Library;
use Excel;
use App\Company;

class CompaniesController extends Controller
{
    const VIEW_PATH = "administration.companies";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginate_limit = env('PAGINATE_LIMIT', 10);

        // search roles
        $companies = Company::latest()->paginate($paginate_limit);
        if (count($request->query()) > 0) {
            $filter = $request->query('filter');
            $keyword = $request->query('keyword');

            switch ($filter) {
                case "name":
                    $companies = Company::where('name', 'like', '%' . $keyword . '%')->latest()->paginate($paginate_limit);
                    break;
                default:
                    $companies = Company::where('name', 'like', '%' . $keyword . '%')->latest()->paginate($paginate_limit);
            }
        }
        $offset = $companies->perPage() * ($companies->currentPage() - 1);

        return view(self::VIEW_PATH . '.index')->with(compact('companies', 'offset'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view(self::VIEW_PATH . '.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $company = Company::create([
            'name' => $request->name
        ]);
        alert()->success('Company ' . $request->name . ' has been added!', 'Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);

        return view(self::VIEW_PATH . '.edit')->with(compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ])->validate();
        $company->name = $request->name;
        $company->save();
        alert()->success('Table ' . $request->name . ' has been edited!', 'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::destroy($id);
        return redirect()->route('companies.index');
    }
}
