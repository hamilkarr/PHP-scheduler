# PHP-scheduler

일정과 내용을 추가,조회,삭제,수정할 수 있는 스케쥴러 입니다. <br><br>

<img src="https://user-images.githubusercontent.com/86813319/143017929-18517606-55d1-4363-bf2b-b91d93daa394.png" width="600" height = "310">

실제 구현된 모습을 보고 싶다면 [요기](https://hamilkarr.cafe24.com/calendar/index.php) 를 클릭하세요.

## Used Skill Set and Development Tool
- **JavaScript (ES2016++)** 
  - jQuery  
- **PHP**
- **MySQL 8.0**
- Visual Studio Code

### 주요 스킬  
  ### PHP
  - PDO : 데이터 베이스 연동 <br>
  calendar\class\DB.php
  
```php
<?php
class DB extends PDO {
  public function __construct() {
    try {
      $dsn = "mysql:host=localhost;dbname=hamilkarr";
      $username = "hamilkarr";
      $password = "xxxxxxx";
      parent::__construct($dsn, $username, $password);
    } catch (PDOException $e) {
      throw $e;
    }
  }
}
```
   - PDOStatement: 데이터 바인딩
   - Singleton Pattern <br>
   calendar\class\Scheduler.php   

```php
<?php

/** Scheduler 싱글톤 패턴 */
  private static $instance;

  public static function getInstance() {
    if (!self::$instance) {
      self::$instance = new Scheduler();
    }
	
    return self::$instance;
  }
  
/** 일정추가 */
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
```
   - html 에서의 php활용 : 반복문,조건문을 활용해서 코드를 짧고 효율적으로. <br>
   calendar\index.php
```php
<div class="scheduler_container">
  <ul class='yoils'>
    <?php foreach ($yoils as $yoil) : ?>
    <li><?=$yoil?></li>
    <?php endforeach; ?>
  </ul>

  <!-- days -->
  <ul class='days'>
    <?php foreach ($days as $day) : ?>
    <li class='day' data-stamp="<?=$day['stamp']?>">
      <div class='no'><?=$day['day']?></div>

      <?php if (isset($schedules[$day['date']])) : ?>
      <i class='xi-check-circle-o view_schedule'></i>
      <?php endif; ?>

    </li>
    <?php endforeach; ?>
  </ul>
</div>
```
   ### Javascript
   - jQuery : 팝업 창을 열고 닫기.<br>
   calendar\js\layer.js
```js
popup: function (url, width, height) {
    width = width || 400;
    height = height || 400;

    if ($('#layer_dim').length == 0) {
      $('body').append("<div id='layer_dim'></div>");
    }

    if ($('#layer_popup').length == 0) {
      $('body').append("<div id='layer_popup'></div>");
    }

    $layerDim = $('#layer_dim');
    $popup = $('#layer_popup');

    $layerDim.css({
      position: 'fixed',
      width: '100%',
      height: '100%',
      top: 0,
      left: 0,
      background: 'rgba(0,0,0,0.5)',
      zIndex: 100,
    });
```
