<?php

namespace App\Http\Controllers\employee;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\User;
use App\Models\Store;
use App\Models\Employee_Type;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function employees()
    {
        $title = "Employee";

        $datauser = DB::table('employees')
            ->orderby('role', 'desc')->paginate(6);

        $getuser = DB::table('users')->get();
        $getstore = Store::all();
        $getrole = Role::all();

        return view('employee.employees', compact(
            'title',
            'datauser',
            'getuser',
            'getstore',
            'getrole'
        ));
    }

    public function load_editstore(Request $request)
    {
        if ($request->ajax()) {
            $datastore = Store::all();
            $id_store = $request->id_store;

            return view('employee/load_editstore', compact(
                'id_store',
                'datastore',
            ));
        }
    }

    public function load_selectrole(Request $request)
    {
        if ($request->ajax()) {
            $roledefault = $request->role;
            $getrole = Role::all('role');

            return view('employee/load_selectrole', compact(
                'roledefault',
                'getrole'
            ));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function cari(Request $request)
    {
        $title = "Employee";
        $cari = $request->cari;
        $getrole = Role::all();
        $getstore = Store::all();

        // mengambil data dari table pegawai sesuai pencarian data
        $datauser = DB::table('employees')
            ->where('name', 'like', "%" . $cari . "%")
            ->orwhere('role', 'like', "%" . $cari . "%")
            ->orwhere('username', 'like', "%" . $cari . "%")
            ->paginate(6);

        $getuser = DB::table('users')
            ->get();
        // mengirim data pegawai ke view index
        return view('employee.employees', compact(
            'title',
            'datauser',
            'getuser',
            'getrole',
            'getstore'
        ));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function main()
    {
        $getphoto = DB::table('employees')
            ->where('nik', '=', auth::user()->email)
            ->select('img')
            ->get();
        // mengirim data pegawai ke view index
        return view('layouts.main', compact(
            'getphoto'
        ));
    }

    /**
     * Store a newly created resource in storage.
     * @param  \App\Http\Requests\StoreEmployeeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $GETIDENTITY = $request->role;

        $adduser = new Employee;
        // end get days
        if (empty($_FILES['file']['name'][0])) {
            $adduser->img = null;
        } else {
            // get file
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);
            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('../../public_html/app/user'), $fileName);
            // end get files
            $adduser->img = $fileName;
        }

        $adduser->username = $request->username;
        $adduser->name = $request->names;
        $adduser->tlp = $request->tlp;
        $adduser->domisili = $request->domisili;
        $adduser->role = $GETIDENTITY;
        if ($GETIDENTITY === "SUPER-ADMIN") {
            $adduser->id_store = "SUPER-ADMIN";
        } else {
            $adduser->id_store = $request->id_store;
        }
        $adduser->save();

        return redirect('employee/employees');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function editact(Request $request, $id)
    {
        $GETIDENTITY = $request->e_role;
        $edit2 = Employee::find($id);

        // end get days
        if (empty($_FILES['file']['name'][0])) {
        } else {
            // get file
            $request->validate([
                'file' => 'required|file|mimes:jpg,jpeg,bmp,png,doc,docx,csv,rtf,xlsx,xls,txt,pdf,zip',
            ]);

            if ($edit2->img === "" or $edit2->img === "") {
            } else {
                $image = Employee::find($id);
                unlink("user/" . $image->img);
            }

            $fileName = time() . '.' . $request->file->extension();
            $request->file->move(public_path('../../public_html/app/user'), $fileName);
            // end get files
            $edit2->img = $fileName;
        }

        $edit2->username = $request->e_username;
        $edit2->name = $request->e_name;
        $edit2->tlp = $request->e_tlp;
        $edit2->domisili = $request->e_domisili;
        $edit2->role = $request->e_role;
        if ($request->e_role === "SUPER-ADMIN") {
            $edit2->id_store = "SUPER-ADMIN";
        } else {
            $edit2->id_store = $request->e_id_store;
        }
        $edit2->update();

        // dd($edit2);

        return redirect('employee/employees');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEmployeeRequest  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        DB::table('users')->where('email', $request->del_username)->delete();

        return redirect('employee/employees');
    }

    public function destroy_employee(Request $request, $id)
    {
        Employee::destroy($id);
        DB::table('users')->where('email', $request->delacc_username)->delete();

        return redirect('employee/employees');
    }
}
