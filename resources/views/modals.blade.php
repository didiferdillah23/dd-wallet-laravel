<!-- Transfer Modal -->
<div class="modal fade" id="transferModal" tabindex="-1" aria-labelledby="transferModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="transferModalLabel">Transfer</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/transfer" method="post">
                @csrf 
                <div class="input-group mb-3">
                    <span class="input-group-text" id="nominal">Rp</span>
                    <input type="number" name="nominal" class="form-control" placeholder="Masukkan Nominal" aria-label="nominal" aria-describedby="nominal">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="id_tujuan">ID Tujuan</span>
                    <input type="text" name="id_tujuan" class="form-control" placeholder="Masukkan ID Tujuan" aria-label="id_tujuan" aria-describedby="id_tujuan">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="pin">PIN</span>
                    <input type="password" name="pin" class="form-control" placeholder="Konfirmasi PIN Anda" aria-label="pin" aria-describedby="pin">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Proses</button>
            </form>
        </div>
        </div>
    </div>
</div>

<!-- Top Up Modal -->
<div class="modal fade" id="topupModal" tabindex="-1" aria-labelledby="topupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="topupModalLabel">Top Up</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/topup" method="post">
                @csrf 
                <div class="input-group mb-3">
                    <span class="input-group-text" id="nominal">Rp</span>
                    <input type="number" name="nominal" class="form-control" placeholder="Masukkan Nominal" aria-label="nominal" aria-describedby="nominal">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="pin">PIN</span>
                    <input type="password" name="pin" class="form-control" placeholder="Konfirmasi PIN Anda" aria-label="pin" aria-describedby="pin">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Proses</button>
            </form>
        </div>
        </div>
    </div>
</div>

<!-- Withdraw Modal -->
<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="withdrawModalLabel">Tarik Dana</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="/withdraw" method="post">
                @csrf 
                <div class="input-group mb-3">
                    <span class="input-group-text" id="nominal">Rp</span>
                    <input type="number" name="nominal" class="form-control" placeholder="Masukkan Nominal Penarikan" aria-label="nominal" aria-describedby="nominal">
                </div>

                <div class="input-group mb-3">
                    <span class="input-group-text" id="pin">PIN</span>
                    <input type="password" name="pin" class="form-control" placeholder="Konfirmasi PIN Anda" aria-label="pin" aria-describedby="pin">
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Proses</button>
            </form>
        </div>
        </div>
    </div>
</div>