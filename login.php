<?php
/**
 * Do the login/logout process
 */

require_once('inc/init.php');

$msg = $lang['msg_login'];
if(isset($_REQUEST['username'])){
    if (empty($_REQUEST['password'])) { $_REQUEST['password']=''; }
    if (do_ldap_bind($_REQUEST['username'],$_REQUEST['password'])){
        //forward to next page
        if(!empty($_SESSION['ldapab']['lastlocation'])){
            header('Location: '.$_SESSION['ldapab']['lastlocation']);
        }else{
            header('Location: index.php');
        }
        exit;
    }else{
        $msg = $lang['msg_loginfail'];;
    }
}

//prepare templates
tpl_std();
$smarty->assign('msg',$msg);
//display templates
header('Content-Type: text/html; charset=utf-8');
$smarty->display('login.tpl');

