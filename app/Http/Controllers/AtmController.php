<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionHistory;

class AtmController extends Controller
{
    public function showHomeScreen()
    {
        return view('home');
    }

    public function showTransactionHistory(Request $req)
    {

        switch ($req->type) {
            case 'transfer':
                $type = 'transfer';
                $data = TransactionHistory::with('accounttujuan.user', 'accountasal.user')->where('account_asal_id', \Auth::user()->account->id)->where('type', 'transfer')->latest()->paginate(5);
                break;
            case 'receive':
                $type = 'receive';
                $data = TransactionHistory::with('accounttujuan.user', 'accountasal.user')->where('account_tujuan_id', \Auth::user()->account->id)->where('type', 'transfer')->latest()->paginate(5);
                break;
            case 'withdraw':
                $type = 'withdraw';
                $data = TransactionHistory::with('accounttujuan.user', 'accountasal.user')->where('account_asal_id', \Auth::user()->account->id)->where('type', 'withdraw')->latest()->paginate(5);
                break;
            
            default:
                $type = 'topup';
                $data = TransactionHistory::with('accounttujuan.user', 'accountasal.user')->where('account_tujuan_id', \Auth::user()->account->id)->where('type', 'topup')->latest()->paginate(5);
                break;
        }
        
        return view('transaction_history', compact('data', 'type'));
    }
}
