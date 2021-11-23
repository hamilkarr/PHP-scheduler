<?php
include_once "class/Scheduler.php";

$scheduler = Scheduler::getInstance();
try {
  switch ($_REQUEST['mode']) {
    case "add" : 
      $result = $scheduler->add($_POST);
      if (!$result) {
        throw new Exception("스케줄 추가 실패하였습니다.");
      }	  

      echo "<script>parent.location.reload();</script>";
      break;

    case "delete" : 
      $result = $scheduler->delete($_GET['date']);
      if (!$result) {
        throw new Exception("스케줄 삭제 실패하였습니다.");
      }

      echo "<script>parent.location.reload();</script>";
      break;
  }
} catch (Exception $e) {
  echo "<script>alert('".$e->getMessage()."');</script>";
}