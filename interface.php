<?php
require_once("config.php");
if(isset($_GET['action']))
{
	$acc = new Account();
	$action = trim($_GET['action']);
	switch($action)
	{
		case "logout":
			$acc->Logout();
			break;
		case "accountList":
			$acc->getAccountList();
			break;
		case "constructList":
			$construction = new Construction();
			$construction->getConstrcutionList();
			break;
		case "roleList":
			$acc->getRoletList();
			break;
		case "userInfo":
			if(isset($_GET['userId']))
			{
				$user_id = $_GET['userId'];
				$acc->getAccountInfo($user_id);
			}
			
			break;
		case "accountTableList":
			if(isset($_GET['role']))
			{
				$role = $_GET['role'];
				$acc->getAccountTableInfo($role);
			}
			break;
		case "changeStaus":
			if(isset($_GET['userId']))
			{
				
				if(isset($_GET['status']))
				{
					$user_id = $_GET['userId'];
					$status = $_GET['status'];
					$admin = new Admin();
					$admin->changeStatusAccount($user_id, $status);
				}
				
			}
			break;
		case "setJobPage":
			if(isset($_GET['page']))
			{
				$page = $_GET['page'];
				$_SESSION['session_page'] = $page;
			}	
			break;
		case "constructionInfo":
			if(isset($_GET['consId']))
			{
				$cons_id = $_GET['consId'];
				$construction = new Construction();
				$construction->getInfo($cons_id);
			}
			
			break;
		case "constructionContentInfo":
			if(isset($_GET['contentId']))
			{
				$contentId = $_GET['contentId'];
				$construction = new Construction();
				$construction->getInfoContent($contentId);
			}
			
			break;
		case "constructionList":
				$construction = new Construction();
				$construction->getTableInfo($_SESSION['user_id']);		
				break;
		case "constructionContentList":
				if(isset($_GET['consId']))
				{
					$construction = new Construction();
					$construction->getTableContentInfo($_SESSION['user_id'], $_GET['consId']);	
				}
					
				break;
		default:
			header('location: /');
		break;
	}
} else
{
	header('location: /');
}
?>