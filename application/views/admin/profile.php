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
                     <!-- <div class="x_title">
                         <h2>List User</h2>
                         <div class="clearfix"></div>
                     </div> -->
                     <div class="x_content">

                         <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                         <?php echo $this->session->flashdata('msg'); ?>
                         <?php if (validation_errors()) { ?>
                             <div class="alert alert-danger">
                                 <a class="close" data-dismiss="alert">x</a>
                                 <strong><?php echo strip_tags(validation_errors()); ?></strong>
                             </div>
                         <?php } ?>
                         <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                             <div class="profile_img">
                                 <div id="crop-avatar">
                                     <!-- Current avatar -->
                                     <img class="img-responsive avatar-view" src="<?= base_url('assets/img/profile/' . $user['image']); ?>" alt="Avatar" title="Change the avatar">
                                 </div>
                             </div>
                             <h3><?= $user['nama']; ?></h3>

                             <ul class="list-unstyled user_data">
                                 <li><i class="fa fa-envelope user-profile-icon"></i> <?= $user['email']; ?>
                                 </li>
                                 <li>
                                     <i class="fa fa-user user-profile-icon"></i> <?= $user['username']; ?>
                                 </li>
                                 <li>
                                     <i class="fa fa-calendar user-profile-icon"></i> <?= format_indo($user['date_created']); ?>
                                 </li>
                             </ul>
                             <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#edit-profile"><i class="fa fa-edit m-right-xs"></i> Edit Profile</button>
                             <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ubah-password"><i class="fa fa-key m-right-xs"></i> Ubah Password</button>
                             <br />
                             <!-- start skills -->
                             <!-- end of skills -->
                         </div>
                         <div class="col-md-9 col-sm-9 col-xs-12">
                             <div class="" role="tabpanel" data-example-id="togglable-tabs">
                                 <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                                     <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Daftar Anggota</a>
                                     </li>
                                     <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Daftar Pinjaman</a>
                                     </li>

                                 </ul>
                                 <div id="myTabContent" class="tab-content">
                                     <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">
                                         <!-- start recent activity -->
                                         <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                                             <thead>
                                                 <tr>
                                                     <th>#</th>
                                                     <th>Nama</th>
                                                     <th>Email</th>
                                                     <th>Username</th>
                                                     <th>Level</th>
                                                     <th>Tgl Registrasi</th>
                                                     <th>Status</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                 <?php $i = 1; ?>
                                                 <?php foreach ($list_user as $lu) : ?>
                                                     <tr>
                                                         <td><?= $i++; ?></td>
                                                         <td><?= $lu['nama']; ?></td>
                                                         <td><?= $lu['email']; ?></td>
                                                         <td><?= $lu['username']; ?></td>
                                                         <td><?= $lu['level']; ?></td>
                                                         <td><?= format_indo($lu['date_created']); ?></td>
                                                         <?php if ($lu['is_active'] == 1) : ?>
                                                             <td>Aktif</td>
                                                         <?php else : ?>
                                                             <td>Tidak Aktif</td>
                                                         <?php endif; ?>
                                                     </tr>
                                                 <?php endforeach; ?>
                                             </tbody>
                                         </table>
                                         <!-- end recent activity -->
                                     </div>
                                     <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">
                                         <!-- start user projects -->
                                         <table id="datatable-fixed-header" class="table table-striped table-bordered">
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
                                                     </tr>
                                                 <?php endforeach; ?>
                                             </tbody>
                                         </table>

                                         <!-- end user projects -->
                                     </div>

                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
 <!-- /page content -->

 <div class="modal fade" id="edit-profile">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Edit Profile</h4>
             </div>
             <div class="modal-body">
                 <?php echo form_open_multipart('admin/profile'); ?>
                 <div class="form-group row">
                     <label for="username" class="col-sm-2 col-form-label">Username</label>
                     <div class="col-sm-10">
                         <input type="hidden" class="form-control" name="id" value="<?php echo $user['id']; ?>">
                         <input type="text" class="form-control" id="username" value="<?php echo $user['username']; ?>" readonly>
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="name" class="col-sm-2 col-form-label">Nama</label>
                     <div class="col-sm-10">
                         <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $user['nama']; ?>">
                     </div>
                 </div>
                 <div class="form-group row">
                     <label for="name" class="col-sm-2 col-form-label">Email</label>
                     <div class="col-sm-10">
                         <input type="text" class="form-control" id="nama" name="email" value="<?php echo $user['email']; ?>">
                     </div>
                 </div>
                 <div class="form-group row">
                     <div class="col-sm-2"> <label for="name">Profile Picture</label></div>
                     <div class="col-sm-10">
                         <div class="row">
                             <div class="col-sm-3">
                                 <img src="<?= base_url('assets/img/profile/' . $user['image']); ?>" class="img-thumbnail">
                             </div>
                             <div class="col-sm-9">
                                 <div class="custom-file">
                                     <input type="file" class="custom-file-input" id="image" name="image">
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary pull-right">Simpan Perubahan</button>
                 </form>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>

 <div class="modal fade" id="ubah-password">
     <div class="modal-dialog modal-sm">
         <div class="modal-content">
             <div class="modal-header">
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span></button>
                 <h4 class="modal-title">Ubah Password</h4>
             </div>
             <div class="modal-body">
                 <form action="<?php echo base_url('admin/changepassword'); ?>" method="post">
                     <div class="form-group">
                         <label for="current_password">Password Lama</label>
                         <input type="password" class="form-control" id="current_password" name="current_password">
                         <?= form_error('current_password', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group">
                         <label for="new_password1">Password Baru</label>
                         <input type="password" class="form-control" id="new_password1" name="new_password1">
                         <?= form_error('new_password1', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
                     <div class="form-group">
                         <label for="new_password2">Repeat Password Baru</label>
                         <input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Ketik ulang password baru">
                         <?= form_error('new_password2', '<small class="text-danger pl-3">', '</small>'); ?>
                     </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                 <button type="submit" class="btn btn-primary pull-right">Ganti Password</button>
                 </form>
             </div>
         </div>
         <!-- /.modal-content -->
     </div>
     <!-- /.modal-dialog -->
 </div>