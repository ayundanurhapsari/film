<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <form method="POST" action="<?php echo base_url(). 'Rincian/add';?>" class="form-horizontal">
    <div class="row">
        <div class="col-sm-12 col-md-10 col-md-offset-1">
            <?php
            // Jika tidak ada film yang dipilih
            if ($_SESSION['total_sewa'] == 0) {
                ?>
                            <h1>Tidak ada film yang dipilih</h1>

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
                  $cost_wo_tax = number_format($_SESSION['total_sewa'], 2, '.', '');
                  $tax         = number_format( ((float)$cost_wo_tax * 0.07), 2, '.', '');
                  $cost_w_tax  = number_format(((float)$cost_wo_tax + (float)$tax), 2, '.', '');

                  foreach($_SESSION['sewa_items'] as $film_id => $sewa_item) {
                    $year       = $sewa_item['movie_details']['year'];
                    $nama_film  = $sewa_item['movie_details']['nama_film'];
                    $genre      = $sewa_item['movie_details']['genre'];
                    $harga_sewa = $sewa_item['movie_details']['harga_sewa'];
                    $total_cost = $sewa_item['total'];
                    $date_from  = $sewa_item['date_from'];
                    $date_to    = $sewa_item['date_to'];
                    $days       = $sewa_item['days'];

                    $image_folder = base_url() . "assets/images/" . strtolower($nama_film);
                    ?>
                    <tr>
                        <td class="col-sm-8 col-md-6">
                            <div class="media">
                                <a class="thumbnail pull-left small-images" href="<?php echo base_url() . "sewa_film/process_search/" . $film_id; ?>"> <img class="media-object" src="<?php echo $image_folder; ?>/1.jpg"> </a>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="<?php echo base_url() . "sewa_film/process_search/" . $film_id; ?>">
                                            <?php echo $nama_film; ?>
                                        </a>
                                    </h4><br>

                                    <span class="cart-date">Nama: </span><span class="text-primary"><strong></strong></span><br />
                                    <span class="cart-date">No Rekening: </span><span class="text-primary"><strong></strong></span><br />
                                    <span class="cart-date">Tgl Mulai: </span><span class="text-primary"><strong><?php echo $date_from; ?></strong></span><br />
                                    <span class="cart-date">Tgl Selesai:   </span><span class="text-primary"><strong><?php echo $date_to; ?></strong></span>
                                </div>
                            </div></td>
                            <td class="col-sm-1 col-md-1" style="text-align: center">
                                <?php echo $days; ?>
                            </td>
                            <td class="col-sm-1 col-md-1 text-center"><strong>Rp <?php echo $harga_sewa; ?></strong></td>
                            <td class="col-sm-1 col-md-1 text-center"><strong>Rp <?php echo $total_cost; ?></strong></td>
                            <td class="col-sm-1 col-md-1">
                                <a href="<?php echo base_url(); ?>rincian/remove/<?php echo $film_id; ?>">
                                    <button type="button" class="btn btn-danger">
                                        <span class="glyphicon glyphicon-remove"></span> Hapus
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
                        <h5><strong>Rp <?php echo $cost_wo_tax; ?></strong></h5><h5 style="margin-right: 0;"></h5></td>
                </tr>
                <tr>
                    <td>   </td>
                    <td>   </td>
                    <td>   </td>
                    <td>
                        <a href="<?php echo base_url() . "sewa_film"; ?>">
                            <button type="button" class="btn btn-default">
                                <span class="glyphicon glyphicon-shopping-cart"></span> Sewa lagi
                            </button>
                        </a>
                        <button type="submit" class="btn btn-warning btn-md">Simpan</button>
                    </td>
                    <td>
                        <a href=https://api.whatsapp.com/send?phone=6282143638069&text=Hallo,%20nama%20saya%20,%20saya%20ingin%20menyewa%20%3A%0A1.%20Judul%20film%20%3A%20%0A2.%20Nomor%20rekening%20%3A%20%0A3.%20Periode%20sewa%20%3A%20%20sampai%20%0A4.%20Total%20harga%20%20sewa%20%3A%20Rp.%0A class="btn btn-success btn-md">Kirim Nota</a>
                    </td>
                    <td>
                        <form action="<?php echo base_url('sewa/redirectLaporan'); ?>" method="POST">
                          <input type="hidden" name="pdf" id="pdf">
                            <div class="form-group pull-right">
                              <a href="<?php echo base_url('Laporanpdf'); ?>" class="btn btn-warning btn-md" >Export PDF</a>
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