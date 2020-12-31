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
                                     <th>Opsi</th>

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
                                         <?php if ($p['status'] == 1) : ?>
                                             <td><a href="<?= base_url('user/del_pinjam/' . $p['id_pinjam']); ?>" class="tombol-hapus btn btn-danger btn-block btn-sm">Hapus</a></td>
                                         <?php else : ?>
                                             <td><span class="btn btn-dark btn-block btn-sm">Closed</span></td>
                                         <?php endif; ?>

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