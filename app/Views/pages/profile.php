<style>
    .circle-photo {
        width: 300px;
        height: 300px;
        border-radius: 50%;
        overflow: hidden;
        margin-right: 20px;
        margin-left: 10px;
        float: left;
        border: 4px solid black;
        margin-top: -150px;
        position: relative;
        z-index: 1;
    }

    .circle-photo img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .edit {
        text-decoration: none;
        color: whitesmoke;
    }

    .edit-button {
        margin-right: 10px;

    }

    .buttons {
        margin-top: 10px;
        margin-left: 60px;
    }

    .clas {
        display: flex;
        flex-direction: column;
    }

    .all-info {
        display: flex;

    }

    .bi {
        font-size: 30px;
    }
</style>

<div class="card text-bg-dark">
    <img src="https://i.pinimg.com/originals/c6/9f/c8/c69fc85e56563e6ded204f8da3cbf110.jpg" class="card-img"
        alt="beauty notes" height="250px">
    <div class="card-img-overlay">
        <!-- Apply esc() to the card title -->
        <h1 class="card-title" style="text-align: center;"> <?= esc($name) ?> </h1>
    </div>
</div>
<div class="all-info">
    <div class="clas">
        <div class="circle-photo">
            <!-- Apply esc() to the image source -->
            <img src="<?= esc($image) ?>" alt="Profile Photo">
        </div>
        <div class="buttons">
            <a href="https://www.youtube.com/"><button type="button" class="btn btn-outline-danger"><i
                        class="bi bi-youtube"></i></button></a>
            <a href="https://www.instagram.com/"><button type="button" class="btn btn-outline-warning"><i
                        class="bi bi-instagram"></i></button></a>
            <a href="https://open.spotify.com/"><button type="button" class="btn btn-outline-success"><i
                        class="bi bi-spotify"></i></button></a>
        </div>
    </div>
    <div>
        <h2><?= esc($name) ?></h2>
        <h5><?= esc($description) ?></h5>
    </div>
</div>
<div class="col text-center">
    <h3>Concerts:</h3>
</div>
<div class="container">
    <div class="row">
        <?php foreach ($concerts as $concert): ?>
            <div class="col-md-3">
                <div class="card mb-4 shadow-sm ">
                    <div class="card-body">
                        <!-- Use esc() to escape the musician name and description -->
                        <h5 class="card-title"><?= esc($concert->name) ?></h5>
                        <ul class="card-text">
                            <li><?= esc($concert->city) ?></li>
                            <li><?= esc($concert->concert_data) ?></li>
                        </ul>
                    </div>
                    <button type="button" class="btn btn-secondary buy-ticket-btn"
                        data-link="<?= esc($concert->link) ?>">Buy Ticket</button>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<script>
    // Add event listener to all buy ticket buttons
    document.querySelectorAll('.buy-ticket-btn').forEach(button => {
        button.addEventListener('click', function () {
            // Get the link from the button's data attribute
            const link = this.getAttribute('data-link');
            // Redirect to the link
            window.location.href = link;
        });
    });
</script>