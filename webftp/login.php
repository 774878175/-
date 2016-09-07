<?php



require('./init.php');

if (isset($_GET['act'])){
    switch ($_GET['act']){
        case 'out':
            Auth::login_out();
            redirect('login.php?act=in');
            exit();break;
        case 'login_check':
            Auth::login_check();
            exit();break;
        case 'resetpasswd':
             Auth::update_user_password();
            exit();break;
        case 'in': break;
        default: exit(Session::get('login_error'));
    }
}

//
$uhash = Session::set('uhash', rand(1000, 9999));
$error = Session::get('login_error');
?>
<html>
<head>
    <title>加载中...</title>
</head>
<body scroll="no">
加载中...
  <form method="post" id="myform" action="login.php?act=login_check" style="display:none;">
    <input type="hidden" name="forward" value="" />
    <input type="text" size="30" name="uname" value="admin" />
    <input type="password" name="upawd" size="30" value="admin888" />
    <input type="hidden" name="uhash" value="<?php echo $uhash;?>" />
  </form>

<?php Session::set('login_error', '');?>
<script type="text/javascript">
var error = '<?php echo $error;?>';
setTimeout(function(){
	document.getElementById('myform').submit();
},50);

if (error) alert(error);
</script>
</body>
</html>