<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-fluid">
    <div class="row">
        <?php
            foreach($movies as $movie) {
                $image_folder = base_url() . "assets/images/" . strtolower($movie['nama_film']);
        ?>

        <figure class="individual-vehicle">
            <img src="<?php echo $image_folder; ?>/1.jpg" alt="<?php echo $movie['nama_film']; ?>" />
                <figcaption>
                    <h3><?php echo $movie['nama_film']; ?></h3>
                    <p><?php echo $movie['genre']; ?></p>
                    <div class="price">Rp <?php echo $movie['harga_sewa'] ?>
                    </div>
                </figcaption> 
                <i class="ion-plus-round"></i>

                <a href="<?php echo base_url(); ?>sewa_film/process_search/<?php echo $movie['id']; ?>"></a>
        </figure>

        <?php
          }
        ?>

    </div>
</div>