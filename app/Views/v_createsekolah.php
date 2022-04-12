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
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Bản đồ nông nghiệp</h6>
                </div>
                <div class="card-body">
                    <div id="mapid" style=" height: 400px;"></div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Tạo địa điểm</h6>
                </div>
                <div class="card-body">
                    <form action="/form/simpan" method="POST" enctype="multipart/form-data">
                        <?php if ($validation->hasError('checkbox')) { ?>
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>Vui lòng kiểm tra hộp bên dưới ! </strong>Để đảm bảo rằng dữ liệu bạn đã nhập là chính xác, vui lòng đọc lại thông tin đầu vào của bạn
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>
                        <div class="form-group">
                            <label>Địa chỉ</label>
                            <input type="text" placeholder="Nhập địa chỉ" class="form-control <?= ($validation->hasError('address')) ? 'is-invalid' : ''; ?>" name="address" value="<?= old('address'); ?>" autofocus>
                            <div class="invalid-feedback">
                                <?= $validation->getError('address'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Lĩnh vực</label>
                            <select class="form-control" name="industry">
                                <option value="SD" selected>Chăn nuôi</option>
                                <option value="SMP">Thú y</option>
                                <option value="SMA">Công nghiệp</option>
                                <option value="SMK">Ngành khác</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Hình ảnh</label>
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="photo" name="photo" onchange="img()">
                                <label class="custom-file-label">Chọn ảnh</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea type="text" id="ckeditor" class="ckeditor form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Đường dẫn Website</label>
                            <input type="url" placeholder="Nhập đường dẫn..." class="form-control" name="website">
                        </div>
                        <div class="form-group">
                            <label>Trạng thái</label>
                            <select class="form-control" name="status">
                                <option value="INACTIVE" selected>Ngưng hoạt động</option>
                                <option value="ACTIVE">Hoạt động</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Vĩ độ</label>
                            <input id="Latitude" type="text" class="form-control <?= ($validation->hasError('latitude')) ? 'is-invalid' : ''; ?>" name="latitude" value="<?= old('latitude'); ?>" readonly>
                            <div class="invalid-feedback">
                                <?= $validation->getError('latitude'); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Kinh dộ</label>
                            <input id="Longitude" type="text" class="form-control <?= ($validation->hasError('longitude')) ? 'is-invalid' : ''; ?>" name="longitude" value="<?= old('longitude'); ?>" readonly>
                            <div class="invalid-feedback">
                                <?= $validation->getError('longitude'); ?>
                            </div>
                        </div>
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" name="checkbox">
                            <label class="form-check-label">Xác nhận dữ liệu chính xác.</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

</div>

<script type='text/javascript'>
    var curLocation = [0, 0];
    if (curLocation[0] == 0 && curLocation[1] == 0) {
        curLocation = [21.0278, 105.8342];
    }

    var L = window.L;

    var mymap = L.map('mapid').setView([21.0278, 105.8342], 13);
    L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
            '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
            'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
        id: 'mapbox/streets-v11'
    }).addTo(mymap);

    mymap.attributionControl.setPrefix(false);
    var marker = new L.marker(curLocation, {
        draggable: 'true'
    });

    marker.on('dragend', function(event) {
        var position = marker.getLatLng();
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        $("#Latitude").val(position.lat);
        $("#Longitude").val(position.lng).keyup();
    });

    
    document.addEventListener("DOMContentLoaded", function(event) { 
        $("#Latitude, #Longitude").change(function() {
        var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
        marker.setLatLng(position, {
            draggable: 'true'
        }).bindPopup(position).update();
        mymap.panTo(position);
    });
});
    mymap.addLayer(marker);
</script>
<script>
    function img() {
        const gambarLabel = document.querySelector('.custom-file-label');
        gambarLabel.textContent = foto_sekolah.files[0].name;
    }
</script>
<?= $this->endSection(); ?>