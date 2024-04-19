<main class="flex-shrink-0">
  <style>
    .card-img-top{
      height: 300px;
    }
    .card{
      height: 500px;
    }
    .card-body{
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
                <img src="<?= $musician->image ?>" class="card-img-top" alt="Musician Image">
                <div class="card-body">
                  <h5 class="card-title"><?= $musician->name ?></h5>
                  <p class="card-text"><?= $musician->description ?></p>
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                      <a href="<?= base_url('musician/profile/' . $musician->id) ?>"
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