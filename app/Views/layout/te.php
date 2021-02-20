<?= $this->extend('layout/backend/template') ?>
<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h4 class="m-0">Dashboard</h4>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Layout</a></li>
                        <li class="breadcrumb-item active">Top Navigation</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <!-- /.col-md-6 -->
                <div class="col">
                    <div class="card card-primary card-outline">
                        <!-- <div class="card-header">
							<h5 class="card-title m-0">Featured</h5>
						</div> -->
                    </div>
                    <form action="/home/saveinsiden" method="POST" enctype="multipart/form-data">
                        <?= csrf_field() ?>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="path_foto">Foto</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input gambar <?= $validation->hasError('path_foto') ? 'is-invalid' : '' ?>" id="path_foto" name="path_foto" onchange="previewimg()" value="<?= old('path_foto') ?>">
                                        <label class=" custom-file-label" for="path_foto">Choose file</label>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('path_foto') ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <img src="/img/default.jpg" class="img-thumbnail img-preview">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="">Deskripsi</label>
                                <input type="text" class="form-control <?= $validation->hasError('deskripsi') ? 'is-invalid' : '' ?>" rows="3" id=" deskripsi" name="deskripsi" placeholder="Deskripsi" value="<?= old('deskripsi') ?>">
                                <div class="invalid-feedback">
                                    <?= $validation->getError('deskripsi') ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Lokasi Insiden</label>
                                <select type="text" class="form-control select2 <?= $validation->hasError('fungsi_id') ? 'is-invalid' : '' ?>" id="fungsi_id" name="fungsi_id" placeholder="Fungsi" value="<?= old('fungsi_id') ?>"></select>
                            </div>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                        <!-- /.card-body -->
                    </form>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<script type="text/javascript">
    function previewimg() {
        const path_foto = document.querySelector('#path_foto');
        const path_fotoLabel = document.querySelector('.gambar');
        const imgpreview = document.querySelector('.img-preview');

        path_fotoLabel.textContent = path_foto.files[0].name;
        const filepath_foto = new FileReader();
        filepath_foto.readAsDataURL(path_foto.files[0]);

        filepath_foto.onload = function(e) {
            imgpreview.src = e.target.result;
        }
    }
    $(function() {
        bsCustomFileInput.init();
    });
    //Initialize Select2 Elements
    $('.select2').select2({
        theme: 'bootstrap4'
    })
    $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 5000
        });
        <?php if (session()->getFlashData('suksesinput')) : ?>
            Toast.fire({
                icon: 'success',
                title: 'Data Berhasil diinput'
            })
        <?php endif; ?>
        <?php if (session()->getFlashData('ubahdata')) : ?>
            Toast.fire({
                icon: 'warning',
                title: 'Data Berhasil diubah'
            })
        <?php endif; ?>
        <?php if (session()->getFlashData('gagal')) : ?>
            Toast.fire({
                icon: 'warning',
                title: 'Gagal Input'
            })
        <?php endif; ?>
    });
    init_select()

    function init_select() {
        let dropdown_fungsi = $('#fungsi_id');
        dropdown_fungsi.empty();
        dropdown_fungsi.append('<option value="">Pilih fungsi</option>');
        dropdown_fungsi.prop('selectedIndex', 0);
        const url_fungsi = '<?= base_url('home/getfungsi/') ?>';
        // Populate dropdown with list
        $.getJSON(url_fungsi, function(data) {
            $.each(data, function(key, entry) {
                dropdown_fungsi.append($('<option></option>').attr('value', entry.id_fungsi).text(entry.nama_fungsi));
            })
        });
    }
</script>
<?= $this->endsection() ?>
<?= $this->section('css') ?>
<!-- SweetAlert2 -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/backend/tambahan/sweetalert2/dist/sweetalert2.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/backend/plugins/select2/css/select2.min.css">
<link rel="stylesheet" href="<?= base_url(''); ?>/assets/backend/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<!-- SweetAlert2 -->
<script src="<?= base_url(''); ?>/assets/backend/tambahan/sweetalert2/dist/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url(''); ?>/assets/backend/plugins/select2/js/select2.full.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?= base_url(''); ?>/assets/backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<?= $this->endSection() ?>