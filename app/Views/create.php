<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<section class="section">
          <div class="section-header">
            <h1>Tambah Penugasan</h1>
          </div>
          <div class="section-body  ">
            <form action="/home/save" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="nama_penugasan">Nama Penugasan</label>
                    <input type="text" class="form-control <?=($validation->hasError('nama_penugasan')) ? 'is-invalid': ''; ?>" id="nama_penugasan" aria-describedby="nama" name="nama_penugasan" placeholder="Nama Penugasan" autofocus value="<?= old('nama_penugasan'); ?>">
                    <div class="invalid-feedback">
                        Nama penugasan harus diisi!
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama">Nomor Surat</label>
                    <input type="text" class="form-control <?=($validation->hasError('nomor_surat')) ? 'is-invalid': ''; ?>" id="nomor_surat" aria-describedby="nomor" name="nomor_surat"  placeholder="Nomor Surat" autofocus value="<?= old('nomor_surat'); ?>">
                    <div class="invalid-feedback">
                       Nomor surat harus diisi!
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama">Tanggal Surat</label>
                    <input type="date" class="form-control <?=($validation->hasError('tanggal_surat')) ? 'is-invalid': ''; ?>" id="tanggal_surat" aria-describedby="nomor" name="tanggal_surat"  placeholder="Tanggal Surat" autofocus value="<?= old('tanggal_surat'); ?>">
                    <div class="invalid-feedback">
                       Tanggal surat harus diisi!
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama">Tanggal Mulai</label>
                    <input type="date" class="form-control <?=($validation->hasError('tanggal_mulai')) ? 'is-invalid': ''; ?>" id="tanggal_mulai" aria-describedby="tanggal_mulai" name="tanggal_mulai" autofocus value="<?= old('tanggal_mulai'); ?>">
                    <div class="invalid-feedback">
                        Tanggal mulai harus diisi!
                    </div>
                </div>
                <div class="form-group">
                    <label for="nama">Tanggal Selesai</label>
                    <input type="date" class="form-control <?=($validation->hasError('tanggal_selesai')) ? 'is-invalid': ''; ?>" id="tanggal_selesai" aria-describedby="tanggal_selesai" name="tanggal_selesai" autofocus value="<?= old('tanggal_selesai'); ?>">
                    <div class="invalid-feedback">
                        Tanggal selesai harus diisi!
                    </div>
                </div>
                <div class="form-group">
                    <label for="file_st"><b>Surat Tugas</b></label>
                    <input type="file" class="form-control " id="file_st" name="file_st">
                    <!-- <div class="invalid-feedback">
                    </div> -->
                </div>
                <div class="form-group">
                    <label for="file_km"><b>KM4 dan KM5</b></label>
                    <input type="file" class="form-control" id="file_km" name="file_km">
                </div>                                                                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
          </div>
        </section>
<?= $this->endSection() ?>