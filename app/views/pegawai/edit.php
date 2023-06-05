  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Halaman Pengaduan</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
<div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title"><?= $data['title']; ?></h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="<?= base_url; ?>/pengaduan/updatePengaduan" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= $data['pengaduan']['id']; ?>">
                <div class="card-body">
                  <div class="form-group">
                    <label >Nama Pengadu</label>
                    <input type="text" class="form-control" placeholder="Masukkan nama pengadu..." name="nama_pengadu" value="<?= $data['pengaduan']['nama_pengadu'];?>">
                  </div>
                  <div class="form-group">
                    <label >Tempat Tinggal</label>
                    <input type="text" class="form-control" placeholder="Masukkan tempat tinggal..." name="tempat_tinggal" value="<?= $data['pengaduan']['tempat_tinggal'];?>">
                  </div>
                  <div class="form-group">
                    <label >Kategori Media</label>
                    <select class="form-control" name="kategori_id">
                        <option value="">Pilih</option>
                         <?php foreach ($data['kategori'] as $row) :?>
                        <option value="<?= $row['id']; ?>" <?php if($data['pengaduan']['kategori_id'] == $row['id']) { echo "selected"; } ?>><?= $row['nama_kategori']; ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label >Isi Pengaduan</label>
                    <input type="text" class="form-control" placeholder="Masukkan isi pengaduan..." name="isi_pengaduan" value="<?= $data['pengaduan']['isi_pengaduan'];?>">
                  </div>
                  <div class="form-group">
                    <label >Tindak Lanjut</label>
                    <input type="text" class="form-control" placeholder="Masukkan tindak lanjut..." name="tindak_lanjut" value="<?= $data['pengaduan']['tindak_lanjut'];?>">
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>


    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->