<?php

class PengaduanModel {
	
	private $table = 'pengaduan';
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getAllPengaduan()
	{
		$this->db->query("SELECT pengaduan.*, kategori.nama_kategori FROM " . $this->table . " JOIN kategori ON kategori.id = pengaduan.kategori_id");
		return $this->db->resultSet();
	}

	public function getPengaduanById($id)
	{
		$this->db->query('SELECT * FROM ' . $this->table . ' WHERE id=:id');
		$this->db->bind('id',$id);
		return $this->db->single();
	}

	public function tambahPengaduan($data)
	{
		$query = "INSERT INTO pengaduan (nama_pengadu, tempat_tinggal, kategori_id, isi_pengaduan, tindak_lanjut) VALUES(:nama_pengadu, :tempat_tinggal, :kategori_id, :isi_pengaduan, :tindak_lanjut)";
		$this->db->query($query);
		$this->db->bind('nama_pengadu', $data['nama_pengadu']);
		$this->db->bind('tempat_tinggal', $data['tempat_tinggal']);
		$this->db->bind('kategori_id', $data['kategori_id']);
		$this->db->bind('isi_pengaduan', $data['isi_pengaduan']);
		$this->db->bind('tindak_lanjut', $data['tindak_lanjut']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function updateDataPengaduan($data)
	{
		$query = "UPDATE pengaduan SET nama_pengadu=:nama_pengadu, tempat_tinggal=:tempat_tinggal, kategori_id=:kategori_id, isi_pengaduan=:isi_pengaduan, tindak_lanjut=:tindak_lanjut WHERE id=:id";
		$this->db->query($query);
		$this->db->bind('id',$data['id']);
		$this->db->bind('nama_pengadu', $data['nama_pengadu']);
		$this->db->bind('tempat_tinggal', $data['tempat_tinggal']);
		$this->db->bind('kategori_id', $data['kategori_id']);
		$this->db->bind('isi_pengaduan', $data['isi_pengaduan']);
		$this->db->bind('tindak_lanjut', $data['tindak_lanjut']);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function deletePengaduan($id)
	{
		$this->db->query('DELETE FROM ' . $this->table . ' WHERE id=:id');
		$this->db->bind('id',$id);
		$this->db->execute();

		return $this->db->rowCount();
	}

	public function cariPengaduan()
	{
		$key = $_POST['key'];
		$this->db->query("SELECT * FROM " . $this->table . " WHERE nama_pengadu LIKE :key");
		$this->db->bind('key',"%$key%");
		return $this->db->resultSet();
	}
}