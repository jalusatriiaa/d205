<?php

namespace App\Controllers;
use App\Models\BerkasModel;

class Berkas extends BaseController
{
    public function index(){
        echo "halo";
    }

    public function upload()
    {
        if (!$this->validate([
			'berkas' => [
				'rules' => 'uploaded[berkas]|mime_in[berkas,application/pdf, application/docx, application/doc]|max_size[berkas,10000]',
				'errors' => [
					'uploaded' => 'Harus Ada File yang diupload',
					'mime_in' => 'File Extention Harus Berupa pdf/docx !',
					'max_size' => 'Ukuran File Maksimal 10 MB'
				]
 
			]
		])) {
			session()->setFlashdata('error', $this->validator->listErrors());
			return redirect()->back()->withInput();
		}
 
		$berkas = new BerkasModel();

		$suratTugas = $this->request->getFile('surat_tugas');
        // $km = $this->request->getFile('km');
        // $laporan = $this->request->getFile('laporan');

		$suratTugasName = $suratTugas->getRandomName();
        // $kmName = $km->getRandomName();
        // $laporanName = $laporan->getRandomName();

		$berkas->insert([
			'file_st' => $suratTugasName
		]);

		$suratTugas->move('uploads/berkas/', $suratTugasName);
		session()->setFlashdata('success', 'Berkas Berhasil diupload');
		return redirect()->to(base_url());
    }

}
