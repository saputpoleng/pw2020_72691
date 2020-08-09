<?php

namespace App\Controllers;

use App\Models\OrangModel;

class Orang extends BaseController
{
    protected $OrangModel;
    public function __construct()
    {
        $this->OrangModel = new OrangModel();
    }

    public function index()
    {
        // $pager = \Config\Services::pager();
        $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;

        // d($this->request->getVar('keyword'));
        $keyword = $this->request->getVar('keyword');

        if ($keyword) {
            $orang = $this->OrangModel->search($keyword);
        } else {
            $orang = $this->OrangModel;
        }

        $data = [
            // 'orang' => $this->OrangModel->findAll(),
            'judul' => 'Daftar Orang | Roonisland',
            'orang' => $orang->paginate(10, 'orang'),
            'pager' => $orang->pager,
            'currentPage' => $currentPage
        ];
        return view('orang/index', $data);
    }
}
