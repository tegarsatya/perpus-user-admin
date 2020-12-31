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
                         <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Kd Jurnal</th>
                                     <th>Kategori</th>
                                     <th>Judul Jurnal</th>
                                     <th>Penulis</th>
                                     <th>Tgl Terbit</th>
                                     <th>Keterangan</th>
                                     <th>Opsi</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $i = 1; ?>
                                 <?php foreach ($mst_jurnal as $mj) : ?>
                                     <tr>
                                         <td><?= $i++; ?></td>
                                         <td><?= $mj['kode_jurnal']; ?></td>
                                         <td><?= $mj['kategori_jurnal']; ?></td>
                                         <td><?= $mj['judul_jurnal']; ?></td>
                                         <td><?= $mj['penulis']; ?></td>
                                         <td><?= format_indo($mj['tgl_terbit']); ?></td>
                                         <td><?= $mj['ket_jurnal']; ?></td>
                                         <td><button class="tombol-edit btn btn-success btn-block btn-sm" data-id="<?= $mj['id_jurnal']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td>
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
                 <h4 class="modal-title">Pinjam Jurnal</h4>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal form-label-left" action="<?= base_url('user/list_jurnal'); ?>" method="post">
                     <div class="form-group">
                         <label>Kode jurnal</label>
                         <input type="hidden" name="id_jurnal" id="idjson">
                         <input type="text" class="form-control" name="kode_jurnal" id="kode" readonly>
                     </div>
                     <div class="form-group">
                         <label>Judul jurnal</label>
                         <input type="text" class="form-control" id="judul" readonly>
                     </div>
                     <div class="form-group">
                         <label>Penulis</label>
                         <input type="text" class="form-control" id="penulis" readonly>
                     </div>

                     <div class="form-group">
                         <label>Tanggal Terbit</label>
                         <input type="date" class="form-control" id="tgl" readonly>
                     </div>
                     <div class="form-group">
                         <label>Keterangan </label>
                         <textarea class="form-control" rows="1" id="ket" readonly></textarea>
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
                         <textarea class="form-control" rows="2" name="ket_pinjam"></textarea>
                     </div>
                     <button type="submit" class="btn btn-primary">Pinjam Jurnal</button>
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
         const id_jurnal = $(this).data('id');
         $.ajax({
             url: '<?php echo base_url('user/get_jurnal'); ?>',
             data: {
                 id_jurnal: id_jurnal
             },
             method: 'post',
             dataType: 'json',
             success: function(data) {
                 $('#kode').val(data.kode_jurnal);
                 $('#judul').val(data.judul_jurnal);
                 $('#penulis').val(data.penulis);
                 $('#tgl').val(data.tgl_terbit);
                 $('#ket').val(data.ket_jurnal);
                 $('#idjson').val(data.id_jurnal);
             }
         });
     });
 </script>