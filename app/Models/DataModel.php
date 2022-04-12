<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $table = "tbl_sekolah";
    protected $primaryKey = 'id';
    protected $allowedFields = ['address', 'slug', 'industry', 'photo', 'description', 'status', 'website', 'latitude', 'longitude'];
    protected $useTimestamps = TRUE;

    public function getSekolah($slug = "")
    {
        if ($slug == false) {
            return $this->findAll();
        }
        return $this->where(['slug' => $slug])->first();
    }

    public function countSekolah($industry = "")
    {
        return $this->where(['industry' => $industry])->countAllResults();
    }

    public function cariSekolah($key)
    {
        return $this->like(['address' => $key]);
    }

    public function jenjangSekolah($industry = "")
    {
        if ($industry == false) {
            return $this->findAll();
        }
        return $this->where(['industry' => $industry])->get()->getResultArray();
    }
}
