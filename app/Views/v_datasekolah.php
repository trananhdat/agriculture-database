<?= $this->extend('template/BaseView'); ?>
<?= $this->section('content'); ?>
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?= $heading; ?></h1>
        </div>
        <?= $this->include('template/statusBar'); ?>
        <div class="row">
            <div class="col">
                <?php if (session()->getFlashdata('pesan')) { ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Thành công !</strong> <?= session()->getFlashdata('pesan'); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Thống kê - tìm kiếm</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>Địa chỉ</th>
                                    <th>Lĩnh vực</th>
                                    <th>Trạng thái</th>
                                    <th>Website</th>
                                    <th>Hành động</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($data as $i) { ?>
                                    <tr>
                                        <td><a href="<?= base_url($i['slug']); ?>"
                                               target="_blank"><?= $i['address']; ?></a></td>
                                        <td><?php
                                            if ($i['industry'] == 'SD') {
                                                echo "Chăn nuôi";
                                            } elseif ($i['industry'] == 'SMP') {
                                                echo "Thú y";
                                            } elseif ($i['industry'] == 'SMA') {
                                                echo "Trồng trọt";
                                            } else {
                                                echo "Khác";
                                            }
                                            ?></td>
                                        <?php if ($i['status'] == 'INACTIVE') {
                                            echo '<td><span class="badge badge-primary">' . $i['status'] . '</span></td>';
                                        } else {
                                            echo '<td><span class="badge badge-success">' . $i['status'] . '</span></td>';
                                        }

                                        ?>
                                        <td><a href="<?= $i['website']; ?>" target="_blank"><?= $i['website']; ?></a>
                                        </td>
                                        <td class="d-flex align-items-start"><a
                                                    href="<?= base_url('form/update/') . "/" . $i['slug']; ?>"
                                                    class="btn btn-warning mr-2 btn-sm">Cập nhật</a><br><a
                                                    href="<?= base_url('form/hapus/') . "/" . $i['id']; ?>"
                                                    class="btn btn-danger btn-sm">Xóa bỏ</a></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection(); ?>