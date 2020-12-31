<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>USER</h3>
        <ul class="nav side-menu">
            <li><a href="<?= base_url('user/index'); ?>"><i class="fa fa-book"></i> Daftar Buku</a></li>
            <li><a href="<?= base_url('user/list_jurnal'); ?>"><i class="fa fa-file"></i> Daftar Jurnal</a></li>
            <li><a href="<?= base_url('user/list_pinjam'); ?>"><i class="fa fa-check-square-o"></i> List Pinjaman</a></li>
        </ul>
    </div>
    <div class="menu_section">
        <h3>END</h3>
        <ul class="nav side-menu">
            <li><a href="<?= base_url('auth/logout'); ?>" class="tombol-logout"><i class="fa fa-sign-out"></i> Logout</a></li>
        </ul>
    </div>

</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
</div>
</div>