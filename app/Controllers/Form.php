<?php

namespace App\Controllers;

use App\Models\DataModel;

class Form extends BaseController
{
    protected $DataModel;
    public function __construct()
    {
        $this->DataModel = new DataModel();
    }

    public function index()
    {
        return redirect()->to('/form/datasekolah');
    }

    public function datasekolah()
    {
        $data = [
            'title' => "Bảng biểu",
            'appname' => "CSDL Nông Nghiệp",
            'heading' => "Thống kê - tìm kiếm",
            'data' => $this->DataModel->getSekolah(),
            'sd' => $this->DataModel->countSekolah("SD"),
            'smp' => $this->DataModel->countSekolah("SMP"),
            'sma' => $this->DataModel->countSekolah("SMA"),
            'smk' => $this->DataModel->countSekolah("SMK")
        ];

        return view('v_datasekolah', $data);
    }
    public function createsekolah()
    {
        session();
        $data = [
            'title' => "Tạo mới bảng biểu",
            'appname' => "CSDL Nông Nghiệp",
            'heading' => "Thêm mới bảng biểu",
            'validation' => \Config\Services::validation(),
            'sd' => $this->DataModel->countSekolah("SD"),
            'smp' => $this->DataModel->countSekolah("SMP"),
            'sma' => $this->DataModel->countSekolah("SMA"),
            'smk' => $this->DataModel->countSekolah("SMK")
        ];

        return view('v_createsekolah', $data);
    }

    public function simpan()
    {
        if (!$this->validate([
            'address' => [
                'rules' => 'required|is_unique[tbl_sekolah.address]',
                'errors' => [
                    'required' => 'Địa chỉ không được để trống',
                    'is_unique' => 'Địa chỉ đã được sử dụng'
                ]
            ],
            'photo' => [
                'rules' => 'max_size[photo,1024]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar Tidak Boleh Diatas 1024 Kb',
                    'is_image' => 'Pastikan kamu upload gambar',
                    'mine_in' => 'Format gambar hanya .jpg .jpeg dan .png'
                ]
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vĩ độ không được để trống'
                ]
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kinh độ không được để trống'
                ]
            ],
            'checkbox' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Xin mời xác nhận dữ liệu là chính xác!'
                ]
            ]
        ])) {
            return redirect()->to('/form/createsekolah')->withInput();
        }


        $FileFoto = $this->request->getFile('photo');
        if ($FileFoto == "") {
            $NamaFile = "default.png";
        } else {
            $NamaFile = $FileFoto->getRandomName();
            $FileFoto->move('img/sekolah', $NamaFile);
        }

        $slug = url_title($this->request->getVar('address'), '-', TRUE);

        $this->DataModel->save([
            'address' => $this->request->getVar('address'),
            'slug' => $slug,
            'industry' => $this->request->getVar('industry'),
            'photo' => $NamaFile,
            'description' => $this->request->getVar('description'),
            'status' => $this->request->getVar('status'),
            'website' => $this->request->getVar('website'),
            'latitude' =>  $this->request->getVar('latitude'),
            'longitude' =>  $this->request->getVar('longitude')
        ]);

        session()->setFlashdata('pesan', 'Lưu dữ liệu thành công');
        return redirect()->to('/form/datasekolah');
    }

    public function hapus($id)
    {
        $Sekolah = $this->DataModel->find($id);
        if ($Sekolah['photo'] == "default.png") {
            $this->DataModel->delete($id);
        } else {
            // unlink('img/sekolah/' . $Sekolah['photo']);
            $this->DataModel->delete($id);
        }

        session()->setFlashdata('pesan', 'Xóa thành công');
        return redirect()->to('/form/datasekolah');
    }

    public function update($slug)
    {
        session();
        $Sekolah = $this->DataModel->getSekolah($slug);
        $data = [
            'title' => "Update : " . $Sekolah['address'],
            'appname' => "WEBGIS - CI",
            'heading' => "Update Sekolah",
            'data' => $Sekolah,
            'validation' => \Config\Services::validation(),
            'sd' => $this->DataModel->countSekolah("SD"),
            'smp' => $this->DataModel->countSekolah("SMP"),
            'sma' => $this->DataModel->countSekolah("SMA"),
            'smk' => $this->DataModel->countSekolah("SMK")
        ];

        return view('v_updatesekolah', $data);
    }

    public function prosesupdate($slug)
    {
        if (!$this->validate([
            'address' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Địa chỉ không được để trống'
                ]
            ],
            'photo' => [
                'rules' => 'max_size[photo,1024]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar Tidak Boleh Diatas 1024 Kb',
                    'is_image' => 'Pastikan kamu upload gambar',
                    'mine_in' => 'Format gambar hanya .jpg .jpeg dan .png'
                ]
            ],
            'latitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Vĩ độ không được để trống'
                ]
            ],
            'longitude' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Kinh độ không được để trống'
                ]
            ],
            'checkbox' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Xin mời xác nhận dữ liệu chính xác'
                ]
            ]
        ])) {
            return redirect()->to('/form/update/' . $slug)->withInput();
        }
        $datalama = $this->DataModel->getSekolah($slug);
        if ($this->request->getFile('photo') == "") {
            $NamaFile = $datalama['photo'];
        } else {
            if ($datalama['photo'] == "default.png") {
                $getFile = $this->request->getFile('photo');
                $NamaFile = $getFile->getRandomName();
                $getFile->move('img/sekolah/', $NamaFile);
            } else {
                unlink('img/sekolah/' . $datalama['photo']);
                $getFile = $this->request->getFile('photo');
                $NamaFile = $getFile->getRandomName();
                $getFile->move('img/sekolah/', $NamaFile);
            }
        }

        $this->DataModel->save([
            'id' => $this->request->getPost('id'),
            'address' => $this->request->getPost('address'),
            'industry' => $this->request->getPost('industry'),
            'photo' => $NamaFile,
            'description' => $this->request->getPost('deskripsi'),
            'status' => $this->request->getPost('status'),
            'website' => $this->request->getPost('website'),
            'latitude' => $this->request->getPost('latitude'),
            'longitude' => $this->request->getPost('longitude')
        ]);
        session()->setFlashdata('pesan', 'Cập nhật dữ liệu thành công');
        return redirect()->to(base_url('form/datasekolah'));
        d($this->request->getPost());
    }
}
