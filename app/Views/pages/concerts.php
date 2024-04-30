<style>
    .circle-photo {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 20px;
        margin-left: 10px;
        float: left;
        border: 4px solid black;
    }

    .circle-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }
</style>
<main class="flex-shrink-0">
    <div class="container">
        <?php foreach ($concertsByMonth as $month => $concerts): ?>
            <div>
                <h2><?php echo $month; ?></h2>
                <?php foreach ($concerts as $concert): ?>
                    <div class="card mb-3" style="max-width: 90%;">
                        <div class="row g-0">
                            <div class="circle-photo">
                                <!-- Apply esc() to the image source -->
                                <img src="<?=esc($concert['image']) ?>" alt="Profile Photo">
                            </div>
                            <div class="col-md-6">
                                <div class="card-body">
                                    <h5 class="card-title"><?= esc($concert['name']) ?></h5>
                                    <h6><?= esc($concert['band']) ?></h6>
                                    <p class="card-text"><?= esc($concert['city']) ?></p>
                                    <p class="card-text"><?= esc($concert['concert_data']) ?></p>
                                    <button type="button" class="btn btn-secondary buy-ticket-btn"
                                        data-link="<?= esc($concert['link']) ?>">Buy Ticket</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>
</main>