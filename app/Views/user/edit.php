<main class="flex-shrink-0">
    <?= form_open('user/edit', ['enctype' => 'multipart/form-data']) ?>
    <div class="container main">
        <style>
            form {
                padding-top: 20px;
            }
            .text{
                width: 50%;
            }

            .main{
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
                <div class="circle-photo">
                    <!-- Apply esc() to the image source -->
                    <img src="<?= esc($image) ?>" alt="Profile Photo">
                </div>
                <div>
                    <label for="userfile" class="form-label">Photo of your band</label>
                    <input class="form-control" type="file" name="userfile" id="formFile" accept="image/*">
                </div>
                <div>
                    <label for="name">Name of the band</label>
                    <!-- Apply esc() to the input value -->
                    <input type="text" class="form-control" id="validationDefault01" placeholder="Band"
                        value="<?= esc($name) ?>" name="name" required>
                </div>
                <div>
                    <label for="email">E-mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend2">@</span>
                        </div>
                        <!-- Apply esc() to the input value -->
                        <input type="text" class="form-control" id="validationDefaultUsername" placeholder="E-mail"
                            aria-describedby="inputGroupPrepend2" name="email" value="<?= esc($email) ?>" required>
                    </div>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="validationDefault02" placeholder="Password"
                        name="password" required>
                </div>
            </div>
            <div class="form-row text">
                <div>
                    <label for="description" class="form-label">Description</label>
                    <!-- Apply esc() to the textarea value -->
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"
                        name="description"><?= esc($description) ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck2" required>
                    <label class="form-check-label" for="invalidCheck2">
                        Agree to terms and conditions
                    </label>
                </div>
            </div>
            <button class="btn btn-primary" type="submit">Submit edit</button>
        </form>
    </div>
    </form>
    <script>
        document.getElementById('imageInput').addEventListener('change', function (e) {
            var file = e.target.files[0];
            if (!file) return;

            var img = document.createElement('img');
            var reader = new FileReader();
            reader.onload = function (e) {
                img.src = e.target.result;

                img.onload = function () {
                    var canvas = document.createElement('canvas');
                    var ctx = canvas.getContext('2d');
                    var MAX_WIDTH = 200;
                    var MAX_HEIGHT = 200;
                    var width = img.width;
                    var height = img.height;

                    if (width > height) {
                        if (width > MAX_WIDTH) {
                            height *= MAX_WIDTH / width;
                            width = MAX_WIDTH;
                        }
                    } else {
                        if (height > MAX_HEIGHT) {
                            width *= MAX_HEIGHT / height;
                            height = MAX_HEIGHT;
                        }
                    }
                    canvas.width = width;
                    canvas.height = height;
                    ctx.drawImage(img, 0, 0, width, height);

                    canvas.toBlob(function (blob) {
                        var resizedFile = new File([blob], file.name, {
                            type: 'image/jpeg',
                            lastModified: Date.now()
                        });
                        var newFileInput = document.createElement('input');
                        newFileInput.type = 'file';
                        newFileInput.files = [resizedFile];
                        newFileInput.name = 'userfile';
                        document.getElementById('imageInput').parentNode.replaceChild(newFileInput, document.getElementById('imageInput'));
                    }, 'image/jpeg', 0.8);
                }
            };
            reader.readAsDataURL(file);
        });
    </script>
</main>