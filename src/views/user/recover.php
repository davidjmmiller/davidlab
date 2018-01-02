<form action="/<?php echo $current_path;?>" method="post">
    <fieldset>
        <legend>User Login</legend>
        <div class="form-group <?php if (isset($errors['username'])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="username">Email</label>
            <input id="username" class="form-control" name="username" type="email" size="20" maxlength="20" placeholder="Email">
            <?php if (isset($errors['username'])): ?>
            <span id="helpBlock1" class="help-block"><?php echo implode(', ',$errors['username']);?> </span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php if (isset($errors['password'])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="password">Password</label>
            <input id="password" class="form-control" name="password" type="password" size="20" maxlength="20" placeholder="Password">
            <?php if (isset($errors['password'])): ?>
                <span id="helpBlock2" class="help-block"><?php echo implode(', ',$errors['password']);?> </span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Sign In</button>
        </div>
    </fieldset>
</form>