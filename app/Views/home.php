<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<section class="section">
          <div class="section-header">
            <h1>Monitoring Penugasan</h1>
          </div>

          <?php if(session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success" role="alert">
              <?= session()->getFlashdata('pesan')?>
            </div>
          <?php endif; ?>
          <div class="section-body">
          <!-- Chart -->
          <div class="d-flex justify-content-around">
            <div style="width: 300px; margin-bottom: 50px; margin-top: 50px">
              <canvas id="realisasi"></canvas>
            </div>
            <div style="width: 600px; margin-bottom: 50px; margin-top: 50px">
              <canvas id="tren_penugasan"></canvas>
            </div>
          </div>
          <!-- Tabel -->
          <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Penugasan D205</h4>
                    <div class="card-header-action">
                      <form method="POST">
                        <div class="input-group">
                          <?php if(session()->get('username') == "admin") : ?>
                          <a type="button" href="<?=site_url()?>home/create" class="btn btn-primary mr-2">Tambah Penugasan</a>
                          <?php endif; ?>
                          <input type="text" class="form-control" placeholder="Pencarian" name="keyword">
                          <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                      </form> 
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-striped" id="sortable-table">
                        <thead>
                          <tr>
                            <th class="text-center">
                              No
                            </th>
                            <th>Nama Penugasan</th>
                            <th>Nomor Surat</th>
                            <th>Ketua Tim</th>
                            <th>Tenggat Waktu</th>
                            <th>Status Penugasan</th>
                            <th>Status Laporan</th>
                            <th>Aksi</th>
                          </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1 + (10 * ($currentPage - 1)); ?>
                        <?php foreach ($penugasan as $p) : ?>
                          <tr>
                            <td>
                            <?= $i++; ?>
                            </td>
                            <td><?= $p['nama_penugasan']; ?></td>
                            <td class="align-middle">
                            <?= $p['nomor_surat']; ?>
                            </td>
                            <td>
                            Ketua Tim
                            </td>
                            <td><?= $p['tanggal_selesai']; ?></td>
                            <td>
                              <?php if ($p['tanggal_selesai'] < date("Y-m-d")) : ?>
                              <div class="badge badge-success">Selesai</div>
                              <?php else:  ?>
                              <div class="badge badge-warning">Belum</div>
                              <?php endif; ?>
                            </td>
                            <td>
                              <?php if ($p['status_laporan'] == 0) : ?>
                              <div class="badge badge-warning">Belum</div>
                              <?php elseif($p['status_laporan'] == 1):  ?>
                              <div class="badge badge-success">Sudah</div>
                              <?php endif; ?>
                            </td>
                            <td>
                              <button type="button" class="btn btn-primary m-1" data-toggle="modal" data-target="#exampleModal<?= $p['id_tugas']; ?> " data-backdrop="false">Detail</button>
                              <?php if(session()->get('username') == "admin") : ?>
                              <button type="button" class="btn btn-info m-1" data-toggle="modal" data-target="#berkas<?= $p['id_tugas']; ?> " data-backdrop="false">Edit</button>
                              <?php endif; ?>
                            </td>
                           <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?= $p['id_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Detail Penugasan</h5>
                                    <button href="" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                  <b>Nama Penugasan</b> : <?= $p['nama_penugasan']; ?><br>
                                  <b>Nomor Surat</b> : <?= $p['nomor_surat']; ?><br>
                                  <b>Tanggal Surat</b> : <?= $p['tanggal_surat']; ?> <br>
                                  <b>Mulai Penugasan</b> : <?= $p['tanggal_mulai']; ?><br>
                                  <b>Selesai Penugasan</b> : <?= $p['tanggal_selesai']; ?><br>
                                  <b>Personil Tim</b> : <?= $p['personil_tim']; ?><br>
                                  <b>Status Penugasan : </b> 
                                  <?php if ($p['tanggal_selesai'] < date("Y-m-d")) : ?>
                                  Selesai
                                  <?php else:  ?>
                                  Belum
                                  <?php endif; ?>
                                  <br>
                                  <b>Status Laporan : </b>
                                  <?php if ($p['status_laporan'] == 0) : ?>
                                  Belum
                                  <?php elseif($p['status_laporan'] == 1):  ?>
                                  Final
                                  <?php endif; ?>
                                  <br>
                                  <b>Nomor Laporan : </b> <?= $p['nomor_laporan']; ?><br>
                                  <br>
                                  <a href="<?= base_url();?>/home/download_st/<?=$p['id_tugas'];?>" type="button" class="btn btn-primary m-1 
                                  <?php if (empty($p['file_st'])) : ?>
                                  disabled
                                  <?php endif; ?>
                                  ">Surat Tugas</a>
                                  <a href="<?= base_url();?>/home/download_km/<?=$p['id_tugas'];?>" type="button" class="btn btn-info m-1">KM4 dan KM5</a>
                                  <a href="<?= base_url();?>/home/download_laporan/<?=$p['id_tugas'];?>" type="button" class="btn btn-success m-1">Laporan</a>
                                  <!-- <a href="<?= base_url();?>/home/download/<?=$p['id_tugas'];?>" type="button" class="btn btn-warning m-1">KM4 dan KM5</a> -->
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                    <!-- <button type="button" class="btn btn-primary">Simpan</button> -->
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal fade" id="berkas<?= $p['id_tugas']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Penugasan</h5>
                                    <button href="" type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                  <form method="post" action='/home/update/<?= $p['id_tugas']?>' enctype="multipart/form-data">
                                  <?= csrf_field(); ?>
                                      <div class="form-group">
                                          <label for="nama">Nama Penugasan</label>
                                          <input type="text" class="form-control" id="nama" aria-describedby="nama" name="nama" value="<?= old('nama_penugasan', $p['nama_penugasan']); ?>" >
                                      </div>
                                      <div class="form-group">
                                          <label for="nama">Nomor Surat</label>
                                          <input type="text" class="form-control" id="nomor" aria-describedby="nomor" name="nomor"  placeholder="Nomor Surat" value="<?= old('nomor_surat', $p['nomor_surat']); ?>">
                                      </div>
                                      <div class="form-group">
                                        <label for="nama">Tanggal Surat</label>
                                        <input type="date" class="form-control" id="tanggal_surat" aria-describedby="nomor" name="tanggal_surat"  placeholder="Tanggal Surat" value="<?= old('tanggal_surat', $p['tanggal_surat']); ?>">
                                      </div>
                                      <div class="form-group">
                                          <label for="nama">Tanggal Mulai</label>
                                          <input type="date" class="form-control" id="tanggal_mulai" aria-describedby="tanggal_mulai" name="tanggal_mulai" value="<?= old('tanggal_mulai', $p['tanggal_mulai']); ?>">
                                      </div>
                                      <div class="form-group">
                                          <label for="nama">Tanggal Selesai</label>
                                          <input type="date" class="form-control" id="tanggal_selesai" aria-describedby="tanggal_selesai" name="tanggal_selesai" value="<?= old('tanggal_selesai', $p['tanggal_selesai']); ?>">
                                      </div>
                                      <div class="form-group">
                                          <label for="nama">Nomor Laporan</label>
                                          <input type="text" class="form-control" id="nomor" aria-describedby="nomor_laporan" name="nomor_laporan"  placeholder="Nomor Laporan" value="<?= old('nomor_laporan', $p['nomor_laporan']); ?>">
                                      </div>
                                      <!-- <div class="form-group inline">
                                        <label for="status_laporan"> Status Laporan
                                        <input type="radio" class="form-control" style="width: 20px; height: 20px;" id="draft" name="status_laporan"> Draft
                                        <input type="radio" class="form-control" style="width: 20px; height: 20px;" id="final" name="status_laporan"> Final
                                        </label>
                                        
                                      </div> -->
                                      <!-- <div class="form-group">
                                        <label for="file_st"><b>Surat Tugas</b></label>
                                        <input type="file" class="form-control" id="file_st" name="file_st">
                                      </div> -->
                                      <!-- <div class="form-group">
                                        <label for="file_km"><b>KM4 dan KM5</b></label>
                                        <input type="file" class="form-control" id="file_km" name="file_km">
                                      </div>
                                      <div class="form-group">
                                        <label for="file_laporan"><b>Laporan</b></label>
                                        <input type="file" class="form-control" id="file_laporan" name="file_laporan">
                                      </div> --> -->
                                      <button type="submit" class="btn btn-success">Edit</button>

                                    </form>
                                    <form action="/home/<?= $p['id_tugas']; ?>" method="post" class="d-inline">
                                        <?= csrf_field(); ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin?');" >Hapus Penugasan</button>
                                      </form>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                    <!-- <button type="button" class="btn btn-primary">Simpan</button> -->
                                  </div>
                                </div>
                              </div>
                            </div>
                          </tr>
                          <?php endforeach; ?>
                        </tbody>
                      </table>
                      <?= $pager->links('penugasan', 'penugasan_pagination'); ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        
<?= $this->endSection() ?>