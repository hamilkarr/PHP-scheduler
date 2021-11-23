# PHP-scheduler

일정과 내용을 추가,조회,삭제,수정할 수 있는 스케쥴러 입니다. <br><br>

<img src="https://user-images.githubusercontent.com/86813319/143006028-163333b0-241a-47bd-a6d3-b72d60012403.png" width="600" height = "310">

실제 구현된 모습을 보고 싶다면 [여기](http://hamilkarr2.cafe24app.com) 를 클릭하세요.

## Used Skill Set and Development Tool
- **JavaScript (ES2016++)** 
  - jQuery
  - Axios
- **node.js**
- **MySQL 8.0**
- Visual Studio Code

### 주요 스킬
  ### node.js
  - sequelize : DB와의 연동.  <br>
    models\scheduler.js <br>
    
```js
delete : async function (period, color) {
		if (!period || !color) 
			return false;
		
		try {
			const sql = "DELETE FROM schedule WHERE period = ? AND color = ?";
			await sequelize.query(sql, {
				replacements : [period, color],
				type : QueryTypes.DELETE,
			});
		
			return true;
		} catch (err) {
			logger(err.message, 'error');
			logger(err.stack, 'error');
			return false;
		}
	},
```

   - nunjucks : html에서 반복,조건, 제어문 등을 사용해 코드의 간결함과 효율성을 높임. <br>
     views\today.html

```html
	<div class='today_list'>
	<div class='tit'>오늘 할일</div>
	{% if list %}
	<ul>
	{% for item in list %}
		<li>
			<input type='checkbox' name='isChecked' value='{{ item.color }}' id='isChecked{{ loop.index }}'>
			<label for='isChecked{{ loop.index }}'>{{ item.title }}</label>
		</li>
	{% endfor %}
	</ul>
	{% endif %}
	<div class='confirm'>스케줄 확인</div>
	</div>
```

   ### Javascript
   - jQuery : 'write less, do more.' <br>
     public\js\layer.js
```js
	if ($("#layer_dim").length == 0) {
			$("body").append("<div id='layer_dim'></div>");
		}
		
		if ($("#layer_popup").length == 0) {
			$("body").append("<div id='layer_popup'></div>");
		}
		
		$layerDim = $("#layer_dim");
		$popup = $("#layer_popup");
```

