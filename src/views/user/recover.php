<form action="/<?php echo $current_path;?>" method="post">
    <fieldset>
        <legend>Password reset</legend>
        <div class="form-group <?php if (isset($errors['username'])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="username">Email</label>
            <input id="username" class="form-control" name="username" value="<?php echo post('username');?>" type="email" size="20" maxlength="20" placeholder="Email">
            <?php if (isset($errors['username'])): ?>
            <span id="helpBlock1" class="help-block"><?php echo implode(', ',$errors['username']);?> </span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Send</button>
        </div>
    </fieldset>
</form>