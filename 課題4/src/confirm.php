<?php
	session_start();
	require_once("./util.php");
?>
<?php
	$errors = array();
	//名前入力チェック
	if(isset($_POST["name"]) && !empty($_POST["name"])){
		$name = htmlspecialchars($_POST["name"], ENT_QUOTES, "UTF-8");
	}else{
		$errors[] = "名前が未入力です";
	}
	//パスワード入力チェック
	if(isset($_POST["password"]) && !empty($_POST["password"])){
		$password = htmlspecialchars($_POST["password"], ENT_QUOTES, "UTF-8");
	}else{
		$errors[] = "パスワードが未入力です";
	}
	if(strlen($password) < 6){
		$errors[] = "パスワードが短いです";
	}
	
	//メールアドレスチェック
	if(isset($_POST["address"]) && !empty($_POST["address"])){
		$address = htmlspecialchars($_POST["address"], ENT_QUOTES, "UTF-8");
	}else{
		$errors[] = "メールアドレスが未入力です";
	}
	if(count($errors) == 0){
		$_SESSION["name"] = $name;
		$_SESSION["address"] = $address;
		$_SESSION["password"] = $password;
	}
?>
<?php
	$smarty =& getSmartyObj();
	$smarty->assign("signed", $_SESSION["login"]);
	if(count($errors) == 0){
		$smarty->assign("name", $_SESSION["name"]);
		$smarty->assign("address", $_SESSION["address"]);
		$smarty->assign("password", $_SESSION["password"]);
		$smarty->display("confirm.tpl");
	}else{
		$smarty->assign("errors", $errors);
		$smarty->assign("url", "./entry.php");
		$smarty->display("error.tpl");
	}
?>