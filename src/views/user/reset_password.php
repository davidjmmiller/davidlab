<form action="/<?php echo $current_path;?>" method="post">
    <input type="hidden" name="key" value="<?php echo (isset($_GET['key'])?$_GET['key'] : $_POST['key']); ?>" />
    <fieldset>
        <legend>Password reset</legend>
        <div class="form-group <?php if (isset($errors['password'])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="password">Password</label>
            <input id="password" class="form-control" name="password" type="password" size="20" maxlength="20" placeholder="New Password...">
            <?php if (isset($errors['password'])): ?>
                <span id="helpBlock1" class="help-block"><?php echo implode(', ',$errors['password']);?> </span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php if (isset($errors['password_confirmation'])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="password_confirmation">Password Confirm</label>
            <input id="password_confirmation" class="form-control" name="password_confirmation" type="password" size="20" maxlength="20" placeholder="Confirmation...">
            <?php if (isset($errors['password_confirmation'])): ?>
                <span id="helpBlock1" class="help-block"><?php echo implode(', ',$errors['password_confirmation']);?></span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Send</button>
        </div>
    </fieldset>
</form>