@extends('master', ['title' => 'TRANSACTION HISTORY'])

<style>
    .card {
        box-shadow: 0 2px 19px rgba(0,0,0,.2);
    }
</style>

@section('content')

<div class="p-5" style="background-image: linear-gradient(to bottom, #271243, #381861);color: white;height: 260px !important;">
    <div class="container pt-2">
            <div class="d-flex justify-content-between">
                <h5> 
                    <a href="/home" class="text-white"><</a>
                    Riwayat Transaksi
                </h5>

                <a href="/logout">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                    </svg>
                </a>
            </div>
    </div>
</div>

<div class="container" style="margin-top: -55px;">
    <div class="row">

        <div class="card p-3 mb-5">
            
            <div class="btn-group mb-3">
                <a href="/transaction-history?type=topup" class="btn @if($type == 'topup') btn-primary @else btn-outline-primary @endif">Top Up</a>
                <a href="/transaction-history?type=transfer" class="btn @if($type == 'transfer') btn-primary @else btn-outline-primary @endif">Transfer</a>
                <a href="/transaction-history?type=receive" class="btn @if($type == 'receive') btn-primary @else btn-outline-primary @endif">Terima Dana</a>
                <a href="/transaction-history?type=withdraw" class="btn @if($type == 'withdraw') btn-primary @else btn-outline-primary @endif">Penarikan</a>
            </div>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col" style="width: 45px;">#</th>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">Nominal</th>
                        <th scope="col">Asal</th>
                        <th scope="col">Tujuan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $myId = \Auth::user()->id; ?>
                    @foreach($data as $i => $d)
                    <tr>
                        <th scope="row">{{ $i+1 }}</th>
                        <th>TR{{ str_pad($d->id, 4, '0', STR_PAD_LEFT) }}</th>
                        <td>Rp {{ number_format($d->nominal) }}</td>
                        <td>{{ ( $d->accountasal?->user->id == $myId) ? 'Saya' : $d->accountasal?->user?->name??'-' }}</td>
                        <td>{{ ( $d->accounttujuan?->user->id == $myId) ? 'Saya' : $d->accounttujuan?->user?->name??'-' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            {{ $data->appends($_GET)->links('pagination::bootstrap-5') }}

        </div>

    </div>
</div>

@endsection
