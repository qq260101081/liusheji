<?php 
	$this->registerCssFile('default/login.css');
?>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>G2G-OA管理平台</title>

</head>

<body>
	<h1>G2G-OA管理平台<sup>2016</sup></h1>

<div class="login" style="margin-top:50px;">
    
    <div class="header">
        <div class="switch" id="switch">
        	<a class="switch_btn_focus" id="switch_qlogin" href="javascript:void(0);" tabindex="7">快速登录</a>
			<div class="switch_bottom" id="switch_bottom" style="position: absolute; width: 64px; left: 0px;"></div>
        </div>
    </div>    
  	<div>
  		<?php foreach ($model->getErrors() as $v):;?>
  			<div style="color:red;text-align:center;"><?php echo $v[0] . "<br>";?></div>
  		<?php endforeach;?>
	</div>
    
    <div class="web_qr_login" id="web_qr_login" style="display: block; height: 235px;">    
            <!--登录-->
            <div class="web_login" id="web_login">
               <div class="login-box">
			<div class="login_form">
				<form action="index.php?r=site/login" name="loginform" accept-charset="utf-8" id="login_form" class="loginForm" method="post">
                <div class="uinArea" id="uinArea">
                <label class="input-tips" for="u">帐号：</label>
                <div class="inputOuter" id="uArea">
                    <input type="text" id="u" name="LoginForm[username]" class="inputstyle"/>
                </div>
                </div>
                <div class="pwdArea" id="pwdArea">
               <label class="input-tips" for="p">密码：</label> 
               <div class="inputOuter" id="pArea">
                    <input type="password" id="p" name="LoginForm[password]" class="inputstyle"/>
                </div>
                <input type="hidden" name="LoginForm[rememberMe]" value="1">
                </div>
               
                <div style="padding-left:50px;margin-top:20px;"><input type="submit" value="登 录" style="width:150px;" class="button_blue"/></div>
              </form>
           </div>
            	</div>
            </div>
            <!--登录end-->
  </div>
 </div>
</body>
</html>