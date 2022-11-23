<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="glyphicon glyphicon-user"></i>
        <span>LOGIN <i class="caret"></i></span>
    </a>
    <ul class="dropdown-menu">
        <li class="user-header bg-green2">
            <br>
            <img src="img/icon_key.png" class="img-circle" alt="Key Image" />                    
            <p><i>Silahkan Login</i></p>    
        </li>
        <li class="user-body">
            <div class="col-xs-12 text-info">            
                <form id="frmlogin" method="post" action="index.php?model=login&action=checkLogin">
                    <div class="form-group has-feedback">                
                        <input type="text" class="form-control" placeholder="Username" name="user" id="user" required autocomplete="user" autofocus>
                    </div>
                    <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required autocomplete="current-password">
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>                            
                        </div>
                    </div>
                </form>
            </div>
        </li>    
    </ul>
</li>
