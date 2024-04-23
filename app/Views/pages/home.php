<main class="flex-shrink-0">
  <style>
    .card-img-top {
      height: 300px;
    }

    .card {
      height: 500px;
    }

    .card-body {
      overflow: scroll;
    }
  </style>
  <div class="container">
    <div class="row">
      <!-- Loop through musician data and generate cards -->
      <div class="container">
        <div class="row">
          <?php foreach ($musicians as $musician): ?>
            <div class="col-md-4">
              <div class="card mb-4 shadow-sm ">
                <!-- Use esc() to escape the image source -->
                <img src="<?= esc($musician->image) ?>" class="card-img-top" alt="Musician Image">
                <div class="card-body">
                  <!-- Use esc() to escape the musician name and description -->
                  <h5 class="card-title"><?= esc($musician->name) ?></h5>
                  <p class="card-text"><?= esc($musician->description) ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <!-- Use esc() to escape the URL -->
                      <a href="<?= esc(base_url('musician/profile/' . $musician->id)) ?>"
                        class="btn btn-sm btn-outline-secondary">View Profile</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</main>
