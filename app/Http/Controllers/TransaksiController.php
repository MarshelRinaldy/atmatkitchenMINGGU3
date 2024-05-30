<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Hampers;
use App\Models\BahanBaku;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\BahanBakuUsage;
use App\Http\Controllers\Controller;

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
    // Find the transaction
    $transaksi = Transaksi::with('detailTransaksis.produk.resep', 'detailTransaksis.hampers.details.dukpro.resep')->findOrFail($id);

    // Loop through each detailTransaksi
    foreach ($transaksi->detailTransaksis as $detailTransaksi) {
        if ($detailTransaksi->is_hampers) {
            // Handle hampers
            $hampers = $detailTransaksi->hampers;

            foreach ($hampers->details as $hampersDetail) {
                $produk = $hampersDetail->dukpro;
                
                foreach ($produk->resep as $resep) {
                    $bahanBaku = $resep->bahanBaku;
                    
                    // Create BahanBakuUsage
                    BahanBakuUsage::create([
                        'bahan_baku_id' => $bahanBaku->id,
                        'transaksi_id' => $transaksi->id,
                        'tanggal_transaksi' => now(),
                        'jumlah_digunakan' => $resep->jumlah * $detailTransaksi->jumlah_produk
                    ]);

                    // Update BahanBaku total_digunakan
                    $bahanBaku->increment('total_digunakan', $resep->jumlah * $detailTransaksi->jumlah_produk);
                }
            }
        } else {
            // Handle regular products
            $produk = $detailTransaksi->produk;

            foreach ($produk->resep as $resep) {
                $bahanBaku = $resep->bahanBaku;

                // Create BahanBakuUsage
                BahanBakuUsage::create([
                    'bahan_baku_id' => $bahanBaku->id,
                    'transaksi_id' => $transaksi->id,
                    'tanggal_transaksi' => now(),
                    'jumlah_digunakan' => $resep->jumlah * $detailTransaksi->jumlah_produk
                ]);

                // Update BahanBaku total_digunakan
                $bahanBaku->increment('total_digunakan', $resep->jumlah * $detailTransaksi->jumlah_produk);
            }
        }
    }

    // Redirect to show_pesanan_diproses route
    return redirect()->route('show_pesanan_diproses');
}


    
}