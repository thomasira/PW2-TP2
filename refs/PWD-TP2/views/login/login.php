<?php
$msg = NULL;
$succ = NULL;
if(isset($_GET['msg'])){
    if($_GET['msg'] == 1){
        $msg = 'username does not exist.';
    }
    if($_GET['msg']==2){
        $msg = 'password not ok';
    }
    if($_GET['msg']==3){
        $msg = 'please login to see your articles';
    }
    if($_GET['msg']==5){
        $msg = 'your information is not valid, make sure to respect format';
    }
    if($_GET['msg']==6){
        $msg = 'you already have an account';
    }
    if($_GET['msg']==7){
        $msg = 'not a valid request';
    }
    if($_GET['msg']==10){
        $msg = 'you need to login in order to view the requested page.';
    }
}
if(isset($_GET['succ'])) $succ = 'Your account has been created! please login to continue';
    
?>
<div class="error"><strong><?=$msg?></strong></div>
<div class="success"><strong><?=$succ?></strong></div>
<div class="flow-form">
    
    <form action="?module=login&action=auth" method="post">

    <h2>Login</h2>
        <label>Username(email):
            <input type="text" name="username">
        </label>
        <label>Password:
            <input type="password" name="password">
        </label>
        <input type="submit" value="login" class="button">
    </form>


    
    <form action="?module=user&action=create" method="post">

    <h3>Create account</h3>
        <label>Name:
            <input type="text" name="name">
        </label>
        <label>Username(email):
            <input type="text" name="username" placeholder="valid email address">
        </label>
        <label>Date of Birth:
            <input type="text" name="dob" placeholder="yyyy-mm-dd">
        </label>
        <label>Password:
            <input type="password" name="password" placeholder="6-20 char.(A-z AND 0-9)">
        </label>
        <input type="submit" value="create" class="button">
    </form>
</div>