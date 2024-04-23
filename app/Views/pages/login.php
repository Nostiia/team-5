<main class="flex-shrink-0 form-signin">
    <?= form_open('user/login') ?>
        <div class="container">
            <style>
                form {padding-top: 20px;}
            </style>
            <form>
                <div class="form-group form-floating">
                    <input type="email" class="form-control" name="email" value="<?= esc($email ?? '') ?>">
                    <label for="email">Email address</label>
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group form-floating">
                    <input type="password" class="form-control" name="password" value="<?= esc($password ?? '') ?>">
                    <label for="password">Password</label>
                </div>
                <span class="error"><?= esc(\Config\Services::validation()->listErrors()) ?></span>
                <span class="error">
                    <?php if(session()->getFlashdata('msg')):?>
                        <div class="alert alert-danger"><?= esc(session()->getFlashdata('msg')) ?></div>
                    <?php endif;?>
                </span>
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
                <div>
                    <a href="<?= esc(base_url('user/SignUp')) ?>">Create new account</a>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </form>
</main>
