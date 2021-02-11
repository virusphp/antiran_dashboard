<div id="profil-card" class="col-sm-6 col-md-3">
    <div class="card card-accent-dark">
        <div class="card-header"><strong>Profil</strong> Pegawai</div>
        <div class="card-body" id="user-profil">
            
            <div class="form-group">
                <label for="nama_pegawai">Nama pegawai</label>
                <input class="form-control form-control-sm" id="nama_pegawai" name="nama_pegawai" type="text" placeholder="Nama Pegawai" autofocus>
                <input class="form-control form-control-sm" name="_token" type="hidden" value="{{ csrf_token() }}">
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input readonly class="form-control form-control-sm" id="username" name="username" type="text" placeholder="Username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input class="form-control form-control-sm" id="password" name="password" type="password" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="role">Role</label>
                <select id="role" name="role" class="form-control form-control-sm">
                        <option value="">-- Pilih --</option> 
                        <option value="admin">Admin</option> 
                        <option value="operator">Operator</option> 
                </select>
            </div>

        </div>
    </div>
</div>