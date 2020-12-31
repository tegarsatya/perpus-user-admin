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
         <div class="row">
             <div class="col-md-12 col-sm-12 col-xs-12">
                 <div class="x_panel">
                     <div class="x_title">
                         <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                         <?php echo $this->session->flashdata('msg'); ?>
                         <?php if (validation_errors()) { ?>
                             <div class="alert alert-danger">
                                 <a class="close" data-dismiss="alert">x</a>
                                 <strong><?php echo strip_tags(validation_errors()); ?></strong>
                             </div>
                         <?php } ?>
                         <div class="clearfix"></div>
                     </div>
                     <div class="x_content">
                         <table id="100%" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Kd Buku</th>
                                     <th>Kategori</th>
                                     <th>Judul Buku</th>
                                     <th>Penulis</th>
                                     <th>Jml Halaman</th>
                                     <th>Tgl Terbit</th>
                                     <th>Keterangan</th>
                                     <th>Opsi</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $i = 1; ?>
                                 <?php foreach ($mst_buku as $mb) : ?>
                                     <tr>
                                         <td><?= $i++; ?></td>
                                         <td><?= $mb['kode_buku']; ?></td>
                                         <td><?= $mb['kategori']; ?></td>
                                         <td><?= $mb['judul_buku']; ?></td>
                                         <td><?= $mb['penulis']; ?></td>
                                         <td><?= $mb['jml_hal']; ?></td>
                                         <td><?= format_indo($mb['tgl_terbit']); ?></td>
                                         <td><?= $mb['ket_buku']; ?></td>
                                         <td><button class="tombol-edit btn btn-info btn-block btn-sm" data-id="<?= $mb['id_buku']; ?>" data-toggle="modal" data-target="#edit-user">Pinjam</button></td>
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

 <div class="modal fade" id="edit-user">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Pinjaman Buku</h4>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal form-label-left" action="<?= base_url('user/index'); ?>" method="post">
                     <input type="hidden" name="id_buku" id="idjson">
                     <div class="form-group">
                         <label>Kode Buku</label>
                         <input type="text" class="form-control" name="kode_buku" id="kode_buku" readonly>
                     </div>
                     <div class="form-group">
                         <label>Judul Buku</label>
                         <input type="text" class="form-control" id="judul" readonly>
                     </div>
                     <div class="form-group">
                         <label>Keterangan </label>
                         <textarea class="form-control" rows="3" name="ket_buku" id="ket" readonly></textarea>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Tgl Pinjam</label>
                                 <input type="date" class="form-control" name="tgl_pinjam" required>
                             </div>
                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Tgl Kembali</label>
                                 <input type="date" class="form-control" name="tgl_kembali">
                             </div>
                         </div>
                     </div>
                     <div class="form-group">
                         <label>Penerima</label>
                         <input type="text" class="form-control" name="penerima" required>
                     </div>
                     <div class="form-group">
                         <label>Keterangan Pinjam </label>
                         <textarea class="form-control" rows="3" name="ket_pinjam"></textarea>
                     </div>
                     <button type="submit" class="btn btn-primary">Pinjam Buku</button>
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
         const id_buku = $(this).data('id');
         $.ajax({
             url: '<?php echo base_url('user/get_buku'); ?>',
             data: {
                 id_buku: id_buku
             },
             method: 'post',
             dataType: 'json',
             success: function(data) {
                 $('#kode_buku').val(data.kode_buku);
                 $('#judul').val(data.judul_buku);
                 $('#idjson').val(data.id_buku);
             }
         });
     });
 </script>