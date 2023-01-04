<?= $this->extend('layout/default') ?>

<?= $this->section('content') ?>
<section class="section">
          <div class="section-header">
            <h1>Buku Saku Panduan</h1>
          </div>

          <div class="section-body d-flex justify-content-center">
          <iframe src="<?=base_url('bukusaku.pdf')?>" width="540" height="810"></iframe>
          </div>
        </section>
<?= $this->endSection() ?>