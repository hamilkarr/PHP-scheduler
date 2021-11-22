<?php
include_once "DB.php";
class Scheduler {
  private $required = [
    'date' => '작업일자를 선택하세요',
    'title' => '작업명을 입력하세요',
    'content' => '작업내용을 입력하세요',
  ];

  private $db; 
  
  public function __construct() {
    $this->db = new DB();  
  }
  
  /** Scheduler 싱글톤 패턴 */
  private static $instance;

  public static function getInstance() {
    if (!self::$instance) {
      self::$instance = new Scheduler();
    }
	
    return self::$instance;
  }
  
  /**
   * 일정 추가 
   * 
   * @param Array $data 일정 데이터 
   * @return Integer|boolean - 성공시에는 작업 추가번호, 실패시에는 false 
   * @throws Exception 
   */
  public function add($data) {
    // 유효성 검사 
    $this->checkData($data);
    
    $sql = "INSERT INTO scheduler (date, title, content)
              VALUES (:date, :title, :content)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":date", $data['date']);
    $stmt->bindValue(":title", $data['title']);
    $stmt->bindValue(":content", $data['content']);
    $result = $stmt->execute(); // true/ false
   
    return $result;
  }

  /** 일정 삭제 */
  public function delete($date) {
	$date = str_replace(".", "-", $date);
    $sql = "DELETE FROM scheduler WHERE date = :date";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(":date", $date);
    $result = $stmt->execute(); // true/ false
   
    return $result;
  }


  /**
   * 데이터 유효성 검사  
   *
   * throws Exception 
   */
  private function checkData($data) {
    foreach ($this->required as $key => $msg) {
      if (!$data[$key]) {
        throw new Exception($msg);
      }
    }
  }

  /** 
  * 스케줄 기간 검색 
  *
  * @param $startDate 시작일자, 기본값은 이번달 시작일 
  * @param $endDate 종료일자, 기본값은 이번달 종료일 
  */
  public function getList($startDate = null, $endDate = null) {
	  $startDate = str_replace(".", "-", $startDate);
	  $endDate =  str_replace(".", "-", $endDate);
	  
	  $startDate = $startDate?date("Y-m-d", strtotime($startDate)):date("Y-m-01");
	  
	  
	  $endOfDay = strtotime("+1 month", strtotime(date("Y-m-01"))) - 1;
	  $endDate = $endDate?date("Y-m-d", strtotime($endDate)):date("Y-m-d", $endOfDay);
	  
	  
	  
	  $sql = "SELECT * FROM scheduler WHERE date BETWEEN :startdate AND :enddate";
	  $stmt = $this->db->prepare($sql);
	  $stmt->bindValue(":startdate", $startDate);
	  $stmt->bindValue(":enddate", $endDate);
	  $result = $stmt->execute();
	  
	  
	$list = [];
	if ($result) {
	    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
			$date = date("Y.m.d", strtotime($row['date']));
		    $list[$date] = $row;
	    }
	}
	return $list;
  }
  
  /**
  * 스케줄 조회 
  * 
  * @param $date 날짜 - 정수(timestamp), 문자 - 날짜 
  */
  public function get($date) {
	if (is_numeric($date)) {
		$date = date("Y-m-d", $date);
	} else {
		$date = str_replace(".", "-", $date);
	}
	
	$sql = "SELECT * FROM scheduler WHERE date = :date";
	$stmt = $this->db->prepare($sql);
	$stmt->bindValue(":date", $date);
	$result = $stmt->execute();
	$info = [];
	if ($result) {
		$info = $stmt->fetch(PDO::FETCH_ASSOC);
	}
	
	return $info;
  }
}