<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:admin'])->except(['index', 'show']);   
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswas = Siswa::all('id', 'name');
        return view('admin.masterproject', compact('siswas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tambahproject');
    }

    public function add($id){
        $siswa = Siswa::find($id);

        return view('admin.tambahproject', compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $message = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
            'mimes' => 'file :attribute harus bertipe jpg,jpeg,png'
        ];

        $this->validate($request, [
            'project_name' => 'required|min:5|max:20',
            'project_date' => 'required',
            'photo' => 'required|mimes: jpg,jpeg,png',
        ], $message);

        //ambil info gambar
        $file = $request->file('photo');

        //ambil nama gamvar
        $nama_file = time(). '-' .$file->getClientOriginalName();

        //proses upload
        $file->storeAs('public/project', $nama_file);
        // $file->move('./storage', $nama_file);

        Project::create([
            'siswa_id' => $request->siswa_id, 
            'project_name' => $request->project_name,
            'project_date' => $request->project_date,
            'photo' => $nama_file,
        ]);

        return redirect()->route('project.index')->with('message', 'Data siswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Siswa::find($id)->project()->get();
        return view('admin.showproject', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = Project::find($id);
        return view('admin.editproject', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::find($id);

        $message = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
            'mimes' => 'file :attribute harus bertipe jpg,jpeg,png'
        ];

        $this->validate($request, [
            'project_name' => 'required|min:5|max:20',
            'project_date' => 'required',
            'photo' => 'nullable|mimes: jpg,jpeg,png',
        ], $message);
        
        if($request->file('photo') == "") {
    
            $project->update([
                'project_name' => $request->project_name,
                'project_date' => $request->project_date,
            ]);
    
        } else {
    
            //hapus old image
            Storage::disk('local')->delete('public/project/'.$project->photo);
    
            //ambil info gambar
            $file = $request->file('photo');

            //ambil nama gambar
            $nama_file = time(). '-' .$file->getClientOriginalName();

            //proses upload
            $file->storeAs('public/project', $nama_file);
            // $file->move('./storage', $nama_file);
    
            $project->update([
                'project_name' => $request->project_name,
                'project_date' => $request->project_date,
                'photo' => $nama_file,
            ]);
    
        }
    
        return redirect()->route('project.index')->with('message', 'Data siswa berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Project::find($id);
        Storage::disk('local')->delete('public/project/'.$data->photo);
        // $ekskul->delete();
        // Storage::delete('./storage', $data->photo);
        $data->delete();
        return redirect()->route('project.index')->with('message', 'Data siswa berhasil dihapus');
    }
}
