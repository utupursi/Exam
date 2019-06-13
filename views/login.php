
<div>
    <h1>Login</h1>
    <form method="post" >
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" class="form-control<?php  echo isset($errors['erroremail']) ? ' is-invalid' : ''?>" id="exampleInputEmail1" name="email" value="<?php echo $data['email'];?>"
                   placeholder="Enter email">
                   <?php if(isset($errors['erroremail'])&&$errors['erroremail']!=''):?>
                   <p  class="invalid-feedback"> <?php echo $errors['erroremail'];?> </p>
      
<?php endif;?>
</div>

        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" class="form-control<?php  echo isset($errors['errorpassword']) ? ' is-invalid' : ''?>" id="exampleInputPassword1" name="password" value="<?php echo $data['password'];?>"placeholder="Password">
            <?php if(isset($errors['errorpassword'])&&$errors['errorpassword']!=''):?>
                   <p  class="invalid-feedback"> <?php echo $errors['errorpassword'];?> </p>
      
<?php endif;?>
        </div>
        <button type="submit" name='submit' class="btn btn-primary">Submit</button>
    </form>
</div>
