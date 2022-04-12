<?=$this->extend('auth/BaseView');?>
<?=$this->section('content');?>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

        <div class="col-xl-10 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">CSDL Nông nghiệp</h1>
                                </div>
                                <form action="/auth/prosesregis" method="POST" class="user">
                                <div class="form-group">
                                        <input type="text" class="form-control form-control-user"
                                            placeholder="Nhập tên..." name="nama">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user"
                                            id="exampleInputEmail" aria-describedby="emailHelp"
                                            placeholder="Nhập địa chỉ email..." name="email">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Nhập mật khẩu" name="password">
                                    </div>
                                    <input type="submit" class="btn btn-primary btn-user btn-block" value="Đăng nhập">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>
<?=$this->endSection();?>