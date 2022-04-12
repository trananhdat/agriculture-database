<!-- ======= Header ======= -->
<header id="header">
    <div class="container d-flex">

        <div class="logo mr-auto">
            <h1 class="text-light"><a href="/">CSDL Hưng Yên</a></h1>
        </div>

        <nav class="nav-menu d-none d-lg-block">
            <ul>
                <li class="active"><a href="/">Trang chủ</a></li>
                <li><a href="<?= base_url('dashboard/'); ?>">Trang quản trị</a></li>
                <li class="drop-down"><a href="">Menu</a>
                    <ul>
                        <li class="drop-down"><a href="#">Lĩnh vực</a>
                            <ul>
                                <li><a href="<?= base_url('?jenjang=sd') ?>">Chăn nuôi</a></li>
                                <li><a href="<?= base_url('?jenjang=smp') ?>">Thú y</a></li>
                                <li><a href="<?= base_url('?jenjang=sma') ?>">Trồng trọt</a></li>
                                <li><a href="<?= base_url('?jenjang=smk') ?>">Khác</a></li>
                            </ul>
                        </li>
                        <li><a href="<?= base_url('table'); ?>">Thống kê - tìm kiếm</a></li>
                    </ul>
                </li>
            </ul>
        </nav><!-- .nav-menu -->

    </div>
</header><!-- End Header -->