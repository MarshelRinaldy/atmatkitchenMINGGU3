<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class TransaksiController extends Controller
{

    public function show_pengiriman(){
        $transaksis = Transaksi::with('user')
        ->where('status_transaksi', 'menunggu konfirmasi ongkir')
        ->get();

        // dd($transaksis);

    return view('admin.inputJarakPengiriman', compact('transaksis'));
    }

    public function update_pengiriman($id)
    {
      
        $transaksi = Transaksi::with('user')->findOrFail($id);

      
        return view('admin.updatePengiriman', compact('transaksi'));
    }

    public function input_pengiriman(Request $request, $id, $total_harga)
    {
       
        $transaksi = Transaksi::find($id);

        if (!$transaksi) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $jarak = $request->input('jarak'); 
        $biaya_ongkir = 0;

        if ($jarak <= 5) {
            $biaya_ongkir = 10000;
        } elseif ($jarak <= 10) {
            $biaya_ongkir = 15000;
        } elseif ($jarak <= 15) {
            $biaya_ongkir = 20000;
        } else {
            $biaya_ongkir = 25000;
        }

       
        $transaksi->jarak_delivery = $jarak;
        $transaksi->biaya_ongkir = $biaya_ongkir;
        $transaksi->total_harga = $total_harga + $biaya_ongkir;
        $transaksi->status_transaksi = "menunggu pembayaran";

        $transaksi->save(); 

        return redirect()->route('show_pengiriman')->with('success', 'Transaksi berhasil dikonfirmasi dan akan menunggu pembayaran');
    }

    public function show_konfirmasi_pesanan(){
        $transaksis = Transaksi::with('user')
        ->where('status_transaksi', 'menunggu konfirmasi')
        ->get();

        return view('admin.konfirmasiPesanan', compact('transaksis'));
    }

    public function detail_konfirmasi_pesanan($id)
    {
        $transaksi = Transaksi::with('user')->findOrFail($id);
        return view('admin.detailKonfirmasiPesanan', compact('transaksi'));
    }

    public function show_pesanan_diproses(){
         $transaksis = Transaksi::where('status_transaksi', 'sedang dikemas')->get();
    return view('admin.showPesananDiproses', compact('transaksis'));
    }

    public function show_pesanan_telat_bayar(){
    
    $now = Carbon::now();
    
    $transaksis = Transaksi::where('status_transaksi', 'menunggu pembayaran')
                            ->where('created_at', '<', $now->subDay())
                            ->get();

    return view('admin.showPesananTelatPembayaran', compact('transaksis'));
}

    public function batalkan_pesanan_telat_bayar($id) {
   
    $transaksi = Transaksi::findOrFail($id);

    
    $detailTransaksis = $transaksi->detailTransaksis;

    
    foreach ($detailTransaksis as $detail) {
        if ($detail->produk && !$detail->is_hampers) {
           
            $produk = $detail->produk;
            $produk->stok += $detail->jumlah_produk;
            $produk->save();
        } elseif ($detail->hampers) {
          
            $hampers = $detail->hampers;
            $hampers->stok += $detail->jumlah_produk;
            $hampers->save();
        }
    }

   
    $transaksi->status_transaksi = 'Dibatalkan';
    $transaksi->save();

    return redirect()->route('show_pesanan_telat_bayar')->with('success', 'Berhasil Membatalkan Transaksi Tersebut');
}


    public function pesanan_siap_dikirim_dipickup($id)
    {
        
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->status_transaksi = 'sudah dikonfirmasi';
        $transaksi->save();

       
        return redirect()->route('show_pesanan_diproses');
    }

    
}