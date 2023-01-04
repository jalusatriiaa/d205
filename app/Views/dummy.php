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
                                    
                                      <button type="submit" class="btn btn-success">Edit</button>

                                    
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Tutup</button>
                                    <!-- <button type="button" class="btn btn-primary">Simpan</button> -->
                                  </div>
                                </div>
                              </div>
                            </div>