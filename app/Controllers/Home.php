<?php

namespace App\Controllers;

use App\Models\DataModel;

class Home extends BaseController
{
    public function index()
    {

        $Query = new DataModel();

        $jenjang = $this->request->getGet('jenjang');
        if ($jenjang) {
            $result = $Query->jenjangSekolah($jenjang);
            $title = "CSDL Hưng Yên";
        } else {
            $result = $Query->jenjangSekolah();
            $title = "CSDL Hưng Yên";
        }

        $data = [
            'appname' => "CSDL Hưng Yên",
            'title' => $title,
            'data' => $result,
            'sd' => $Query->countSekolah("SD"),
            'smp' => $Query->countSekolah("SMP"),
            'sma' => $Query->countSekolah("SMA"),
            'smk' => $Query->countSekolah("SMK")
        ];
        return view('v_home', $data);
    }

    public function detail($slug = "")
    {
        $Query = new DataModel();
        $Sekolah = $Query->getSekolah($slug);

        if (empty($Sekolah)) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Không tìm thấy trang');
        }

        $data = [
            'appname' => "CSDL Hưng Yên",
            'title' => $Sekolah['address'],
            'data' => $Sekolah,
            'sd' => $Query->countSekolah("SD"),
            'smp' => $Query->countSekolah("SMP"),
            'sma' => $Query->countSekolah("SMA"),
            'smk' => $Query->countSekolah("SMK")
        ];

        return view('v_detail', $data);
    }

    public function table()
    {
        $Query = new DataModel();
        $data = [
            'appname' => "CSDL Hưng Yên",
            'title' => "Dữ liệu trường đã đăng ký",
            'data' => $Query->findAll(),
            'sd' => $Query->countSekolah("SD"),
            'smp' => $Query->countSekolah("SMP"),
            'sma' => $Query->countSekolah("SMA"),
            'smk' => $Query->countSekolah("SMK")
        ];

        return view('v_table', $data);
    }
}
