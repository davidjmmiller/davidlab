<form action="/<?php echo $current_path;?>" method="post">
    <fieldset>
        <legend>Personal Information</legend>
        <?php
        $field = 'identification';
        $label = 'Identification';
        ;?>
        <div class="form-group <?php if (isset($errors[$field])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="<?php echo $field ?>"><?php echo $label;?></label>
            <input id="<?php echo $field ?>" class="form-control" name="<?php echo $field ?>" type="text" size="20" maxlength="20" placeholder="<?php echo $label;?>" value="<?php echo post($field);?>">
            <?php if (isset($errors[$field])): ?>
                <span id="helpBlock1" class="help-block"><?php echo implode(', ',$errors[$field]);?> </span>
            <?php endif; ?>
        </div>

        <?php
        $field = 'first_name';
        $label = 'First name';
        ;?>
        <div class="form-group <?php if (isset($errors[$field])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="<?php echo $field ?>"><?php echo $label;?></label>
            <input id="<?php echo $field ?>" class="form-control" name="<?php echo $field ?>" type="text" size="20" maxlength="20" placeholder="<?php echo $label;?>" value="<?php echo post($field);?>">
            <?php if (isset($errors[$field])): ?>
                <span id="helpBlock1" class="help-block"><?php echo implode(', ',$errors[$field]);?> </span>
            <?php endif; ?>
        </div>

        <?php
        $field = 'last_name';
        $label = 'Last name';
        ;?>
        <div class="form-group <?php if (isset($errors[$field])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="<?php echo $field ?>"><?php echo $label;?></label>
            <input id="<?php echo $field ?>" class="form-control" name="<?php echo $field ?>" type="text" size="20" maxlength="20" placeholder="<?php echo $label;?>" value="<?php echo post($field);?>">
            <?php if (isset($errors[$field])): ?>
                <span id="helpBlock1" class="help-block"><?php echo implode(', ',$errors[$field]);?> </span>
            <?php endif; ?>
        </div>

        <?php
        $field = 'country';
        $label = 'Country';
        ;?>
        <div class="form-group <?php if (isset($errors[$field])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="<?php echo $field ?>"><?php echo $label;?></label>
            <input id="<?php echo $field ?>" class="form-control" name="<?php echo $field ?>" type="text" size="20" maxlength="20" placeholder="<?php echo $label;?>" value="<?php echo post($field);?>">
            <?php if (isset($errors[$field])): ?>
                <span id="helpBlock1" class="help-block"><?php echo implode(', ',$errors[$field]);?> </span>
            <?php endif; ?>
        </div>

        <?php
        $field = 'city';
        $label = 'City';
        ;?>
        <div class="form-group <?php if (isset($errors[$field])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="<?php echo $field ?>"><?php echo $label;?></label>
            <input id="<?php echo $field ?>" class="form-control" name="<?php echo $field ?>" type="text" size="20" maxlength="20" placeholder="<?php echo $label;?>" value="<?php echo post($field);?>">
            <?php if (isset($errors[$field])): ?>
                <span id="helpBlock1" class="help-block"><?php echo implode(', ',$errors[$field]);?> </span>
            <?php endif; ?>
        </div>

        <?php
        $field = 'address';
        $label = 'Address';
        ;?>
        <div class="form-group <?php if (isset($errors[$field])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="<?php echo $field ?>"><?php echo $label;?></label>
            <textarea id="<?php echo $field ?>" class="form-control" name="<?php echo $field ?>" placeholder="<?php echo $label;?>"><?php echo post($field);?></textarea>
            <?php if (isset($errors[$field])): ?>
                <span id="helpBlock1" class="help-block"><?php echo implode(', ',$errors[$field]);?> </span>
            <?php endif; ?>
        </div>

        <?php
        $field = 'mobile_phone';
        $label = 'Mobile Phone';
        ;?>
        <div class="form-group <?php if (isset($errors[$field])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="<?php echo $field ?>"><?php echo $label;?></label>
            <input id="<?php echo $field ?>" class="form-control" name="<?php echo $field ?>" type="text" size="20" maxlength="20" placeholder="<?php echo $label;?>" value="<?php echo post($field);?>">
            <?php if (isset($errors[$field])): ?>
                <span id="helpBlock1" class="help-block"><?php echo implode(', ',$errors[$field]);?> </span>
            <?php endif; ?>
        </div>

    </fieldset>
    <fieldset>
        <legend>Account information</legend>
        <div class="form-group <?php if (isset($errors['username'])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="username">Email</label>
            <input id="username" class="form-control" name="username" type="email" size="20" maxlength="100" placeholder="Email" value="<?php echo post('username');?>">
            <?php if (isset($errors['username'])): ?>
                <span id="helpBlock1" class="help-block"><?php echo implode(', ',$errors['username']);?> </span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php if (isset($errors['password'])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="password">Password</label>
            <input id="password" class="form-control" name="password" type="password" size="20" maxlength="20" placeholder="Password"  value="<?php echo post('password');?>">
            <?php if (isset($errors['password'])): ?>
                <span id="helpBlock2" class="help-block"><?php echo implode(', ',$errors['password']);?> </span>
            <?php endif; ?>
        </div>
        <div class="form-group <?php if (isset($errors['password_confirm'])): ?>has-error<?php endif; ?>">
            <label class="control-label" for="password_confirm">Password confirmation</label>
            <input id="password_confirm" class="form-control" name="password_confirm" type="password" size="20" maxlength="20" placeholder="Password confirmation"  value="<?php echo post('password_confirm');?>">
            <?php if (isset($errors['password_confirm'])): ?>
                <span id="helpBlock2" class="help-block"><?php echo implode(', ',$errors['password_confirm']);?> </span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <button class="btn btn-primary" type="submit">Register</button>
        </div>
    </fieldset>
</form>