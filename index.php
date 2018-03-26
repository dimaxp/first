<?



if (isset($_GET['tip_pom'])) { $tip_pom = $_GET['tip_pom']; if ($tip_pom == '') { unset($tip_pom);} }

if (isset($_GET['price_from'])) { $price_from = $_GET['price_from']; if ($price_from == '') { unset($price_from);} }

if (isset($_GET['price_to'])) { $price_to = $_GET['price_to']; if ($price_to == '') { unset($price_to);} }

if (isset($_GET['only_photo'])) { $only_photo = $_GET['only_photo']; if ($only_photo == '') { unset($only_photo);} }

if (isset($_GET['rooms'])) { $rooms = $_GET['rooms']; if ($rooms == '') { unset($rooms);} }







switch ($tip_pom) {
case 'flats';
case 'rooms';
case 'elite';
case 'newflats';    
$tip_nedv = 'city';
break;

case 'houses';
case 'cottages';
case 'lands'; 
$tip_nedv = 'country';
break;    
    
case 'offices';
case 'comm_new';
case 'service'; 
case 'different';
case 'freestanding';
case 'storage'; 
case 'comm_lands'; 
    
$tip_nedv = 'commerce';
break;     
    
    
default;
$tip_nedv = 'city';
break;
  }
 

$result = '';
foreach ($_GET['rooms'] as $names){
$result = $result."&rooms%5B%5D=".$names;
}

?>






<form method="get" action="index.php">
  
 <label>Количество комнат</label> 
<select name="rooms[]" multiple="multiple" >
<?
for ($x=1; $x<6; $x++) {
if ($x == $rooms[0] || $x == $rooms[1] || $x == $rooms[2] || $x == $rooms[3] || $x == $rooms[4]) {
echo "<option selected value='$x'>$x</option>";   
}

else {
  
  echo "<option value='$x'>$x</option>";  
}

   
 }
?>   
  
</select>  
  
  
  
  
  
  
  
  
  
  
<label>Тип недвижимости</label>
<select name="tip_pom">
<option <? if ($tip_pom == 'flats') echo "selected"; ?>  value="flats">квартиры (вторичка)</option>
<option <? if ($tip_pom == 'rooms') echo "selected"; ?> value="rooms">комнаты</option>
<option <? if ($tip_pom == 'elite') echo "selected"; ?> value="elite">элитная недвижимость</option>
<option <? if ($tip_pom == 'newflats') echo "selected"; ?> value="newflats">новостройки</option>
<option <? if ($tip_pom == 'houses') echo "selected"; ?> value="houses">дома</option>
<option <? if ($tip_pom == 'cottages') echo "selected"; ?> value="cottages">коттеджи</option>
<option <? if ($tip_pom == 'lands') echo "selected"; ?> value="lands">участки</option>
<option <? if ($tip_pom == 'offices') echo "selected"; ?> value="offices">офисы</option>
<option <? if ($tip_pom == 'comm_new') echo "selected"; ?> value="comm_new">помещения в строящихся домах</option>
<option <? if ($tip_pom == 'service') echo "selected"; ?> value="service">помещения в сфере услуг</option>
<option <? if ($tip_pom == 'different') echo "selected"; ?> value="different">помещения различного назначения</option>
<option <? if ($tip_pom == 'freestanding') echo "selected"; ?> value="freestanding">отдельно стоящие здания</option>
<option <? if ($tip_pom == 'storage') echo "selected"; ?> value="storage">производственно-складские помещения</option>
<option <? if ($tip_pom == 'comm_lands') echo "selected"; ?> value="comm_lands">земельные участки</option>
  </select>
  
  

<label for="cna1">Цена <span>(рублей)</span>:</label>
<input type="text" name="price_from" value="<? echo $price_from; ?>">
<input type="text" name="price_to" value="<? echo $price_to; ?>"> 
  
  
  <label>Только с фото</label>
<input <? if ($only_photo == '1') echo "checked"; ?> type="checkbox" id="only_photo" name="only_photo" value="1" class="ots">
  
  
  
<input type="submit" value="Отправить">
  
  
</form>










<?php
  
  
  
  
  
  
  
$homepage  =  file_get_contents ( 'http://www.50.bn.ru/sale/'.$tip_nedv.'/'.$tip_pom.'/?sort=price_for_sort&sortorder=ASC&price%5Bfrom%5D='.$price_from.'&price%5Bto%5D='.$price_to.'&only_photo='.$only_photo.$result );
$homepage = iconv('windows-1251', 'utf-8', $homepage);










 
$marker = stripos($homepage, '<div class="result">');
if($marker) 
 $homepage = substr($homepage, $marker+21);



 
$homepage = preg_replace("!(?<=footer).+!is", "", $homepage); 
 
echo $homepage;
?>



