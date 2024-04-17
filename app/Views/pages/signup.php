<main class="flex-shrink-0">
    <?= form_open('user/signup') ?>
    <div class="container">
        <style>
            form {padding-top: 20px;}
        </style>
        <form>
            <div class="form-row">
                <div class="col-md-4 mb-3">
                    <label for="name">Name of the band</label>
                    <input type="text" class="form-control" id="validationDefault01" placeholder="Band" name="name" required>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="email">E-mail</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupPrepend2">@</span>
                        </div>
                        <input type="text" class="form-control" id="validationDefaultUsername" placeholder="E-mail" aria-describedby="inputGroupPrepend2" name="email" required>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="password">Password</label>
                    <input type="text" class="form-control" id="validationDefault02" placeholder="Password" name="password" required>
                </div>
            </div>
            <div class="form-row">
                <div class="mb-3">
                    <label for="image" class="form-label">Photo of your band</label>
                    <input class="form-control" type="file" name="image" id="formFile">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
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
</main>
