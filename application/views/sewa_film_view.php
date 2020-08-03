<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="modal fade modal-wide product_view" id="product_view" data-backdrop="static" data-keyboard="false">
    <div class="col-lg-pull-1 modal-dialog">
        <div class="col-lg-pull-1 modal-content">
            <div class="modal-header">
                <a href="#" data-dismiss="modal" class="class pull-top">
                    <span class="glyphicon glyphicon-remove"></span></a>
                        <h3 class="modal-title"><?php echo $movies['nama_film']; ?></h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 product_img">
                        <?
                        $image_folder = base_url() . "assets/images/" . strtolower($nama_film); ?>
                        <img src="<?php echo $image_folder; ?>/1.jpg" class="img-responsive">
                        <p>
                            <img src="<?php echo $image_folder; ?>/2.jpg" class="small-images" />
                            <img src="<?php echo $image_folder; ?>/3.jpg" class="small-images" />
                            <img src="<?php echo $image_folder; ?>/4.jpg" class="small-images" />
                        </p>
                    </div>
                    <div class="col-md-6 product_content">
                        <div class="rating">
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            <span class="glyphicon glyphicon-star"></span>
                            (10 reviews)
                        </div>
                        <p class="specs">
                            <span>Genre </span> <?php echo $movies['genre']; ?>
                        </p>
                        <p class="specs">
                            <span>Actor </span> <?php echo $movies['actor']; ?>
                        </p>
                        <p class="specs">
                            <span>Deskripsi </span> <?php echo $movies['deskripsi']; ?>
                        </p>
                        <hr />
                        <h3 class="cost">Rp. <?php echo $movies['harga_sewa']; ?>/hari</h3>
                        <hr />
                        <div class="row">
                            <form id="select-date" method="post" role="form" action="<?php echo base_url(). 'rincian'; ?>">
                                <div class="col-xs-12">
                                    <label for="date_from">Nama Penyewa </label>
                                    <input id="nama_penyewa" name="nama_penyewa" type="text">
                                </div>
                                <div class="col-xs-12">
                                    <label for="date_from">No. Rekening </label>
                                    <input id="nomor_rekening" name="nomor_rekening" type="text" minlength="10" maxlength="16">
                                </div>
                                <div class="col-xs-12">
                                    <label for="date_from">Dari tanggal </label>
                                    <input type="hidden" value="<?php echo $film_id; ?>" name="film_id" />
                                    <input type="hidden" value="<?php echo $movies['harga_sewa']; ?>" name="harga_sewa" />
                                    <input id="date_from" name="date_from" type="date" value="<?php echo $date_from; ?>">
                                </div>
                                <div class="col-xs-12">
                                    <label for="date_to">Selesai tanggal </label>
                                    <input id="date_to" name="date_to" type="date" value="<?php echo $date_to; ?>">
                                </div>
                                <div class="col-xs-12">
                                    <label for="add_to_cart"></label>
                                    <input type="submit" name="add_to_cart" id="add_to_cart" class="btn btn-primary" value="Sewa Film" />
                                </div>
                                <div class="col-xs-12">
                                    <label for="add_to_cart"></label>
                                    <a href="http://localhost/film/sewa_film/"><span>Kembali</span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $('#product_view').modal('show');
</script>