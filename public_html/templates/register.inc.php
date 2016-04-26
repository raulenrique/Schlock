 <?php  
     $errors = $user->errors; 
 ?>
    <div class="row">
          <div class="col-xs-12">  
              <form id="registerNewUser" action=".\?page=auth.store" method="POST" class="form-horizontal">
              
               <h3>Register New User</h3>

               <div class="form-group <?php if($errors['username']): ?> has-error <?php endif; ?>">
                    <label for="username" class="col-sm-4 col-md-2 control-label">Username</label>
                    <div class="col-sm-8 col-md-10">
                      <input class="form-control" id="username" name="username" placeholder="sas"
                      value="<?php echo $user->username; ?>">
                      <div class="help-block"><?php echo $errors['username']; ?></div>
                    </div>
                </div>

                <div class="form-group <?php if($errors['email']): ?> has-error <?php endif; ?>">
                    <label for="email" class="col-sm-4 col-md-2 control-label">Email Address</label>
                    <div class="col-sm-8 col-md-10">
                      <input class="form-control" id="email" name="email" placeholder="ss@mail.com"
                      value="<?php echo $user->email; ?>">
                      <div class="help-block"><?php echo $errors['email']; ?></div>
                    </div>
                </div>

                <div class="form-group <?php if($errors['password']): ?> has-error <?php endif; ?>">
                  <label for="password" class="col-sm-4 col-md-2 control-label"> Password </label>
                  <div class="col-sm-8 col-md-10">
                    <input type="password" class="form-control" id="password" name="password">
                    <div class="help-block"><?php echo $errors['password']; ?></div>
                  </div>
                </div>
                
                <div class="form-group <?php if($errors['password2']): ?> has-error <?php endif; ?>">
                  <label for="password2" class="col-sm-4 col-md-2 control-label"> Confirm Password </label>
                  <div class="col-sm-8 col-md-10">
                    <input type="password" class="form-control" id="password2" name="password2">
                    <div class="help-block"><?php echo $errors['password2']; ?></div>
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-10 col-md-offset-2 col-md-10">
                    <button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span> Register</button>
                  </div>
                </div>
              </form> 
                 
          </div>
          </div>