 <!-- page content -->
 <div class="right_col" role="main">
     <div class="">
         <div class="page-title">
             <div class="title_left">
                 <h3><?= $title; ?></h3>
             </div>
             <div class="title_right">
                 <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                     <div class="input-group">
                         <input type="text" class="form-control" placeholder="Search for...">
                         <span class="input-group-btn">
                             <button class="btn btn-default" type="button">Go!</button>
                         </span>
                     </div>
                 </div>
             </div>
         </div>
         <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
         <?php echo $this->session->flashdata('msg'); ?>
         <?php if (validation_errors()) { ?>
             <div class="alert alert-danger">
                 <a class="close" data-dismiss="alert">x</a>
                 <strong><?php echo strip_tags(validation_errors()); ?></strong>
             </div>
         <?php } ?>
         <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="x_panel">
                     <div class="x_title">
                         <div class="clearfix"></div>
                     </div>
                     <div class="x_content">
                         <table id="datatable" class="table table-striped table-bordered">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Nama Peminjam</th>
                                     <th>Pinjaman Buku</th>
                                     <th>Pinjaman Jurnal</th>
                                     <th>Tgl Pinjam</th>
                                     <th>Tgl Kembali</th>
                                     <th>Penerima</th>
                                     <th>Ket. Pinjam</th>
                                     <th>Status</th>
                                     <th>Status</th>
                                     <!-- <th>Hapus</th> -->
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $i = 1; ?>
                                 <?php foreach ($peminjam as $p) : ?>
                                     <tr>
                                         <td><?= $i++; ?></td>
                                         <td><?= $p['nama']; ?></td>
                                         <td><?= $p['judul_buku']; ?></td>
                                         <td><?= $p['judul_jurnal']; ?></td>
                                         <td><?= $p['tgl_pinjam']; ?></td>
                                         <td><?= $p['tgl_kembali']; ?></td>
                                         <td><?= $p['penerima']; ?></td>
                                         <td><?= $p['ket_pinjam']; ?></td>
                                         <?php if ($p['status'] == 1) : ?>
                                             <td><span class="btn btn-warning btn-block btn-sm">Dipinjam</span></td>
                                         <?php else : ?>
                                             <td><span class="btn btn-success btn-block btn-sm">Kembali</span></td>
                                         <?php endif; ?>
                                         <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?= $p['id_pinjam']; ?>" data-toggle="modal" data-target="#edit-user"> + Status</button></td>
                                         <!-- <td><a href="<?= base_url('admin/del_pinjam/') . $p['id_pinjam']; ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a></td> -->
                                     </tr>
                                 <?php endforeach; ?>
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- /page content -->

 <div class="modal fade" id="edit-user">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Isi Status Buku</h4>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal form-label-left" action="<?= base_url('admin/list_pinjam'); ?>" method="post">
                     <div class="form-group">
                         <label>Kode Buku</label>
                         <input type="hidden" name="id_pinjam" id="idjson">
                         <input type="text" class="form-control" id="pinjaman" readonly>
                     </div>
                     <div class="form-group">
                         <label>Penerima</label>
                         <input type="text" class="form-control" id="penerima" readonly>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Tgl Pinjam</label>
                                 <input type="date" class="form-control" id="tglpinjam" readonly>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Tgl Kembali</label>
                                 <input type="date" class="form-control" id="tglkembali" name="tgl_kembali" required>
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <label>Keterangan </label>
                         <textarea class="form-control" rows="3" name="ket_pinjam" id="ket"></textarea>
                     </div>
                     <div class="form-group">
                         <div class="radio">
                             <label>
                                 <input type="radio" class="flat" checked name="status" value="1"> Belum Kembali
                             </label>
                         </div>
                         <div class="radio">
                             <label>
                                 <input type="radio" class="flat" name="status" value="0"> Kembali
                             </label>
                         </div>
                     </div>

                     <button type="submit" class="btn btn-primary">Simpan Status</button>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                 </form>
             </div>
             <div class="modal-footer">
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>

 <script>
     $('.tombol-edit').on('click', function() {
         const id_pinjam = $(this).data('id');
         $.ajax({
             url: '<?php echo base_url('admin/get_pinjam'); ?>',
             data: {
                 id_pinjam: id_pinjam
             },
             method: 'post',
             dataType: 'json',
             success: function(data) {
                 $('#pinjaman').val(data.pinjaman);
                 $('#penerima').val(data.penerima);
                 $('#tglpinjam').val(data.tgl_pinjam);
                 $('#tglkembali').val(data.tgl_kembali);
                 $('#ket').val(data.ket_pinjam);
                 $('#idjson').val(data.id_pinjam);
             }
         });
     });
 </script>