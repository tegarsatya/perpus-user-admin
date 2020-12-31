<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>ADMINISTRATOR</h3>
        <ul class="nav side-menu">
            <li><a href="<?= base_url('admin/index'); ?>"><i class="fa fa-home"></i> Home</a></li>
            <li><a><i class="fa fa-book"></i> Master Buku <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('admin/mst_kategori'); ?>"> Master Kategori Buku</a></li>
                    <li><a href="<?= base_url('admin/mst_buku'); ?>"> Master Buku</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-file-text-o"></i> Master Jurnal <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="<?= base_url('admin/mst_kategori_jurnal'); ?>"> Master Kategori Jurnal</a></li>
                    <li><a href="<?= base_url('admin/mst_jurnal'); ?>"> Master Jurnal</a></li>
                </ul>
            </li>
            <li><a href="<?= base_url('admin/list_pinjam'); ?>"><i class="fa fa-users"></i> List Peminjam</a></li>
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