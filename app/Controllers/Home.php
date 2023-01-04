<?php

namespace App\Controllers;
use App\Models\PenugasanModel;
use App\Models\UsersModel;
use CodeIgniter\HTTP\Request;

class Home extends BaseController
{
    protected $penugasanModel;

    public function __construct()
    {
        $this->penugasanModel = new PenugasanModel();
    }

    public function index()
    {

        $currentPage = $this->request->getVar('page_penugasan') ? $this->request->getVar('page_penugasan') : 1;

        d($this->request->getVar('keyword'));

        $keyword = $this->request->getVar('keyword');
        if($keyword){
            $penugasan = $this->penugasanModel->search($keyword);
        }else{
            $penugasan = $this->penugasanModel;
        }

        $data = [
            'title' => 'Monitoring Penugasan',
            'penugasan' => $penugasan->paginate(10, 'penugasan'),
            'pager' => $this->penugasanModel->pager,
            'currentPage' => $currentPage
         ];

       
        return view('home.php', $data);
    }

    public function create()
    {

        $data = [
            'validation' => \Config\Services::validation()
        ];

        return view('create.php', $data);
    }

    public function save()
    {

        if (!$this->validate([
            'nama_penugasan' => 'required',
            'nomor_surat' => 'required',
            'tanggal_mulai' => 'required',
            'tanggal_selesai' => 'required',
            'tanggal_surat' => 'required',
			'file_st' => [
				'rules' => 'mime_in[file_st,application/pdf, application/docx, application/doc]|max_size[file_st,10000]',
				'errors' => [
					'uploaded' => 'Harus Ada File yang diupload',
					'mime_in' => 'File Extention Harus Berupa pdf/docx !',
					'max_size' => 'Ukuran File Maksimal 10 MB'
				]
 
                ],
            'file_km' => [
				'rules' => 'mime_in[file_km,application/pdf, application/docx, application/doc]|max_size[file_km,10000]',
				'errors' => [
					'uploaded' => 'Harus Ada File yang diupload',
					'mime_in' => 'File Extention Harus Berupa pdf/docx !',
					'max_size' => 'Ukuran File Maksimal 10 MB'
				]
 
			]
		])) {
            return redirect()->to('/home/create')->withInput();
			// session()->setFlashdata('pesan', $this->validator->listErrors());
		}

        $fileST = $this->request->getFile('file_st');
        $fileKM = $this->request->getFile('file_km');
        $namaST = $fileST->getRandomName();
        $namaKM = $fileKM->getRandomName();
        $fileST->move('upload/berkas', $namaST );
        $fileKM->move('upload/berkas', $namaKM);

        $this->penugasanModel->save([
            'nama_penugasan' => $this->request->getVar('nama_penugasan'),
            'nomor_surat' => $this->request->getVar('nomor_surat'),
            'tanggal_surat' => $this->request->getVar('tanggal_surat'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'file_st' => $namaST,
            'file_km' => $namaKM
        ]);

        session()->setFlashdata('pesan', 'Penugasan Berhasil Ditambahkan!');

        return redirect()->to('/home');

    }

    public function delete($id)
    {
        $this->penugasanModel->delete($id);
        session()->setFlashdata('pesan', 'Penugasan Berhasil Dihapus!');
        return redirect()->to('/home');
    }

    public function update($id)
    {
        // if (!$this->validate([
        //     'nama_penugasan' => 'required',
        //     'nomor_surat' => 'required',
        //     'tanggal_mulai' => 'required',
        //     'tanggal_selesai' => 'required',
		// 	'file_st' => [
		// 		'rules' => 'uploaded[file_st]|mime_in[file_st,application/pdf, application/docx, application/doc]|max_size[file_st,10000]',
		// 		'errors' => [
		// 			'uploaded' => 'Harus Ada File yang diupload',
		// 			'mime_in' => 'File Extention Harus Berupa pdf/docx !',
		// 			'max_size' => 'Ukuran File Maksimal 10 MB'
		// 		]
 
        //         ],
        //     'file_km' => [
		// 		'rules' => 'uploaded[file_km]|mime_in[file_km,application/pdf, application/docx, application/doc]|max_size[file_km,10000]',
		// 		'errors' => [
		// 			'uploaded' => 'Harus Ada File yang diupload',
		// 			'mime_in' => 'File Extention Harus Berupa pdf/docx !',
		// 			'max_size' => 'Ukuran File Maksimal 10 MB'
		// 		]
 
        //         ],
        //     'file_laporan' => [
		// 		'rules' => 'uploaded[file_laporan]|mime_in[file_laporan,application/pdf, application/docx, application/doc]|max_size[file_laporan,10000]',
		// 		'errors' => [
		// 			'uploaded' => 'Harus Ada File yang diupload',
		// 			'mime_in' => 'File Extention Harus Berupa pdf/docx !',
		// 			'max_size' => 'Ukuran File Maksimal 10 MB'
		// 		]
 
        //         ],    
		// ])) {
		// }
        
        // $updateFileST = $this->request->getFile('file_st');
        // $updateFileKM = $this->request->getFile('file_km');
        // $updateFileLaporan = $this->request->getFile('file_laporan');
        // $updateNamaST = $updateFileST->getRandomName();
        // $updateNamaKM = $updateFileKM->getRandomName();
        // $updateNamaLaporan = $updateFileLaporan->getRandomName();
        // $updateFileST->move('upload/berkas', $updateNamaST);
        // $updateFileKM->move('upload/berkas', $updateNamaKM);
        // $updateFileLaporan->move('upload/berkas', $updateNamaLaporan);

        $this->penugasanModel->save([
            'id_tugas' => $id,
            'nama_penugasan' => $this->request->getVar('nama'),
            'nomor_surat' => $this->request->getVar('nomor'),
            'tanggal_surat' => $this->request->getVar('tanggal_surat'),
            'tanggal_mulai' => $this->request->getVar('tanggal_mulai'),
            'tanggal_selesai' => $this->request->getVar('tanggal_selesai'),
            'status_laporan' => $this->request->getVar('status_laporan'),
            'nomor_laporan' => $this->request->getVar('nomor_laporan')
            // 'file_st' => $updateNamaST,
            // 'file_km' => $updateNamaKM,
            // 'file_laporan' => $updateNamaLaporan
        ]);

        session()->setFlashdata('pesan', 'Penugasan Berhasil Diubah!');

        return redirect()->to('/home');
    }

    public function download_st($id)
    {
        $berkasST = $this->penugasanModel->find($id);
        return $this->response->download('upload/berkas/'.$berkasST['file_st'], null);
    }

    public function download_km($id)
    {
        $berkasKM = $this->penugasanModel->find($id);
        return $this->response->download('upload/berkas/'.$berkasKM['file_km'], null);
    }
    public function download_laporan($id)
    {
        $berkasLaporan = $this->penugasanModel->find($id);
        return $this->response->download('upload/berkas/'.$berkasLaporan['file_laporan'], null);
    }

   
}
