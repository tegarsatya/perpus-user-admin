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
                         <button type="button" class="btn btn-primary btn-sm" style="margin-bottom:15px;" data-toggle="modal" data-target="#add-user">
                             Tambah Kategori
                         </button>
                         <div class="clearfix"></div>
                     </div>
                     <div class="x_content">
                         <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                             <thead>
                                 <tr>
                                     <th>#</th>
                                     <th>Kategori</th>
                                     <th>Edit</th>
                                     <th>Hapus</th>
                                 </tr>
                             </thead>
                             <tbody>
                                 <?php $i = 1; ?>
                                 <?php foreach ($mst_kategori as $mk) : ?>
                                     <tr>
                                         <td><?= $i++; ?></td>
                                         <td><?= $mk['kategori']; ?></td>
                                         <td><button class="tombol-edit btn btn-success btn-block btn-sm" data-id="<?= $mk['id_kategori']; ?>" data-toggle="modal" data-target="#edit-user">Edit</button></td>
                                         <td><a href="<?= base_url('admin/del_kategori/') . $mk['id_kategori']; ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a></td>
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
 <div class="modal fade" id="add-user">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Tambah Kategori</h4>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal form-label-left" action="<?= base_url('admin/mst_kategori'); ?>" method="post">
                     <div class="form-group">
                         <label>Nama Kategori</label>
                         <input type="text" class="form-control" name="kategori">
                     </div>
                     <button type="submit" class="btn btn-primary">Simpan Data</button>
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

 <div class="modal fade" id="edit-user">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Edit Kategori</h4>
             </div>
             <div class="modal-body">
                 <form class="form-horizontal form-label-left" action="<?= base_url('admin/edit_kategori'); ?>" method="post">
                     <div class="form-group">
                         <input type="hidden" name="id_kategori" id="idjson">
                         <label>Nama Kategori</label>
                         <input type="text" class="form-control" name="kategori" id="kategori">
                     </div>
                     <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
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
         const id_kategori = $(this).data('id');
         $.ajax({
             url: '<?php echo base_url('admin/get_kategori'); ?>',
             data: {
                 id_kategori: id_kategori
             },
             method: 'post',
             dataType: 'json',
             success: function(data) {
                 $('#kategori').val(data.kategori);
                 $('#idjson').val(data.id_kategori);
             }
         });
     });
 </script>