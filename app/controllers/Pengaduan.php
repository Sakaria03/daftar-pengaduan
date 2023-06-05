<?php

class Pengaduan extends Controller {
	
	public function __construct()
	{	
		if($_SESSION['session_login'] != 'sudah_login') {
			Flasher::setMessage('Login','Tidak ditemukan.','danger');
			header('location: '. base_url . '/login');
			exit;
		}
	}
	
	public function index()
	{
		$data['title'] = 'Data Pengaduan';
		$data['pengaduan'] = $this->model('PengaduanModel')->getAllPengaduan();
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('pengaduan/index', $data);
		$this->view('templates/footer');
	}
	public function lihatlaporan()
	{
		$data['title'] = 'Data Laporan Pengaduan';
		$data['pengaduan'] = $this->model('PengaduanModel')->getAllPengaduan();
		$this->view('pengaduan/lihatlaporan', $data);
	}

	public function laporan()
	{
		$data['pengaduan'] = $this->model('PengaduanModel')->getAllPengaduan();

			$pdf = new FPDF('p','mm','A4');
			// membuat halaman baru
			$pdf->AddPage();
			// setting jenis font yang akan digunakan
			$pdf->SetFont('Arial','B',14);
			// mencetak string 
			$pdf->Cell(190,7,'LAPORAN PENGADUAN',0,1,'C');
			 
			// Memberikan space kebawah agar tidak terlalu rapat
			$pdf->Cell(10,7,'',0,1);
			 
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(85,6,'JUDUL',1);
			$pdf->Cell(30,6,'PENERBIT',1);
			$pdf->Cell(30,6,'PENGARANG',1);
			$pdf->Cell(15,6,'TAHUN',1);
			$pdf->Cell(25,6,'KATEGORI',1);
			  $pdf->Ln();
			$pdf->SetFont('Arial','',10);
			 
			foreach($data['buku'] as $row) {
			    $pdf->Cell(85,6,$row['judul'],1);
			    $pdf->Cell(30,6,$row['penerbit'],1);
			    $pdf->Cell(30,6,$row['pengarang'],1);
			    $pdf->Cell(15,6,$row['tahun'],1); 
			    $pdf->Cell(25,6,$row['nama_kategori'],1);
			    $pdf->Ln(); 
			}
			
			$pdf->Output('D', 'Laporan Buku.pdf', true);

	}
	public function cari()
	{
		$data['title'] = 'Data Pengaduan';
		$data['pengaduan'] = $this->model('PengaduanModel')->cariPengaduan();
		$data['key'] = $_POST['key'];
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('pengaduan/index', $data);
		$this->view('templates/footer');
	}

	public function edit($id){

		$data['title'] = 'Detail Pengaduan';
		$data['kategori'] = $this->model('KategoriModel')->getAllKategori();
		$data['pengaduan'] = $this->model('PengaduanModel')->getPengaduanById($id);
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('pengaduan/edit', $data);
		$this->view('templates/footer');
	}

	public function tambah(){
		$data['title'] = 'Tambah Pengaduan';		
		$data['kategori'] = $this->model('KategoriModel')->getAllKategori();		
		$this->view('templates/header', $data);
		$this->view('templates/sidebar', $data);
		$this->view('pengaduan/create', $data);
		$this->view('templates/footer');
	}

	public function simpanPengaduan(){		

		if( $this->model('PengaduanModel')->tambahPengaduan($_POST) > 0 ) {
			Flasher::setMessage('Berhasil','ditambahkan','success');
			header('location: '. base_url . '/pengaduan');
			exit;			
		}else{
			Flasher::setMessage('Gagal','ditambahkan','danger');
			header('location: '. base_url . '/pengaduan');
			exit;	
		}
	}

	public function updatePengaduan(){	
		if( $this->model('PengaduanModel')->updateDataPengaduan($_POST) > 0 ) {
			Flasher::setMessage('Berhasil','diupdate','success');
			header('location: '. base_url . '/pengaduan');
			exit;			
		}else{
			Flasher::setMessage('Gagal','diupdate','danger');
			header('location: '. base_url . '/pengaduan');
			exit;	
		}
	}

	public function hapus($id){
		if( $this->model('PengaduanModel')->deletePengaduan($id) > 0 ) {
			Flasher::setMessage('Berhasil','dihapus','success');
			header('location: '. base_url . '/pengaduan');
			exit;			
		}else{
			Flasher::setMessage('Gagal','dihapus','danger');
			header('location: '. base_url . '/pengaduan');
			exit;	
		}
	}
}