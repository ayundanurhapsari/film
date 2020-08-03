<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <form method="POST" action="<?php echo base_url(). 'rincian/add';?>" class="form-horizontal">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <?php
            // Jika tidak ada film yang dipilih
            if ($_SESSION['total_sewa'] == 0) {
                ?>
                            <h1>Tidak ada film yang dipilih</h1>
                            <div class="col-xs-12">
                                <a href="http://localhost/film/sewa_film" class="btn btn-danger">Back</a>
                            </div>
                            
                            <?php
                                if ( isset($error)) {
                                    echo "<h3>" . $error . "</h3><hr />";
                                }
                            ?>
                        </div>
                    </div>
                </div>

                <?php
                    return;
                    }
                ?>

            <h1>Rincian Sewa</h1><br><br>

            <?php
                if ( isset($error) ) {
                    echo "<h3>" . $error . "</h3><hr />";
                }
            ?>

            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="text-center">Sewa Film</th>
                        <th class="text-center">Hari</th>
                        <th class="text-center">Harga</th>
                        <th class="text-center">Total</th>
                        <th> </th>
                    </tr>
                </thead>

                <tbody>
                <?php
                  $total_akhir = number_format($_SESSION['total_sewa'], 2, '.', '');

                  foreach($_SESSION['sewa_items'] as $film_id => $sewa_item) {
                    $year           = $sewa_item['movie_details']['year'];
                    $nama_film      = $sewa_item['movie_details']['nama_film'];
                    $genre          = $sewa_item['movie_details']['genre'];
                    $actor          = $sewa_item['movie_details']['actor'];
                    $harga_sewa     = $sewa_item['movie_details']['harga_sewa'];
                    $total_cost     = $sewa_item['total'];
                    $nama_penyewa   = $sewa_item['nama_penyewa'];
                    $nomor_rekening = $sewa_item['nomor_rekening'];
                    $date_from      = $sewa_item['date_from'];
                    $date_to        = $sewa_item['date_to'];
                    $days           = $sewa_item['days'];

                    $image_folder = base_url() . "assets/images/" . strtolower($nama_film);
                ?>
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left small-images" href="<?php echo base_url() . "rincian_view/process_search/" . $film_id; ?>"> <img class="media-object" src="<?php echo $image_folder; ?>/1.jpg"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="<?php echo base_url() . "rincian_view/process_search/" . $film_id; ?>">
                                            <?php echo $nama_film; ?>
                                        </a>
                                    </h4><br>

                                    <input type="hidden" id="film_id" name="film_id" class="text-primary" value="<?php echo $film_id; ?>">
                                    <input type="hidden" id="subtotal" name="subtotal" class="text-primary" value="<?php echo $total_cost; ?>">
                                    <div class="cart-text">Nama: </div>
                                        <div><input type="hidden" id="nama_penyewa" name="nama_penyewa" class="text-primary" value="<?php echo $nama_penyewa; ?>">
                                            <strong><?php echo $nama_penyewa; ?></strong>
                                        </div><br />
                                    <div class="cart-text">No Rekening: </div>
                                        <div><input type="hidden" id="nomor_rekening" name="nomor_rekening" class="text-primary" value="<?php echo $nomor_rekening; ?>">
                                            <strong><?php echo $nomor_rekening; ?></strong>
                                        </div><br />
                                    <div class="cart-date">Tgl Mulai: 
                                        <input type="hidden" id="tgl_mulai" name="tgl_mulai" class="text-primary" value="<?php echo $date_from; ?>">
                                            <strong><?php echo $date_from; ?></strong>
                                    </div>
                                    <div class="cart-date">Tgl Selesai:   
                                        <input type="hidden" id="tgl_selesai" name="tgl_selesai" class="text-primary" value="<?php echo $date_to; ?>">
                                            <strong><?php echo $date_to; ?></strong>
                                    </div>
                                </div>
                            </div>
                        </td>

                            <td class="col-sm-1 col-md-1" style="text-align: center">
                                <?php echo $days; ?>
                            </td>
                            <td class="col-sm-1 col-md-1 text-center"><strong>Rp <?php echo $harga_sewa; ?></strong></td>
                            <td class="col-sm-1 col-md-1 text-center"><strong>Rp <?php echo $total_cost; ?></strong></td>
                            <td class="col-sm-1 col-md-1">
                                <a href="<?php echo base_url(); ?>rincian/remove/<?php echo $film_id; ?>">
                                    <button type="button" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-trash"></span> Hapus
                                    </button></td>
                                </a>
                    </tr>
                    <?php
                      }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td><h5>Subtotal</td>
                    <td class="text-right">
                        <h5><strong>Rp <?php echo $total_akhir; ?></strong></h5><h5 style="margin-right: 0;"></h5></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <button type="submit" class="btn btn-info btn-md pull-left" onClick="set_input">
                            <span class="glyphicon glyphicon-saved"> Checkout</span>
                        </button>
                    </td>
                    <td>
                        <a href="<?php echo base_url('rincian/whatsapp'); ?>" class="btn btn-success btn-md pull-left"> <span class="glyphicon glyphicon-envelope"> Kirim Nota</span></a>
                    </td>
                    <td>
                        <form action="<?php echo base_url('laporanpdf'); ?>" method="POST">
                          <input type="hidden" name="pdf" id="pdf">
                            <div class="form-group pull-left">
                              <a href="<?php echo base_url('Laporanpdf'); ?>" class="btn btn-warning btn-md">
                                <span class="glyphicon glyphicon-list-alt"> Cetak Nota</span></a>
                            </div>
                        </form>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</form>
</div>

<script type="text/javascript">
    function set_input(id_sewa, film_id, nama_penyewa, nomor_rekening, tgl_mulai, tgl_selesai, subtotal) {
        document.getElementById('id_sewa').value        = id_sewa;
        document.getElementById('film_id').value        = film_id;
        document.getElementById('nama_penyewa').value   = nama_penyewa;
        document.getElementById('nomor_rekening').value = nomor_rekening;
        document.getElementById('tgl_mulai').value      = tgl_mulai;
        document.getElementById('tgl_selesai').value    = tgl_selesai;
        document.getElementById('subtotal').value       = subtotal;
    }
</script>
