<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index () {
        $data = Siswa::all();
        return view('admin.mastersiswa', compact('data'));
    }

    public function create(){
        return view('admin.tambahsiswa');
    }

    public function store(Request $request){
        // dd($request);
        $message = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
            'mimes' => 'file :attribute harus bertipe jpg,jpeg,png'
        ];

        $this->validate($request, [
            'name' => 'required|min:3|max:40',
            'about' => 'required|min:50',
            'photo' => 'required|mimes: jpg,jpeg,png',
        ], $message);
        //ambil info gambar
        $file = $request->file('photo');

        //ambil nama gamvar
        $nama_file = time(). '-' .$file->getClientOriginalName();

        //proses upload
        $file->storeAs('public/gambar', $nama_file);
        // $file->move('./storage', $nama_file);

        Siswa::create([
            'name' => $request->name,
            'about' => $request->about,
            'photo' => $nama_file,
        ]);
        return redirect()->route('siswa.index')->with('message', 'Data siswa berhasil ditambahkan');
        
    }

    public function edit($id){
        $siswa = Siswa::find($id);
        return view('admin.editsiswa', compact('siswa'));
    }

    public function update(Request $request, $id){
        $siswa = Siswa::find($id);

        $message = [
            'required' => ':attribute harus diisi',
            'min' => ':attribute minimal :min karakter',
            'mimes' => 'file :attribute harus bertipe jpg,jpeg,png'
        ];

        $this->validate($request, [
            'name' => 'required|min:3|max:40',
            'about' => 'required|min:50',
            'photo' => 'nullable|mimes:png,jpg,jpeg',
        ], $message);
        
        if($request->file('photo') == "") {
    
            $siswa->update([
                'name' => $request->name,
                'about' => $request->about,
            ]);
    
        } else {
    
            //hapus old image
            Storage::disk('local')->delete('public/gambar/'.$siswa->photo);
    
            //ambil info gambar
            $file = $request->file('photo');

            //ambil nama gambar
            $nama_file = time(). '-' .$file->getClientOriginalName();

            //proses upload
            $file->storeAs('public/gambar', $nama_file);
            // $file->move('./storage', $nama_file);
    
            $siswa->update([
                'name' => $request->name,
                'about' => $request->about,
                'photo' => $nama_file,
            ]);
    
        }
    
        return redirect()->route('siswa.index'); 
    }

    public function delete($id){
        $data = Siswa::find($id);
        Storage::disk('local')->delete('public/gambar/'.$data->photo);
        // $ekskul->delete();
        // Storage::delete('./storage', $data->photo);
        $data->delete();
        return redirect()->route('siswa.index')->with('message', 'Data siswa berhasil dihapus');
    }
}
