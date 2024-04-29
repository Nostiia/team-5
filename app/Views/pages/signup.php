<main class="flex-shrink-0">
    <?= form_open('user/signup',['enctype' => 'multipart/form-data']) ?>
    <div class="container">
        <style>
            form {padding-top: 20px;}
        </style>
        <form>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="name">Name of the band</label>
                    <input type="text" class="form-control" id="validationDefault01" placeholder="Band" name="name" value="<?= esc($name ?? '') ?>" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="email">E-mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend2">@</span>
                        </div>
                        <input type="text" class="form-control" id="validationDefaultUsername" placeholder="E-mail" aria-describedby="inputGroupPrepend2" name="email" value="<?= esc($email ?? '') ?>" required>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="validationDefault02" placeholder="Password" name="password" value="<?= esc($password ?? '') ?>" required>
                </div>
            </div>
            <div class="form-row">
                <div class="mb-3">
                    <label for="userfile" class="form-label">Photo of your band</label>
                    <input class="form-control" type="file" name="userfile" id="formFile" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description" required><?= esc($description ?? '') ?></textarea>
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
            <button class="btn btn-primary" type="submit">Submit form</button>
        </form>
    </div>
    </form>
    <script>
    document.getElementById('imageInput').addEventListener('change', function(e) {
        var file = e.target.files[0];
        if (!file) return;

        var img = document.createElement('img');
        var reader = new FileReader();
        reader.onload = function(e) {
            img.src = e.target.result;

            img.onload = function() {
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

                canvas.toBlob(function(blob) {
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

