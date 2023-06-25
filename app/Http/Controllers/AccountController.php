<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TransactionHistory;
use App\Models\User;

class AccountController extends Controller
{
    public function topup(Request $req)
    {
        $account = \Auth::user()->account;
        $this->authorize('transaction-account', $account);

        $req->validate([
            'nominal' => 'required|numeric',
            'pin' => 'required|numeric|digits:6'
        ]);
        
        try {
            DB::beginTransaction();
            if(\Hash::check($req->pin, \Auth::user()->password) == false) {
                DB::rollback();
                toast('PIN anda salah', 'warning');
                return redirect()->back();
            }

            $account->lockForUpdate();
            $account->update([
                'balance' => $account->balance + $req->nominal
            ]);

            TransactionHistory::create([
                'account_tujuan_id' => $account->id,
                'nominal' => $req->nominal,
                'type' => 'topup'
            ]);
            
            DB::commit();
            toast('Berhasil melakukan Top Up', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            toast('Gagal melakukan Top Up', 'warning');
            return redirect()->back();
        }

    }

    public function transfer(Request $req)
    {
        
        $account_asal = \Auth::user()->account;
        $this->authorize('transaction-account', $account_asal);

        $req->validate([
            'nominal' => 'required|numeric',
            'id_tujuan' => 'required',
            'pin' => 'required|numeric|digits:6'
        ]);
        
        try {
            DB::beginTransaction();
        
            if(!\Hash::check($req->pin, \Auth::user()->password)) {
                DB::rollback();
                toast('PIN anda salah', 'warning');
                return redirect()->back();
            }
            
            $account_asal->lockForUpdate();

            $user_tujuan = User::where('username', $req->id_tujuan)->first();
            $account_tujuan = $user_tujuan?->account;
            
            // cek id tujuan apakah ada
            if( $account_tujuan == null ) {
                DB::rollback();
                toast('Gagal Transfer, Tujuan tidak ditemukan!', 'warning');
                return redirect()->back();
            }

            $account_tujuan->lockForUpdate();

            // cek nominal transfer apakah lebih kecil dari balance terkini
            if($account_asal->balance < $req->nominal) {
                DB::rollback();
                toast('Gagal Transfer, Saldo Anda tidak mencukupi!', 'warning');
                return redirect()->back();
            }

            // update balance asal
            $account_asal->update([
                'balance' => $account_asal->balance - $req->nominal
            ]);

            // update balance tujuan
            $account_tujuan->update([
                'balance' => $account_tujuan->balance + $req->nominal
            ]);

            TransactionHistory::create([
                'account_asal_id' => $account_asal->id,
                'account_tujuan_id' => $account_tujuan->id,
                'nominal' => $req->nominal,
                'type' => 'transfer'
            ]);
            
            DB::commit();
            toast('Berhasil melakukan Transfer', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            toast('Gagal melakukan Transfer', 'warning');
            return redirect()->back();
        }

    }

    public function withdraw(Request $req)
    {

        $account = \Auth::user()->account;
        $this->authorize('transaction-account', $account);

        $req->validate([
            'nominal' => 'required|numeric',
            'pin' => 'required|numeric|digits:6'
        ]);
        
        try {
            DB::beginTransaction();
        
            if(!\Hash::check($req->pin, \Auth::user()->password)) {
                DB::rollback();
                toast('PIN anda salah', 'warning');
                return redirect()->back();
            }
            
            $account->lockForUpdate();

            // cek ketersediaan saldo
            if($account->balance < $req->nominal) {
                DB::rollback();
                toast('Gagal Tarik Dana, Saldo Anda tidak mencukupi!', 'warning');
                return redirect()->back();
            }

            $account->update([
                'balance' => $account->balance - $req->nominal
            ]);

            TransactionHistory::create([
                'account_asal_id' => $account->id,
                'nominal' => $req->nominal,
                'type' => 'withdraw'
            ]);
            
            DB::commit();
            toast('Berhasil melakukan Penarikan Dana', 'success');
            return redirect()->back();
        } catch (\Throwable $th) {
            DB::rollback();
            toast('Gagal melakukan Penarikan Dana', 'warning');
            return redirect()->back();
        }

    }

}
