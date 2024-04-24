<main class="flex-shrink-0">
    <div class="card text-bg-dark">
        <img src="https://hthayat.haberturk.com/im/2019/07/02/ver1562225686/1071606_1920x1080.jpg" class="card-img"
            alt="beauty notes" height="250px">
        <div class="card-img-overlay">
            <h1 class="card-title" style="text-align: center; color: black;"> ADD CONCERT </h1>
        </div>
    </div>
    <?= form_open('user/add') ?>
    <div class="container main">
        <style>
            form {
                padding-top: 20px;
            }

            .text {
                width: 50%;
            }

            .main {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }

            .circle-photo {
                width: 300px;
                height: 300px;
                border-radius: 50%;
                overflow: hidden;
                margin-right: 20px;
                margin-left: 10px;
                border: 4px solid black;
            }

            .circle-photo img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center;
            }
        </style>
        <form>
            <div class="form-row">
                <div>
                    <label for="name">Slogan of this concert:</label>
                    <input type="text" class="form-control" id="validationDefault01" placeholder="name" name="name"
                        required>
                </div>
                <div>
                    <label for="name">City:</label>
                    <input type="text" class="form-control" id="validationDefault01" placeholder="city" name="city"
                        required>
                </div>
                <div>
                    <label for="concert_data" class="form-label">Concert Date</label>
                    <input type="date" class="form-control" id="concert_data" name="concert_data" required>
                </div>
                <div>
                    <label for="name">Link:</label>
                    <input type="text" class="form-control" id="validationDefault01" placeholder="link" name="link"
                        required>
                </div>
            </div>
            <div style="margin-top:10px;">
                <button class="btn btn-primary" type="submit">Add</button>
            </div>
        </form>
    </div>
</main>