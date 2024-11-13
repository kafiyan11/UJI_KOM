<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('AdminLTE-2') }}/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <!-- Main Navigation -->
            <li class="header">MAIN NAVIGATION</li>
            
            <li>
                <a href="{{ route('barang.histori') }}">
                    <i class="fa fa-cubes"></i> <span>Lihat Data Barang</span>
                </a>
            </li>
            <li>
                <a href="{{ route('kasirs.lihatdata') }}">
                    <i class="fa fa-user-circle"></i> <span>Lihat Data Kasir</span>
                </a>
            </li>
            <!-- Transactions Section -->
            <li class="header">TRANSAKSI</li>
            <li>
                <a href="{{ route('transaksi.index') }}">
                    <i class="fa fa-shopping-cart"></i> <span>Transaksi Penjualan</span>
                </a>
            </li>
            <li>
                <a href="{{ route('transaksi.histori') }}">
                    <i class="fa fa-history"></i> <span>Lihat History Order</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
