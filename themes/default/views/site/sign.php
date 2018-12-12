<div class="container">
    <h1 class="page-title">Login/Register on Instant Help</h1>
</div>

<div class="gap"></div>


<div class="container">
    <div class="row" data-gutter="60">
        <div class="col-md-4">

            <h3>Become an Expert</h3>
            <p>Make Money Helping People Over the world</p>
            <p></p>
            <h3>Why to join Instan-Help</h3>
            <ul>
                <li>Earn $$$ for every call you take **</li>
                <li> Set your own schedule,by
                    Working from anywhere, anytime</li>
                <li>Share your expertise,and
                    Use your professional knowledge to help people </li>
            </ul>

        </div>
        <div class="col-md-4">
            <h3>Login</h3>
            <div id="login-status"></div>
            <form id="login-form">
                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                    <label>Email</label>
                    <input class="form-control" name="email" placeholder="e.g. johndoe@gmail.com" type="email" value=""/>
                </div>
                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                    <label>Password</label>
                    <input class="form-control" name="password" type="password" placeholder="my secret password" value=""/>
                </div>
                <input class="btn btn-primary" id="login-btn" type="submit" value="Sign in" />
            </form>
        </div>
        <div class="col-md-4">
            <h3>New To Instant Help?</h3>
            <div id="register-status"></div>
            <form id="register-form">
                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                    <label>First Name</label>
                    <input class="form-control" name="fname" placeholder="e.g. Mohammad" type="text" />
                </div>
                <div class="form-group form-group-icon-left"><i class="fa fa-user input-icon input-icon-show"></i>
                    <label>Last Name</label>
                    <input class="form-control" name="lname" placeholder="e.g. Mohammad" type="text" />
                </div>
                <div class="form-group form-group-icon-left"><i class="fa fa-envelope input-icon input-icon-show"></i>
                    <label>Email</label>
                    <input class="form-control" name="email" placeholder="e.g. johndoe@gmail.com" type="email" />
                </div>
                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                    <label>Password</label>
                    <input class="form-control" name="password" type="password" placeholder="my secret password" />
                </div>
                <div class="form-group form-group-icon-left"><i class="fa fa-lock input-icon input-icon-show"></i>
                    <label>Repeat Password</label>
                    <input class="form-control" name="re_password" type="password" placeholder="my secret password" />
                </div>
                <div class="form-group form-group-icon-left"><i class="fa fa-puzzle-piece input-icon input-icon-show"></i>
                    <label>Type of Service</label>
                    <select name="clientType" class="form-control">
                        <option value="<?php echo ClientType::Normal; ?>">Normal</option>
                        <option value="<?php echo ClientType::PreExpert; ?>">Pre-Expert</option>
                        <option value="<?php echo ClientType::Expert; ?>">Expert</option>
                    </select>
                </div>
                <input id="register-btn" class="btn btn-primary" type="submit" value="Sign up for Instant Help" />
            </form>
        </div>
    </div>
</div>



<div class="gap"></div>