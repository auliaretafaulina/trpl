<?php
 
namespace App\Http\Controllers;
use App\Pembayaran;
use Illuminate\Http\Request;
 
class PembayaranController extends Controller
{
/**
* Display a listing of the resource.
*
* @return \Illuminate\Http\Response
*/
public function index()
{
$data = Pembayaran::latest()->paginate(5);
return view('index', compact('data'))
->with('i', (request()->input('page', 1) - 1) * 5);
}
 
/**
* Show the form for creating a new resource.
*
* @return \Illuminate\Http\Response
*/
public function create()
{
return view('create');
}
 
/**
* Store a newly created resource in storage.
*
* @param \Illuminate\Http\Request $request
* @return \Illuminate\Http\Response
*/
public function store(Request $request)
{
$request->validate([
'id_pembayaran' => 'required',
'nama' => 'required',
'tanggal_bayar' => 'required',
'jumlah_bayar' => 'required',
'nama_pengirim' => 'required',
'image' => 'required|image|max:2048'
]);
 
$image = $request->file('image');
 
$new_name = rand() . '.' . $image->getClientOriginalExtension();
$image->move(public_path('images'), $new_name);
$form_data = array(
'id_pembayaran' => $request->nama_siswa,
'nama' => $request->id_reg,
'tanggal_bayar' => $request->tgl_kirim,
'jumlah_bayar' => $request->nm_pengirim,
'nama_pengirim' => $request->bank_tujuan,
'image' => $new_name
);
 
Pembayaran::create($form_data);
 
return redirect('konfirmasi_pembayaran')->with('success', 'Data Added successfully.');
}
 
/**
* Display the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function show($id)
{
$data = Pembayaran::findOrFail($id);
return view('view', compact('data'));
}
 
/**
* Show the form for editing the specified resource.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function edit($id)
{
$data = Pembayaran::findOrFail($id);
return view('edit', compact('data'));
}
 
/**
* Update the specified resource in storage.
*
* @param \Illuminate\Http\Request $request
* @param int $id
* @return \Illuminate\Http\Response
*/
public function update(Request $request, $id)
{
$image_name = $request->hidden_image;
$image = $request->file('image');
if($image != '')
{
$request->validate([
    'id_pembayaran' => 'required',
    'nama' => 'required',
    'tanggal_bayar' => 'required',
    'jumlah_bayar' => 'required',
    'nama_pengirim' => 'required',
    'image' => 'required|image|max:2048'
]);
 
$image_name = rand() . '.' . $image->getClientOriginalExtension();
$image->move(public_path('images'), $image_name);
}
else
{
$request->validate([
    'id_pembayaran' => 'required',
    'nama' => 'required',
    'tanggal_bayar' => 'required',
    'jumlah_bayar' => 'required',
    'nama_pengirim' => 'required',
    'image' => 'required|image|max:2048'
]);
}
 
$form_data = array(
    'id_pembayaran' => $request->nama_siswa,
    'nama' => $request->id_reg,
    'tanggal_bayar' => $request->tgl_kirim,
    'jumlah_bayar' => $request->nm_pengirim,
    'nama_pengirim' => $request->bank_tujuan,
    'image' => $new_name
);
 
Pembayaran::whereId($id)->update($form_data);
 
return redirect('konfirmasi_pembayaran')->with('success', 'Data is successfully updated');
}
 
/**
* Remove the specified resource from storage.
*
* @param int $id
* @return \Illuminate\Http\Response
*/
public function destroy($id)
{
$data = Pembayaran::findOrFail($id);
$data->delete();
 
return redirect('konfirmasi_pembayaran')->with('success', 'Data is successfully deleted');
}
}