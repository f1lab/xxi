<!DOCTYPE html>
<?php
  function morph($n, $f1, $f2, $f5) {
    $n = abs(intval($n)) % 100;
    if ($n>10 && $n<20) return $f5;
    $n = $n % 10;
    if ($n>1 && $n<5) return $f2;
    if ($n==1) return $f1;
    return $f5;
  }
  function num2str($num) {
    $nul='ноль';
    $ten=array(
        array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
        array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
    );
    $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
    $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
    $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
    $unit=array( // Units
        array('копейка' ,'копейки' ,'копеек',	 1),
        array('рубль'   ,'рубля'   ,'рублей'    ,0),
        array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
        array('миллион' ,'миллиона','миллионов' ,0),
        array('миллиард','милиарда','миллиардов',0),
    );
    //
    list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub)>0) {
        foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
            if (!intval($v)) continue;
            $uk = sizeof($unit)-$uk-1; // unit key
            $gender = $unit[$uk][3];
            list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
            // mega-logic
            $out[] = $hundred[$i1]; # 1xx-9xx
            if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
            else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
            // units without rub & kop
            if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
        } //foreach
    }
    else $out[] = $nul;
    //$out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
    //$out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
  }
 
  function num2rub($num) {
    $nul='ноль';
    $ten=array(
        array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
        array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
    );
    $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
    $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
    $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
    $unit=array( // Units
        array('копейка' ,'копейки' ,'копеек',	 1),
        array('рубль'   ,'рубля'   ,'рублей'    ,0),
        array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
        array('миллион' ,'миллиона','миллионов' ,0),
        array('миллиард','милиарда','миллиардов',0),
    );
    //
    list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub)>0) {
        foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
            if (!intval($v)) continue;
            $uk = sizeof($unit)-$uk-1; // unit key
            $gender = $unit[$uk][3];
            list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
            // mega-logic
            $out[] = $hundred[$i1]; # 1xx-9xx
            if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
            else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
            // units without rub & kop
            if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
        } //foreach
    }
    else $out[] = $nul;
      $out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
      $out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
  }
?>
<html lang="ru"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Товарная накладная(Печать)</title>
<meta name="viewport" content="width=device-width; initial-scale=1.0">

<style>
  html,body,div,span,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,abbr,address,cite,code,del,dfn,em,img,ins,kbd,q,samp,small,strong,sub,sup,var,a,b,i,dl,dt,dd,ol,ul,li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,figcaption,figure,footer,header,hgroup,menu,nav,section,summary,input,select,textarea,time,mark,audio,video{margin:0;padding:0;border:0;outline:none;font-family:Tahoma;font-size:12px;vertical-align:baseline;background:transparent;}
  article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block;}
  body{color:#2f2f2f;font-size:12px;line-height:14px;width:100%;position:relative;}
  nav ul {list-style:none;}
  blockquote,q {quotes:none;}
  blockquote:before,blockquote:after,q:before,q:after{content:'';content:none;}
  ins {text-decoration:none;}
  mark {background-color:#ff9;color:#000;font-style:italic;font-weight:bold;}
  del {text-decoration: line-through;}
  abbr[title],dfn[title] {border-bottom:1px dotted;cursor:help;}
  small{font-size:4px;line-height:inherit;}
  h1,h2,h3 {font-weight:bold;position:relative;}
  table {width:100%;border-collapse:collapse;border-spacing:0;}
  hr {display:block;width:100%;border:none;margin:0;padding:0;}
  a {color:inherit;text-decoration:underline;}
  a:hover {color:red;}
  ul {list-style:none;}
  .num {list-style:none inside;counter-reset:section;}
  .num ol {padding-left:20px;counter-reset:section;margin-bottom:10px;}
  .num li {counter-increment:section;margin-top:3px;}
  .num li:before {content:counters(section,".")". ";}
  .h {display:none;}
  .bord-0 td {border:1px solid inherit;}
  .bord-1 td {border:1px solid silver;}
  .bord-2 td {border:1px solid gray;vertical-align:middle;text-align:center;}
  table td {padding:2px;border-color:gray;}
  .bw {color:black !important;border-color:black !important;}

  @media screen{
  .page-portrait {width:199mm;height:248mm;position:relative;margin:20px auto}
  .page-landscape {width:248mm;height:199mm;position:relative;margin:20px auto;}
  /* .rotate {width:248mm;height:199mm;} */
  .border-page {position:absolute;top:0;left:0;right:0;bottom:0;width:auto;height:auto;outline:2px dashed silver;z-index:-1;}
  .print-options {padding:10px 0 20px;width:200px;height:auto;max-height:80%;position:fixed;top:50px;left:1050px;border:1px solid #aaaaaa;border-radius:8px;box-shadow:3px 3px 10px #909090;background-color:white;line-height:18px;overflow:auto;}
  .title-size{width:auto;height:40px;display:inline-block;padding:0 20px;border:1px solid gray;border-radius:5px;border-bottom:1px solid silver;background-color:#f4f4f4;font-size:14px;line-height:40px;color:#b3201b;position:fixed;top:10px;left:1070px;}
  .print-options .doc {margin:0 0 0 40px;}
  .print-options .doc li {position:relative;}
  .print-options h4 {margin:12px 0 0 40px;}
  .print-options .doc input {position:absolute;top:2px;left:-20px;}
  .print-options .doc span {display:inline;margin-top:1px;padding-left:5px;font-size:11px;line-height:13px;font-weight:normal;color:gray;}
  .print-options .doc span + a {margin-top:4px;}
  .print-options .doc a {color:inherit;font-size:12px;line-height:14px;}
  .print-options .doc a:hover {color:#8d8d8d;}
  }

  @media print{
  .page-portrait {width:100%;height:248mm;}
  .page-landscape {width:100%;height:100mm;}
  .page-portrait, .page-landscape {position:relative;page-break-after:always;}
  /* .rotate {width:248mm;height:199mm;} */
  .border-page {position:absolute;top:0;left:0;right:0;bottom:0;width:auto;height:auto;outline:0 none;}
  .print-options {display:none;}
  .title-size {display:none;}
  }

  .rotate {
  -webkit-transform: rotate(90deg); /* Chrome и Safari */
  -moz-transform: rotate(90deg); /* Firefox */
  filter: progid:DXImageTransform.Microsoft.BasicImage(rotation=1); /* Internet Explorer - bag - incorrect when print */
  -o-transform: rotate(90deg); /* Opera */
  }

  .f01-label {font-size:6px;line-height:7px;color:gray;vertical-align:top;}
  .f01 .micro {font-size:8px;line-height:10px;display:block;}.f07 td {font-size:10px;line-height:11px;}
  .f07-metka {font-size:13px;line-height:18px;font-weight:bold;text-align:center;}
  .f07-label {padding:0;margin:0;font-size:6px;line-height:7px;vertical-align:top;text-align:center;}
  .f07-num td {padding:1px;font-size:10px;line-height:11px;width:11px;}.f04 td {font-size:10px;line-height:11px;}
  .f04-label {font-size:6px;line-height:7px;color:gray;vertical-align:top;}
  .f04-th td {font-size:6px;line-height:7px;}
  .f04-td td {font-size:9px;line-height:10px;}
  .f04-td .micro {font-size:7px;line-height:8px;display:block;}

</style>
</head>
<body>
<!--ШАПКА РЕКВИЗИТОВ-->
<p style="margin-top:12px;font-size:10px;">
<div class="page-landscape f04 tn-929">
  <div class="border-page">
    <div style="position:absolute;bottom:0;right:0;" class="f04-label">
    </div>
  </div>
  <table class="bord-0" style="border-collapse:separate">
    <colgroup>
      <col width="70px">
      <col width="26px">
      <col width="auto">
      <col width="180px">
      <col width="50px">
      <col width="64px">
    </colgroup>
    <tbody>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
      </tr>
      <tr>
        <td colspan="4" style="vertical-align:top;">
          <div class="f04-label" style="text-align:right;">
            Унифицированная форма № ТОРГ-12 Утверждена постановлением Госкомстата России от 25.12.98 № 132
          </div>
        </td>
        <td>
        </td>
        <td style="border-left:1px solid silver;border-top:1px solid silver;border-right:1px solid silver;border-bottom:1px solid gray;text-align:center;">
          Код
        </td>
      </tr>
      <tr>
        <td colspan="5" style="text-align:right;">
          Форма по ОКУД
        </td>
        <td style="text-align:center;border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;">
          0330212
        </td>
      </tr>
      <tr>
        <td colspan="4" style="border-bottom:1px solid silver;">
          <?php echo $company->getFullName()?>, <?php echo $company->getAddressJure()?>  <nobr>тел. <?php echo $company->getPhone()?>,</nobr> <nobr>ИНН <?php echo $company->getInn()?>,</nobr> <nobr>КПП <?php echo $company->getKpp()?>,</nobr> <nobr>р/с <?php echo $company->getRs()?></nobr> в <?php echo $company->getBank()?> , <nobr>БИК <?php echo $company->getBik()?>,</nobr> <nobr>к/с <?php echo $company->getKs()?></nobr>
        </td>
        <td style="text-align:right;vertical-align:bottom;">
          по ОКПО
        </td>
        <td style="text-align:center;vertical-align:bottom;border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;">
        </td>
      </tr>
      <tr>
        <td colspan="5" style="border-bottom:1px solid silver;">
          <div class="f04-label" style="text-align:center;">
            (организация-грузоотправитель, адрес, телефон, факс, банковские реквизиты)
          </div>
        </td>
        <td style="border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;">
        </td>
      </tr>
      <tr>
        <td colspan="2">
        </td>
        <td style="vertical-align:top">
          <div class="f04-label" style="text-align:center;">
            (структурное подразделение)
          </div>
        </td>
        <td colspan="2" style="text-align:right">
          Вид деятельности по ОКДП
        </td>
        <td style="border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;">
        </td>
      </tr>
      <tr>
        <td colspan="2" style="vertical-align:bottom;">
          Грузополучатель
        </td>
        <td colspan="2" style="border-bottom:1px solid silver;">
          <?php echo $order->getClient()->getFullName().", ".$order->getClient()->getAddressJure()." тел. ".$order->getClient()->getPhone()?> ,</nobr>
          <nobr>ИНН <?php echo $order->getClient()->getInn()?>,</nobr>
          <nobr>КПП <?php echo $order->getClient()->getKpp()?>,</nobr>
          <nobr>р/с <?php echo $order->getClient()->getRs()?></nobr> в
          <?php echo $order->getClient()->getBank()?>	,
          <nobr>БИК <?php echo $order->getClient()->getBik()?>,</nobr>
          <nobr>к/с <?php echo $order->getClient()->getKs()?></nobr>
          <nobr><?php if ($order->getClient()->getOkpo() !=""){
                          echo ", ОКПО ".$order->getClient()->getOkpo();
                      }
                ?>
          </nobr>
        </td>
        <td style="text-align:right;vertical-align:bottom;">
          по ОКПО
        </td>
        <td style="border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;text-align:center;vertical-align:bottom;">
        </td>
      </tr>
      <tr>
        <td style="vertical-align:bottom;">
          Поставщик
        </td>
        <td colspan="3" style="vertical-align:top;border-bottom:1px solid silver;">
          <div class="f04-label" style="text-align:center;">
            (организация, адрес, телефон, факс, банковские реквизиты)
          </div>
          <?php echo $company->getFullName()?>, <?php echo $company->getAddressJure()?>  <nobr>тел. <?php echo $company->getPhone()?>,</nobr> <nobr>ИНН <?php echo $company->getInn()?>,</nobr> <nobr>КПП <?php echo $company->getKpp()?>,</nobr> <nobr>р/с <?php echo $company->getRs()?></nobr> в <?php echo $company->getBank()?> , <nobr>БИК <?php echo $company->getBik()?>,</nobr> <nobr>к/с <?php echo $company->getKs()?></nobr>
        </td>
        <td style="text-align:right;vertical-align:bottom;">
          по ОКПО
        </td>
        <td style="border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;text-align:center;vertical-align:bottom;">
        </td>
      </tr>
      <tr>
        <td style="vertical-align:bottom;">
          Плательщик
        </td>
        <td colspan="3" style="vertical-align:top;border-bottom:1px solid silver;">
          <div class="f04-label" style="text-align:center;">
            (организация, адрес, телефон, факс, банковские реквизиты)
          </div>
          <?php echo $order->getClient()->getFullName().", "
          .$order->getClient()->getAddressJure()." тел. "
          .$order->getClient()->getPhone()?> ,</nobr>
          <nobr>ИНН <?php echo $order->getClient()->getInn()?>,</nobr>
          <nobr>КПП <?php echo $order->getClient()->getKpp()?>,</nobr>
          <nobr>р/с <?php echo $order->getClient()->getRs()?></nobr> в
          <?php echo $order->getClient()->getBank()?>	,
          <nobr>БИК <?php echo $order->getClient()->getBik()?>,</nobr>
          <nobr>к/с <?php echo $order->getClient()->getKs()?></nobr>
          <nobr><?php if ($order->getClient()->getOkpo() !=""){
                          echo ", ОКПО ".$order->getClient()->getOkpo();
                      }
                ?>
          </nobr>
        </td>
        <td style="text-align:right;vertical-align:bottom;border-bottom:1px solid silver;">
          по ОКПО
        </td>
        <td style="border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;text-align:center;vertical-align:bottom;">
        </td>
      </tr>
      <tr>
        <td style="vertical-align:bottom;">
          Основание
        </td>
        <td colspan="3" style="vertical-align:top;border-bottom:1px solid silver;">
          <div class="f04-label" style="text-align:center;">
            (организация, адрес, телефон, факс, банковские реквизиты)
          </div>
          Счет
        </td>
        <td style="text-align:right;vertical-align:bottom;border-left:1px solid silver;border-bottom:1px solid silver;">
          номер
        </td>
        <td style="border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;text-align:center;vertical-align:bottom;">
          <?php echo $order->getId()?>
        </td>
      </tr>
      <tr>
        <td style="vertical-align:top">
        </td>
        <td colspan="3" style="vertical-align:top;">
          <div class="f04-label" style="text-align:center;">
            (договор, заказ-наряд)
          </div>
        </td>
        <td style="text-align:right;vertical-align:bottom;border-left:1px solid silver;border-bottom:1px solid silver;">
          дата
        </td>
        <td style="border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;text-align:center;vertical-align:bottom;">
          <?php echo date("d.m.Y",strtotime($order->getSubmitedAt()))?>
        </td>
      </tr>
      <tr>
        <td colspan="4" style="text-align:right;">
          Транспортная накладная
        </td>
        <td style="text-align:right;vertical-align:bottom;border-left:1px solid silver;border-bottom:1px solid silver;">
          номер
        </td>
        <td style="border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;text-align:center;vertical-align:bottom;">
        </td>
      </tr>
      <tr>
        <td colspan="4">
        </td>
        <td style="text-align:right;vertical-align:bottom;border-left:1px solid silver;border-bottom:1px solid silver;">
          дата
        </td>
        <td style="border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;text-align:center;vertical-align:bottom;">
        </td>
      </tr>
      <tr>
        <td colspan="5" style="text-align:right;">
          Вид операции
        </td>
        <td style="border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid gray;text-align:center;vertical-align:bottom;">
        </td>
      </tr>
    </tbody>
  </table>
  <table class="bord-0">
    <colgroup>
      <col width="10%">
      <col width="180px">
      <col width="110px" span="2">
      <col width="auto">
    </colgroup>
    <tbody>
      <tr>
        <td>
        </td>
        <td>
        </td>
        <td style="text-align:center;vertical-align:middle;border-left:1px solid silver;border-top:1px solid silver;border-right:1px solid silver;">
          Номер документа
        </td>
        <td style="text-align:center;vertical-align:middle;border-left:1px solid silver;border-top:1px solid silver;border-right:1px solid silver;">
          Дата документа
        </td>
        <td>
        </td>
      </tr>
      <tr>
        <td colspan="2" style="text-align:right;font-weight:bold;">
          ТОВАРНАЯ НАКЛАДНАЯ&nbsp;
        </td>
        <td style="border-left:1px solid gray;border-top:1px solid gray;border-bottom:1px solid gray;border-right:1px solid silver;text-align:center;vertical-align:middle;">
          <?php echo $order->getWaybillNumber()?>
        </td>
        <td style="border-left:1px solid silver;border-right:1px solid gray;border-top:1px solid gray;border-bottom:1px solid gray;text-align:center;vertical-align:middle;">
          <?php echo date("d.m.Y",strtotime($order->getSubmitedAt()))?>
        </td>
        <td>
      </tr>
    </tbody>
  </table>
  <div style="text-align:right;">
    Страница 1
  </div>
  <!-- ШАПКА ЗАКОНЧЕНА-->
  <!-- ШАПКА ТОВАРОВ-->
  <table class="bord-2" style="margin-top:3px;">
    <colgroup>
      <col width="14px">
      <col width="auto">
      <col width="16px">
      <col width="30px">
      <col width="22px">
      <col width="24px">
      <col width="24px">
      <col width="20px">
      <col width="26px">
      <col width="24px">
      <col width="50px">
      <col width="50px">
      <col width="22px">
      <col width="40px">
      <col width="50px">
    </colgroup>
    <thead class="f04-th">
      <tr>
        <td rowspan="2">
          N
        <br>
          п/п
        </td>
        <td colspan="2">
          Товар
        </td>
        <td colspan="2">
          Единица измерения
        </td>
        <td rowspan="2">
          Вид упако- вки
        </td>
        <td colspan="2">
          Количество
        </td>
        <td rowspan="2">
          Масса брутто
        </td>
        <td rowspan="2">
          Коли- чество (масса нетто)
        </td>
        <td rowspan="2">
          Цена, руб. коп.
        </td>
        <td rowspan="2">
          Сумма без учёта НДС, руб. коп.
        </td>
        <td colspan="2">
          НДС
        </td>
        <td rowspan="2">
          Сумма с учётом НДС, руб. коп.
        </td>
      </tr>
      <tr>
        <td>
          наименование, характеристика, сорт, артикул товара
        </td>
        <td>
          код
        </td>
        <td>
          наиме- нование
        </td>
        <td>
          код по ОКЕИ
        </td>
        <td>
          в одном месте
        </td>
        <td>
          мест, штук
        </td>
        <td>
          ста- вка, %
        </td>
        <td>
          сумма, руб. коп.
        </td>
      </tr>
      <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>7</td>
        <td>8</td>
        <td>9</td>
        <td>10</td>
        <td>11</td>
        <td>12</td>
        <td>13</td>
        <td>14</td>
        <td>15</td>
      </tr>
    </thead>
<!------ ШАПКА ТОВАРОВ ЗАКОНЧЕНА --------->

<!------ ТОВАРЫ ------>
<?php //смотрим сколько всего позиций и если их меньше $countposonfpage то выводим все на экран ?>
<?php $number = count($order->getInvoices()) //Количество позиций?>
<?php $countposonfirstpage = $settings->getWaybillCountPosOnFirstPage(); //количество на первой странице?>
<?php $countposonfullpage = $settings->getWaybillCountPosOnFullPage(); //количество на полной странице?>
<?php $globalcounter = $countposonfirstpage //общий счетчик для вывода?>
<?php $countposonlastpage = $settings->getWaybillCountPosOnLastPage();  //количество на последней странице с футером?>
<?php $fullpagecount =(int)(($number - $countposonfirstpage) / $countposonfullpage) //Количество страниц по 15 пунктов?>
<?php $notfullpagecount =(($number - $countposonfirstpage) % $countposonfullpage) //Количество пунктов на неполную страницу?>
<?php $sharesumm = 0; // Общая сумма ?>
<?php $sharecount = 0; // Общее кол-во товара ?>
<?php $sharesummwithoutnds = 0; // Сумма без НДС ?>
<?php $sharesummnds = 0; // Сумма НДС в таблице?>
<?php $sheetscount = 2; // Сумма НДС в таблице?>

<?php //Если количество позиций <= $countposonfirstpage выводим ?>
<?php if($number <= $countposonfirstpage):?>
  <tbody>
  <?php $counter = 1?>
  <?php $tablesumm = 0; // Общая сумма таблици ?>
  <?php $tablecount = 0; // Общее кол-во товара в таблице ?>
  <?php $tablesummwithoutnds = 0; // Сумма без НДС в таблице ?>
  <?php $tablesummnds = 0; // Сумма НДС в таблице?>
  <?php foreach($order->getInvoices() as $invoice):?>
    <tr>
        <td style="text-align:right;">
          <?php echo $counter; $counter++?>
        </td>
        <td style="text-align:left;white-space:pre-wrap;">
          <?php // ОПИСАНИЕ ТОВАРА?>
          <?php echo $invoice->getDescription()?>
        </td>
        <td>
          -
        </td>
        <td>
          шт
        </td>
        <td>
          796
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          <?php // КОЛИЧЕСТВО?>
          <?php echo number_format($invoice->getNumber(),3,',',' ')?>
          <?php $tablecount += $invoice->getNumber() // Суммируем количество?>
        </td>
        <td style="text-align:right;">
          <?php // Цена без НДС?>
          <?php echo number_format(($invoice->getPrice() - $invoice->getPrice()*18/118),2,',',' ')?>

       </td>
        <td style="text-align:right;">
          <?php // СУММА БЕЗ НДС?>
          <?php echo number_format((($invoice->getPrice() - $invoice->getPrice()*18/118) * $invoice->getNumber()),2,',',' ')?>
          <?php  $tablesummwithoutnds += ($invoice->getPrice() - $invoice->getPrice()*18/118) * $invoice->getNumber()?>
        </td>
        <td>
          18%
        </td>
        <td style="text-align:right;">
          <?php // Сумма НДС?>
          <nobr><?php echo number_format(($invoice->getSum()*18/118),2,',',' ')?></nobr>
          <?php $tablesummnds += $invoice->getSum()*18/118 ?>
        </td>
        <td style="text-align:right;">
          <?php echo number_format($invoice->getSum(),2,',',' ')?>
          <?php $tablesumm += $invoice->getSum()?>
        </td>
      </tr>
  <?php endforeach;?>
  <!--Выводим итог по таблице и полный итог-->
    <tr>
      <td colspan="7" style="text-align:right;border:none;">
        Итого
      </td>
      <td>
        -
      </td>
      <td>
        -
      </td>
      <td>
          <?php // КОЛИЧЕСТВО ТОВАРА В ТАБЛИЦЕ?>
          <?php echo number_format($tablecount,3,',',' ')?>
          <?php $sharecount += $tablecount?>
      </td>
      <td>
        X
      </td>
      <td style="text-align:right;">
       <?php // Сумма без учёта НДС?>
       <?php echo number_format($tablesummwithoutnds,2,',',' ')?>
       <?php $sharesummwithoutnds += $tablesummwithoutnds?>

      </td>
      <td>
        X
      </td>
      <td style="text-align:right;">
        <?php // Сумма НДС?>
        <?php echo number_format($tablesummnds,2,',',' ')?>
        <?php $sharesummnds += $tablesummnds?>
      </td>
      <td style="text-align:right;">
        <nobr><?php echo number_format($tablesumm,2,',',' ')?></nobr>
        <?php $sharesumm += $tablesumm?>
      </td>
    </tr>
  </tbody>
  <tfoot class="f04-td">
      <tr>
        <td colspan="7" style="text-align:right;border:none;">
          Всего по накладной
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          <?php //Общее количество товара?>
          <?php echo number_format($sharecount,3,',',' ')?>
        </td>
        <td>
          X
        </td>
        <td style="text-align:right;">
          <?php //Общая цена товара без НДС?>
          <?php echo number_format($sharesummwithoutnds ,2,',',' ')?>
        </td>
        <td>
          X
        </td>
        <td style="text-align:right;">
          <?php //Общая цена товара без НДС?>
          <?php echo number_format($sharesummnds ,2,',',' ')?>
        </td>
        <td style="text-align:right;">
          <?php //Общая цена товара без НДС?>
          <?php echo number_format($sharesumm,2,',',' ')?>
        </td>
      </tr>
    </tfoot>
  </table>
</div> <!-- завершаем главную страницу-->
<div class="page-landscape f04 tn-929">
      <div class="border-page">
        <div style="position:absolute;bottom:0;right:0;" class="f04-label">
        </div>
      </div>
  <table class="bord-0 f04-td" style="margin-top:8px;">
    <colgroup>
      <col width="194px">
      <col width="20px">
      <col width="90px">
      <col width="auto">
      <col width="142px">
    </colgroup>
    <tbody>
      <tr>
        <td>
          Товарная накладная имеет приложение на
        </td>
        <td style="border-bottom:1px solid silver;">
          <?php if ($notfullpagecount <= 0){
                    echo ($fullpagecount + 2);
                }
          ?>
          <?php if ($notfullpagecount > 0 && $notfullpagecount <= $countposonlastpage){
                    echo ($fullpagecount + 2);
                }
          ?>
          <?php if ($notfullpagecount > $countposonlastpage){
                    echo ($fullpagecount + 3);
                }
          ?>
        </td>
        <td>
          листах и содержит
        </td>
        <td style="border-bottom:1px solid silver;">
          <?php
            echo num2str($globalcounter);
          ?>
        </td>
        <td>
          порядковых номеров записей
        </td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="vertical-align:top">
          <div class="f04-label" style="text-align:center;">
            (прописью)
          </div>
        </td>
        <td></td>
      </tr>
    </tbody>
</table>

<table class="bord-0 f04-td" style="border-collapse:separate;">
  <colgroup>
    <col width="56px">
    <col width="190px">
    <col width="110px">
    <col width="auto">
    <col width="10px">
    <col width="150px">
  </colgroup>
  <tbody>
    <tr>
      <td rowspan="2" style="vertical-align:bottom;">
        Всего мест
      </td>
      <td></td>
      <td>&nbsp;
        Масса груза (нетто)
      </td>
      <td style="border-bottom:1px solid silver;">
      </td>
      <td></td>
      <td style="text-align:center;border-left:1px solid gray;border-top:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;">
      </td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid silver;vertical-align:bottom;">
        -
      </td>
      <td style="vertical-align:bottom;">&nbsp;
        Масса груза (брутто)
      </td>
      <td style="border-bottom:1px solid silver;vertical-align:top;">
        <div class="f04-label" style="text-align:center;">
          (прописью)
        </div>
      </td>
      <td></td>
      <td style="text-align:center;border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid gray;">
      </td>
    </tr>
    <tr>
      <td></td>
      <td style="vertical-align:top">
        <div class="f04-label" style="text-align:center;">
          (прописью)
        </div>
      </td>
      <td></td>
      <td style="vertical-align:top">
        <div class="f04-label" style="text-align:center;">
          (прописью)
        </div>
      </td>
      <td colspan="2"></td>
    </tr>
  </tbody>
</table>

<table class="bord-0 f04-td">
  <colgroup>
    <col width="46%">
    <col width="54%">
  </colgroup>
  <tbody>
    <tr>
      <td style="padding:0 6px 0 0;">
        <table class="bord-0">
          <colgroup>
            <col width="224px">
            <col width="auto">
            <col width="40px">
          </colgroup>
          <tbody>
            <tr>
              <td style="vertical-align:bottom;">
                Приложение (паспорта, сертификаты и т. п.) на
              </td>
              <td style="border-bottom:1px solid silver;">
                -
              </td>
              <td style="vertical-align:bottom;">
                листах
              </td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (прописью)
                </div>
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
        <table class="bord-0">
          <colgroup>
            <col width="80px">
            <col width="auto">
          </colgroup>
          <tbody>
            <tr>
              <td rowspan="2">
                Всего отпущено на сумму
              </td>
              <td style="border-bottom:1px solid silver;">
                <?php
                  echo num2rub($sharesumm)
                ?>
              </td>
            </tr>
            <tr>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (прописью)
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="bord-0">
          <colgroup><col width="70px">
            <col width="90px">
            <col width="6px">
            <col width="auto">
            <col width="6px">
            <col width="90px">
          </colgroup>
          <tbody>
            <tr>
              <td rowspan="2">
                Отпуск груза разрешил
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
                <div style="position:relative;">&nbsp;
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="position:absolute;top:-20px;">
                </div>
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;vertical-align:bottom;"></td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
            <tr>
              <td rowspan="2" colspan="2">
                Главный (старший) бухгалтер
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
                <div style="position:relative;">&nbsp;
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                </div>
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
            <tr>
              <td rowspan="2">
                Отпуск груза произвел
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
                <div style="position:relative;">&nbsp;
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                </div>
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;vertical-align:bottom;"></td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
      <td style="border-left:1px solid gray;padding-left:6px;">
        <table class="bord-0">
          <colgroup>
            <col width="100px">
            <col width="auto">
          </colgroup>
          <tbody>
            <tr>
              <td>
                По доверенности №
              </td>
              <td style="border-bottom:1px solid silver;"></td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (номер, дата доверенности)
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="bord-0">
          <colgroup>
            <col width="50px">
            <col width="auto">
          </colgroup>
          <tbody>
            <tr>
              <td>
                выданной
              </td>
              <td colspan="2" style="border-bottom:1px solid silver;">&nbsp;</td>
            </tr>
            <tr>
              <td style="border-bottom:1px solid silver;"></td>
              <td style="height:26px;border-bottom:1px solid silver;vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (кем, кому (организация, должность, фамилия, и., о.))
                </div>&nbsp;
              </td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">&nbsp;
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="bord-0">
          <colgroup>
            <col width="86px">
            <col width="90px">
            <col width="6px">
            <col width="auto">
            <col width="6px">
            <col width="90px">
          </colgroup>
          <tbody>
            <tr>
              <td rowspan="2">
                Груз принял
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;">&nbsp;
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;">
              </td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
            <tr>
              <td rowspan="2">
                Груз получил грузополучатель
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;">&nbsp;</td>
              <td></td>
              <td style="border-bottom:1px solid silver;"></td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td style="text-align:center">
        <div style="position:relative;">&nbsp;
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:213px;height:auto;position:absolute;top:-92px;left:0;z-index:-1;">
          </div>
          М. П.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php 
              $monthes = array(
                              1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
                              5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
                              9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
              echo("\"".date("d",strtotime($order->getSubmitedAt()))."\""." ".$monthes[date('n',strtotime($order->getSubmitedAt()))] . date(' Y',strtotime($order->getSubmitedAt())));
          ?> года
      </td>
      <td style="text-align:center">
        М. П.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php 
              $monthes = array(
                              1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
                              5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
                              9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
              echo("\"".date("d",strtotime($order->getSubmitedAt()))."\""." ".$monthes[date('n',strtotime($order->getSubmitedAt()))] . date(' Y',strtotime($order->getSubmitedAt())));
          ?> года
      </td>
    </tr>
  </tbody>
</table>
</div>
<?php endif;?>
<?php $invoices = $order->getInvoices()?>
<?php if($number > $countposonfirstpage)://Если страница не одна то выводим первую в $countposonfirstpage позиций?>
  <tbody>
  <?php $counter = 1?>
  <?php $tablesumm = 0; // Общая сумма таблици ?>
  <?php $tablecount = 0; // Общее кол-во товара в таблице ?>
  <?php $tablesummwithoutnds = 0; // Сумма без НДС в таблице ?>
  <?php $tablesummnds = 0; // Сумма НДС в таблице?>
  <?php for ($i = 0; $i< $countposonfirstpage; $i++):?>
    <tr>
        <td style="text-align:right;">
          <?php echo $counter; $counter++?>
        </td>
        <td style="text-align:left;white-space:pre-wrap;">
          <?php // ОПИСАНИЕ ТОВАРА?>
          <?php echo $invoices[$i]->getDescription()?>
        </td>
        <td>
          -
        </td>
        <td>
          шт
        </td>
        <td>
          796
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          <?php // КОЛИЧЕСТВО?>
          <?php echo number_format($invoices[$i]->getNumber(),3,',',' ')?>
          <?php $tablecount += $invoices[$i]->getNumber() // Суммируем количество?>
        </td>
        <td style="text-align:right;">
          <?php // Цена без НДС?>
          <?php echo number_format(($invoices[$i]->getPrice() - $invoices[$i]->getPrice()*18/118),2,',',' ')?>
        </td>
        <td style="text-align:right;">
          <?php // СУММА БЕЗ НДС?>
          <?php echo number_format((($invoices[$i]->getPrice() - $invoices[$i]->getPrice()*18/118) * $invoices[$i]->getNumber()),2,',',' ')?>
          <?php  $tablesummwithoutnds += ($invoices[$i]->getPrice() - $invoices[$i]->getPrice()*18/118) * $invoices[$i]->getNumber()?>
        </td>
        <td>
          18%
        </td>
        <td style="text-align:right;">
          <?php // Сумма НДС?>
          <nobr><?php echo number_format(($invoices[$i]->getSum()*18/118),2,',',' ')?></nobr>
          <?php $tablesummnds += $invoices[$i]->getSum()*18/118 ?>
        </td>
        <td style="text-align:right;">
          <?php echo number_format($invoices[$i]->getSum(),2,',',' ')?>
          <?php $tablesumm += $invoices[$i]->getSum()?>
        </td>
      </tr>
  <?php endfor?>
    <tr>
      <td colspan="7" style="text-align:right;border:none;">
        Итого
      </td>
      <td>
        -
      </td>
      <td>
        -
      </td>
      <td>
        <?php // КОЛИЧЕСТВО ТОВАРА В ТАБЛИЦЕ?>
        <?php echo number_format($tablecount,3,',',' ')?>
        <?php $sharecount += $tablecount?>
      </td>
      <td>
        X
      </td>
      <td style="text-align:right;">
       <?php // Сумма без учёта НДС?>
       <?php echo number_format($tablesummwithoutnds,2,',',' ')?>
       <?php $sharesummwithoutnds += $tablesummwithoutnds?>
      </td>
      <td>
        X
      </td>
      <td style="text-align:right;">
        <?php // Сумма НДС?>
        <?php echo number_format($tablesummnds,2,',',' ')?>
        <?php $sharesummnds += $tablesummnds?>
      </td>
      <td style="text-align:right;">
        <nobr><?php echo number_format($tablesumm,2,',',' ')?></nobr>
        <?php $sharesumm += $tablesumm?>
      </td>
    </tr>
  </tbody>
 </table>
</div>
<?php //=============================================================================================================?>
  <?php // Выводим количество полных страниц?>
  <?php for ($j=0; $j < $fullpagecount; $j++ ):?>
<?php //Создаем новую страницу ?>
<div class="page-landscape f04 tn-929">
  <div class="border-page">
    <div style="position:absolute;bottom:0;right:0;" class="f04-label">
    </div>
  </div>
<!-- ШАПКА ТОВАРОВ-->
  <div style="text-align:right;">
    <?php echo "Страница ".$sheetscount;$sheetscount++?>
  </div>
  <table class="bord-2" style="margin-top:3px;">
    <colgroup>
      <col width="14px">
      <col width="auto">
      <col width="16px">
      <col width="30px">
      <col width="22px">
      <col width="24px">
      <col width="24px">
      <col width="20px">
      <col width="26px">
      <col width="24px">
      <col width="50px">
      <col width="50px">
      <col width="22px">
      <col width="40px">
      <col width="50px">
    </colgroup>
    <thead class="f04-th">
      <tr>
        <td rowspan="2">
          N
        <br>
          п/п
        </td>
        <td colspan="2">
          Товар
        </td>
        <td colspan="2">
          Единица измерения
        </td>
        <td rowspan="2">
          Вид упако- вки
        </td>
        <td colspan="2">
          Количество
        </td>
        <td rowspan="2">
          Масса брутто
        </td>
        <td rowspan="2">
          Коли- чество (масса нетто)
        </td>
        <td rowspan="2">
          Цена, руб. коп.
        </td>
        <td rowspan="2">
          Сумма без учёта НДС, руб. коп.
        </td>
        <td colspan="2">
          НДС
        </td>
        <td rowspan="2">
          Сумма с учётом НДС, руб. коп.
        </td>
      </tr>
      <tr>
        <td>
          наименование, характеристика, сорт, артикул товара
        </td>
        <td>
          код
        </td>
        <td>
          наиме- нование
        </td>
        <td>
          код по ОКЕИ
        </td>
        <td>
          в одном месте
        </td>
        <td>
          мест, штук
        </td>
        <td>
          ста- вка, %
        </td>
        <td>
          сумма, руб. коп.
        </td>
      </tr>
      <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>7</td>
        <td>8</td>
        <td>9</td>
        <td>10</td>
        <td>11</td>
        <td>12</td>
        <td>13</td>
        <td>14</td>
        <td>15</td>
      </tr>
    </thead>
<!------ ШАПКА ТОВАРОВ ЗАКОНЧЕНА --------->
<!------ ТОВАРЫ ------>
    <?php for ($i = 0; $i < 15; $i++):?>
    <tr>
        <td style="text-align:right;">
          <?php echo $counter; $counter++; $globalcounter++?>
        </td>
        <td style="text-align:left;white-space:pre-wrap;">
          <?php // ОПИСАНИЕ ТОВАРА?>
          <?php echo $invoices[$globalcounter]->getDescription()?>
        </td>
        <td>
          -
        </td>
        <td>
          шт
        </td>
        <td>
          796
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          <?php // КОЛИЧЕСТВО?>
          <?php echo number_format($invoices[$globalcounter]->getNumber(),3,',',' ')?>
          <?php $tablecount += $invoices[$globalcounter]->getNumber() // Суммируем количество?>
        </td>
        <td style="text-align:right;">
          <?php // Цена без НДС?>
          <?php echo number_format(($invoices[$globalcounter]->getPrice() - $invoices[$globalcounter]->getPrice()*18/118),2,',',' ')?>
        </td>
        <td style="text-align:right;">
          <?php // СУММА БЕЗ НДС?>
          <?php echo number_format((($invoices[$globalcounter]->getPrice() - $invoices[$globalcounter]->getPrice()*18/118) * $invoices[$globalcounter]->getNumber()),2,',',' ')?>
          <?php  $tablesummwithoutnds += ($invoices[$globalcounter]->getPrice() - $invoices[$globalcounter]->getPrice()*18/118) * $invoices[$globalcounter]->getNumber()?>
        </td>
        <td>
          18%
        </td>
        <td style="text-align:right;">
          <?php // Сумма НДС?>
          <nobr><?php echo number_format(($invoices[$globalcounter]->getSum()*18/118),2,',',' ')?></nobr>
          <?php $tablesummnds += $invoices[$globalcounter]->getSum()*18/118 ?>
        </td>
        <td style="text-align:right;">
          <?php echo number_format($invoices[$globalcounter]->getSum(),2,',',' ')?>
          <?php $tablesumm += $invoices[$globalcounter]->getSum()?>
        </td>
      </tr>
    <?php endfor?>
      <tr>
        <td colspan="7" style="text-align:right;border:none;">
          Итого
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          <?php // КОЛИЧЕСТВО ТОВАРА В ТАБЛИЦЕ?>
          <?php echo number_format($tablecount,3,',',' ')?>
          <?php $sharecount += $tablecount?>
        </td>
        <td>
          X
        </td>
        <td style="text-align:right;">
          <?php // Сумма без учёта НДС?>
          <?php echo number_format($tablesummwithoutnds,2,',',' ')?>
          <?php $sharesummwithoutnds += $tablesummwithoutnds?>
        </td>
        <td>
          X
        </td>
        <td style="text-align:right;">
          <?php // Сумма НДС?>
          <?php echo number_format($tablesummnds,2,',',' ')?>
          <?php $sharesummnds += $tablesummnds?>
        </td>
        <td style="text-align:right;">
          <nobr><?php echo number_format($tablesumm,2,',',' ')?></nobr>
          <?php $sharesumm += $tablesumm?>
        </td>
      </tr>
    </tbody>
    <?php //ЕСЛИ НЕПОЛНЫХ СТРАНИЦ НЕТ ТО ВЫВОДИМ ПОЛНЫЙ ИТОГ?>
      <?php if ($notfullpagecount == 0):?>
        <tfoot class="f04-td">
          <tr>
            <td colspan="7" style="text-align:right;border:none;">
              Всего по накладной
            </td>
            <td>
              -
            </td>
            <td>
              -
            </td>
            <td>
              <?php //Общее количество товара?>
              <?php echo number_format($sharecount,3,',',' ')?>
            </td>
            <td>
              X
            </td>
            <td style="text-align:right;">
              <?php //Общая цена товара без НДС?>
              <?php echo number_format($sharesummwithoutnds ,2,',',' ')?>
            </td>
            <td>
              X
            </td>
            <td style="text-align:right;">
              <?php //Общая цена товара без НДС?>
              <?php echo number_format($sharesummnds ,2,',',' ')?>
            </td>
            <td style="text-align:right;">
              <?php //Общая цена товара без НДС?>
              <?php echo number_format($sharesumm,2,',',' ')?>
            </td>
          </tr>
        </tfoot>
    </table>
  </div> <!-- завершаем главную страницу-->
    <?php endif;?>
    <?php if ($notfullpagecount !=0):?>
      </table>
    </div>
    <?php endif;?>
  <?php endfor;?>

<!--=================================================================================================================-->

  <?php //вывод неполных страниц ?>
  <?php if ($notfullpagecount == 0)://Если неполных нет то выводим сразу футер?>
      <div class="page-landscape f04 tn-929">
      <div class="border-page">
        <div style="position:absolute;bottom:0;right:0;" class="f04-label">
        </div>
      </div>
  <table class="bord-0 f04-td" style="margin-top:8px;">
    <colgroup>
      <col width="194px">
      <col width="20px">
      <col width="90px">
      <col width="auto">
      <col width="142px">
    </colgroup>
    <tbody>
      <tr>
        <td>
          Товарная накладная имеет приложение на
        </td>
        <td style="border-bottom:1px solid silver;">
          <?php if ($notfullpagecount <= 0){
                    echo ($fullpagecount + 2);
                }
          ?>
          <?php if ($notfullpagecount > 0 && $notfullpagecount <= $countposonlastpage){
                    echo ($fullpagecount + 2);
                }
          ?>
          <?php if ($notfullpagecount > $countposonlastpage){
                    echo ($fullpagecount + 3);
                }
          ?>
        </td>
        <td>
          листах и содержит
        </td>
        <td style="border-bottom:1px solid silver;">
          <?php
            echo num2str($globalcounter);
          ?>
        </td>
        <td>
          порядковых номеров записей
        </td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="vertical-align:top">
          <div class="f04-label" style="text-align:center;">
            (прописью)
          </div>
        </td>
        <td></td>
      </tr>
    </tbody>
</table>

<table class="bord-0 f04-td" style="border-collapse:separate;">
  <colgroup>
    <col width="56px">
    <col width="190px">
    <col width="110px">
    <col width="auto">
    <col width="10px">
    <col width="150px">
  </colgroup>
  <tbody>
    <tr>
      <td rowspan="2" style="vertical-align:bottom;">
        Всего мест
      </td>
      <td></td>
      <td>&nbsp;
        Масса груза (нетто)
      </td>
      <td style="border-bottom:1px solid silver;">
      </td>
      <td></td>
      <td style="text-align:center;border-left:1px solid gray;border-top:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;">
      </td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid silver;vertical-align:bottom;">
        -
      </td>
      <td style="vertical-align:bottom;">&nbsp;
        Масса груза (брутто)
      </td>
      <td style="border-bottom:1px solid silver;vertical-align:top;">
        <div class="f04-label" style="text-align:center;">
          (прописью)
        </div>
      </td>
      <td></td>
      <td style="text-align:center;border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid gray;">
      </td>
    </tr>
    <tr>
      <td></td>
      <td style="vertical-align:top">
        <div class="f04-label" style="text-align:center;">
          (прописью)
        </div>
      </td>
      <td></td>
      <td style="vertical-align:top">
        <div class="f04-label" style="text-align:center;">
          (прописью)
        </div>
      </td>
      <td colspan="2"></td>
    </tr>
  </tbody>
</table>

<table class="bord-0 f04-td">
  <colgroup>
    <col width="46%">
    <col width="54%">
  </colgroup>
  <tbody>
    <tr>
      <td style="padding:0 6px 0 0;">
        <table class="bord-0">
          <colgroup>
            <col width="224px">
            <col width="auto">
            <col width="40px">
          </colgroup>
          <tbody>
            <tr>
              <td style="vertical-align:bottom;">
                Приложение (паспорта, сертификаты и т. п.) на
              </td>
              <td style="border-bottom:1px solid silver;">
                -
              </td>
              <td style="vertical-align:bottom;">
                листах
              </td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (прописью)
                </div>
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
        <table class="bord-0">
          <colgroup>
            <col width="80px">
            <col width="auto">
          </colgroup>
          <tbody>
            <tr>
              <td rowspan="2">
                Всего отпущено на сумму
              </td>
              <td style="border-bottom:1px solid silver;">
                <?php
                  echo num2rub($sharesumm)
                ?>
              </td>
            </tr>
            <tr>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (прописью)
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="bord-0">
          <colgroup><col width="70px">
            <col width="90px">
            <col width="6px">
            <col width="auto">
            <col width="6px">
            <col width="90px">
          </colgroup>
          <tbody>
            <tr>
              <td rowspan="2">
                Отпуск груза разрешил
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
                <div style="position:relative;">&nbsp;
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="position:absolute;top:-20px;">
                </div>
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;vertical-align:bottom;"></td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
            <tr>
              <td rowspan="2" colspan="2">
                Главный (старший) бухгалтер
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
                <div style="position:relative;">&nbsp;
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                </div>
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
            <tr>
              <td rowspan="2">
                Отпуск груза произвел
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
                <div style="position:relative;">&nbsp;
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                </div>
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;vertical-align:bottom;"></td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
      <td style="border-left:1px solid gray;padding-left:6px;">
        <table class="bord-0">
          <colgroup>
            <col width="100px">
            <col width="auto">
          </colgroup>
          <tbody>
            <tr>
              <td>
                По доверенности №
              </td>
              <td style="border-bottom:1px solid silver;"></td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (номер, дата доверенности)
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="bord-0">
          <colgroup>
            <col width="50px">
            <col width="auto">
          </colgroup>
          <tbody>
            <tr>
              <td>
                выданной
              </td>
              <td colspan="2" style="border-bottom:1px solid silver;">&nbsp;</td>
            </tr>
            <tr>
              <td style="border-bottom:1px solid silver;"></td>
              <td style="height:26px;border-bottom:1px solid silver;vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (кем, кому (организация, должность, фамилия, и., о.))
                </div>&nbsp;
              </td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">&nbsp;
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="bord-0">
          <colgroup>
            <col width="86px">
            <col width="90px">
            <col width="6px">
            <col width="auto">
            <col width="6px">
            <col width="90px">
          </colgroup>
          <tbody>
            <tr>
              <td rowspan="2">
                Груз принял
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;">&nbsp;
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;">
              </td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
            <tr>
              <td rowspan="2">
                Груз получил грузополучатель
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;">&nbsp;</td>
              <td></td>
              <td style="border-bottom:1px solid silver;"></td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td style="text-align:center">
        <div style="position:relative;">&nbsp;
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:213px;height:auto;position:absolute;top:-92px;left:0;z-index:-1;">
          </div>
          М. П.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php 
              $monthes = array(
                              1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
                              5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
                              9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
              echo("\"".date("d",strtotime($order->getSubmitedAt()))."\""." ".$monthes[date('n',strtotime($order->getSubmitedAt()))] . date(' Y',strtotime($order->getSubmitedAt())));
          ?> года
      </td>
      <td style="text-align:center">
        М. П.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php 
              $monthes = array(
                              1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
                              5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
                              9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
              echo("\"".date("d",strtotime($order->getSubmitedAt()))."\""." ".$monthes[date('n',strtotime($order->getSubmitedAt()))] . date(' Y',strtotime($order->getSubmitedAt())));
          ?> года
      </td>
    </tr>
  </tbody>
</table>
</div>
  <?php endif;// if ($notfullpagecount == 0)://Если неполных нет то выводим сразу футер?>

<!--===================================================================================================================-->

  <?php if ($notfullpagecount > 0 && $notfullpagecount <= $countposonlastpage):// если есть неполная страница и пунктов меньше $countposonlastpage?>
  <?php // выводим товары ?>
    <div class="page-landscape f04 tn-929">
      <div class="border-page">
        <div style="position:absolute;bottom:0;right:0;" class="f04-label">
        </div>
      </div>
<!-- ШАПКА ТОВАРОВ-->
<div style="text-align:right;">
    <?php echo "Страница ".$sheetscount;$sheetscount++?>
  </div>
  <table class="bord-2" style="margin-top:3px;">
    <colgroup>
      <col width="14px">
      <col width="auto">
      <col width="16px">
      <col width="30px">
      <col width="22px">
      <col width="24px">
      <col width="24px">
      <col width="20px">
      <col width="26px">
      <col width="24px">
      <col width="50px">
      <col width="50px">
      <col width="22px">
      <col width="40px">
      <col width="50px">
    </colgroup>
    <thead class="f04-th">
      <tr>
        <td rowspan="2">
          N
        <br>
          п/п
        </td>
        <td colspan="2">
          Товар
        </td>
        <td colspan="2">
          Единица измерения
        </td>
        <td rowspan="2">
          Вид упако- вки
        </td>
        <td colspan="2">
          Количество
        </td>
        <td rowspan="2">
          Масса брутто
        </td>
        <td rowspan="2">
          Коли- чество (масса нетто)
        </td>
        <td rowspan="2">
          Цена, руб. коп.
        </td>
        <td rowspan="2">
          Сумма без учёта НДС, руб. коп.
        </td>
        <td colspan="2">
          НДС
        </td>
        <td rowspan="2">
          Сумма с учётом НДС, руб. коп.
        </td>
      </tr>
      <tr>
        <td>
          наименование, характеристика, сорт, артикул товара
        </td>
        <td>
          код
        </td>
        <td>
          наиме- нование
        </td>
        <td>
          код по ОКЕИ
        </td>
        <td>
          в одном месте
        </td>
        <td>
          мест, штук
        </td>
        <td>
          ста- вка, %
        </td>
        <td>
          сумма, руб. коп.
        </td>
      </tr>
      <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>7</td>
        <td>8</td>
        <td>9</td>
        <td>10</td>
        <td>11</td>
        <td>12</td>
        <td>13</td>
        <td>14</td>
        <td>15</td>
      </tr>
    </thead>
<!------ ШАПКА ТОВАРОВ ЗАКОНЧЕНА --------->

<!------ ТОВАРЫ ------>

    <?php for ($i = 0; $i < $number - $globalcounter; $i++):?>
    <tr>
        <td style="text-align:right;">
          <?php echo $counter; $counter++;$globalcounter++?>
        </td>
        <td style="text-align:left;white-space:pre-wrap;">
          <?php // ОПИСАНИЕ ТОВАРА?>
          <?php echo $invoices[$globalcounter]->getDescription()?>
        </td>
        <td>
          -
        </td>
        <td>
          шт
        </td>
        <td>
          796
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          <?php // КОЛИЧЕСТВО?>
          <?php echo number_format($invoices[$globalcounter]->getNumber(),3,',',' ')?>
          <?php $tablecount += $invoices[$globalcounter]->getNumber() // Суммируем количество?>
        </td>
        <td style="text-align:right;">
          <?php // Цена без НДС?>
          <?php echo number_format(($invoices[$globalcounter]->getPrice() - $invoices[$globalcounter]->getPrice()*18/118),2,',',' ')?>

        </td>
        <td style="text-align:right;">
          <?php // СУММА БЕЗ НДС?>
          <?php echo number_format((($invoices[$globalcounter]->getPrice() - $invoices[$globalcounter]->getPrice()*18/118) * $invoices[$globalcounter]->getNumber()),2,',',' ')?>
          <?php  $tablesummwithoutnds += ($invoices[$globalcounter]->getPrice() - $invoices[$globalcounter]->getPrice()*18/118) * $invoices[$globalcounter]->getNumber()?>
        </td>
        <td>
          18%
        </td>
        <td style="text-align:right;">
          <?php // Сумма НДС?>
          <nobr><?php echo number_format(($invoices[$globalcounter]->getSum()*18/118),2,',',' ')?></nobr>
          <?php $tablesummnds += $invoices[$globalcounter]->getSum()*18/118 ?>
        </td>
        <td style="text-align:right;">
          <?php echo number_format($invoices[$globalcounter]->getSum(),2,',',' ')?>
          <?php $tablesumm += $invoices[$globalcounter]->getSum()?>
        </td>
      </tr>
    <?php endfor?>
      <tr>
        <td colspan="7" style="text-align:right;border:none;">
          Итого
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          <?php // КОЛИЧЕСТВО ТОВАРА В ТАБЛИЦЕ?>
          <?php echo number_format($tablecount,3,',',' ')?>
          <?php $sharecount += $tablecount?>
        </td>
        <td>
          X
        </td>
        <td style="text-align:right;">
          <?php // Сумма без учёта НДС?>
          <?php echo number_format($tablesummwithoutnds,2,',',' ')?>
          <?php $sharesummwithoutnds += $tablesummwithoutnds?>
        </td>
        <td>
          X
        </td>
        <td style="text-align:right;">
          <?php // Сумма НДС?>
          <?php echo number_format($tablesummnds,2,',',' ')?>
          <?php $sharesummnds += $tablesummnds?>
        </td>
        <td style="text-align:right;">
          <nobr><?php echo number_format($tablesumm,2,',',' ')?></nobr>
          <?php $sharesumm += $tablesumm?>
        </td>
      </tr>
    </tbody>
    <tfoot class="f04-td">
          <tr>
            <td colspan="7" style="text-align:right;border:none;">
              Всего по накладной
            </td>
            <td>
              -
            </td>
            <td>
              -
            </td>
            <td>
              <?php //Общее количество товара?>
              <?php echo number_format($sharecount,3,',',' ')?>
            </td>
            <td>
              X
            </td>
            <td style="text-align:right;">
              <?php //Общая цена товара без НДС?>
              <?php echo number_format($sharesummwithoutnds ,2,',',' ')?>
            </td>
            <td>
              X
            </td>
            <td style="text-align:right;">
              <?php //Общая цена товара без НДС?>
              <?php echo number_format($sharesummnds ,2,',',' ')?>
            </td>
            <td style="text-align:right;">
              <?php //Общая цена товара без НДС?>
              <?php echo number_format($sharesumm,2,',',' ')?>
            </td>
          </tr>
        </tfoot>
   </table>
   <table class="bord-0 f04-td" style="margin-top:8px;">
    <colgroup>
      <col width="194px">
      <col width="20px">
      <col width="90px">
      <col width="auto">
      <col width="142px">
    </colgroup>
    <tbody>
      <tr>
        <td>
          Товарная накладная имеет приложение на
        </td>
        <td style="border-bottom:1px solid silver;">
          <?php if ($notfullpagecount <= 0){
                    echo ($fullpagecount + 2);
                }
          ?>
          <?php if ($notfullpagecount > 0 && $notfullpagecount <= $countposonlastpage){
                    echo ($fullpagecount + 2);
                }
          ?>
          <?php if ($notfullpagecount > $countposonlastpage){
                    echo ($fullpagecount + 3);
                }
          ?>
        </td>
        <td>
          листах и содержит
        </td>
        <td style="border-bottom:1px solid silver;">
          <?php
            echo num2str($globalcounter);
          ?>
        </td>
        <td>
          порядковых номеров записей
        </td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="vertical-align:top">
          <div class="f04-label" style="text-align:center;">
            (прописью)
          </div>
        </td>
        <td></td>
      </tr>
    </tbody>
</table>

<table class="bord-0 f04-td" style="border-collapse:separate;">
  <colgroup>
    <col width="56px">
    <col width="190px">
    <col width="110px">
    <col width="auto">
    <col width="10px">
    <col width="150px">
  </colgroup>
  <tbody>
    <tr>
      <td rowspan="2" style="vertical-align:bottom;">
        Всего мест
      </td>
      <td></td>
      <td>&nbsp;
        Масса груза (нетто)
      </td>
      <td style="border-bottom:1px solid silver;">
      </td>
      <td></td>
      <td style="text-align:center;border-left:1px solid gray;border-top:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;">
      </td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid silver;vertical-align:bottom;">
        -
      </td>
      <td style="vertical-align:bottom;">&nbsp;
        Масса груза (брутто)
      </td>
      <td style="border-bottom:1px solid silver;vertical-align:top;">
        <div class="f04-label" style="text-align:center;">
          (прописью)
        </div>
      </td>
      <td></td>
      <td style="text-align:center;border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid gray;">
      </td>
    </tr>
    <tr>
      <td></td>
      <td style="vertical-align:top">
        <div class="f04-label" style="text-align:center;">
          (прописью)
        </div>
      </td>
      <td></td>
      <td style="vertical-align:top">
        <div class="f04-label" style="text-align:center;">
          (прописью)
        </div>
      </td>
      <td colspan="2"></td>
    </tr>
  </tbody>
</table>

<table class="bord-0 f04-td">
  <colgroup>
    <col width="46%">
    <col width="54%">
  </colgroup>
  <tbody>
    <tr>
      <td style="padding:0 6px 0 0;">
        <table class="bord-0">
          <colgroup>
            <col width="224px">
            <col width="auto">
            <col width="40px">
          </colgroup>
          <tbody>
            <tr>
              <td style="vertical-align:bottom;">
                Приложение (паспорта, сертификаты и т. п.) на
              </td>
              <td style="border-bottom:1px solid silver;">
                -
              </td>
              <td style="vertical-align:bottom;">
                листах
              </td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (прописью)
                </div>
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
        <table class="bord-0">
          <colgroup>
            <col width="80px">
            <col width="auto">
          </colgroup>
          <tbody>
            <tr>
              <td rowspan="2">
                Всего отпущено на сумму
              </td>
              <td style="border-bottom:1px solid silver;">
                <?php
                  echo num2rub($sharesumm)
                ?>
              </td>
            </tr>
            <tr>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (прописью)
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="bord-0">
          <colgroup><col width="70px">
            <col width="90px">
            <col width="6px">
            <col width="auto">
            <col width="6px">
            <col width="90px">
          </colgroup>
          <tbody>
            <tr>
              <td rowspan="2">
                Отпуск груза разрешил
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
                <div style="position:relative;">&nbsp;
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="position:absolute;top:-20px;">
                </div>
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;vertical-align:bottom;"></td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
            <tr>
              <td rowspan="2" colspan="2">
                Главный (старший) бухгалтер
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
                <div style="position:relative;">&nbsp;
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                </div>
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
            <tr>
              <td rowspan="2">
                Отпуск груза произвел
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
                <div style="position:relative;">&nbsp;
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                </div>
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;vertical-align:bottom;"></td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
      <td style="border-left:1px solid gray;padding-left:6px;">
        <table class="bord-0">
          <colgroup>
            <col width="100px">
            <col width="auto">
          </colgroup>
          <tbody>
            <tr>
              <td>
                По доверенности №
              </td>
              <td style="border-bottom:1px solid silver;"></td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (номер, дата доверенности)
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="bord-0">
          <colgroup>
            <col width="50px">
            <col width="auto">
          </colgroup>
          <tbody>
            <tr>
              <td>
                выданной
              </td>
              <td colspan="2" style="border-bottom:1px solid silver;">&nbsp;</td>
            </tr>
            <tr>
              <td style="border-bottom:1px solid silver;"></td>
              <td style="height:26px;border-bottom:1px solid silver;vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (кем, кому (организация, должность, фамилия, и., о.))
                </div>&nbsp;
              </td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">&nbsp;
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="bord-0">
          <colgroup>
            <col width="86px">
            <col width="90px">
            <col width="6px">
            <col width="auto">
            <col width="6px">
            <col width="90px">
          </colgroup>
          <tbody>
            <tr>
              <td rowspan="2">
                Груз принял
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;">&nbsp;
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;">
              </td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
            <tr>
              <td rowspan="2">
                Груз получил грузополучатель
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;">&nbsp;</td>
              <td></td>
              <td style="border-bottom:1px solid silver;"></td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td style="text-align:center">
        <div style="position:relative;">&nbsp;
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:213px;height:auto;position:absolute;top:-92px;left:0;z-index:-1;">
          </div>
          М. П.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php 
              $monthes = array(
                              1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
                              5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
                              9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
              echo("\"".date("d",strtotime($order->getSubmitedAt()))."\""." ".$monthes[date('n',strtotime($order->getSubmitedAt()))] . date(' Y',strtotime($order->getSubmitedAt())));
          ?> года
      </td>
      <td style="text-align:center">
        М. П.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php 
              $monthes = array(
                              1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
                              5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
                              9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
              echo("\"".date("d",strtotime($order->getSubmitedAt()))."\""." ".$monthes[date('n',strtotime($order->getSubmitedAt()))] . date(' Y',strtotime($order->getSubmitedAt())));
          ?> года
      </td>
    </tr>
  </tbody>
</table>
  </div>
  <?php endif;//if ($notfullpagecount > 0 && $notfullpagecount <= $countposonlastpage):// если есть неполная страница и пунктов меньше $countposonlastpage?>

  <?php //===============================================================================================================?>

  <?php if ($notfullpagecount > 0 && $notfullpagecount > $countposonlastpage): // если пункты вместе с футером не влезают на страницу?>
    <?php // выводим товары ?>
    <div class="page-landscape f04 tn-929">
      <div class="border-page">
        <div style="position:absolute;bottom:0;right:0;" class="f04-label">
        </div>
      </div>
<!-- ШАПКА ТОВАРОВ-->
  <div style="text-align:right;">
    <?php echo "Страница ".$sheetscount;$sheetscount++?>
  </div>
  <table class="bord-2" style="margin-top:3px;">
    <colgroup>
      <col width="14px">
      <col width="auto">
      <col width="16px">
      <col width="30px">
      <col width="22px">
      <col width="24px">
      <col width="24px">
      <col width="20px">
      <col width="26px">
      <col width="24px">
      <col width="50px">
      <col width="50px">
      <col width="22px">
      <col width="40px">
      <col width="50px">
    </colgroup>
    <thead class="f04-th">
      <tr>
        <td rowspan="2">
          N
        <br>
          п/п
        </td>
        <td colspan="2">
          Товар
        </td>
        <td colspan="2">
          Единица измерения
        </td>
        <td rowspan="2">
          Вид упако- вки
        </td>
        <td colspan="2">
          Количество
        </td>
        <td rowspan="2">
          Масса брутто
        </td>
        <td rowspan="2">
          Коли- чество (масса нетто)
        </td>
        <td rowspan="2">
          Цена, руб. коп.
        </td>
        <td rowspan="2">
          Сумма без учёта НДС, руб. коп.
        </td>
        <td colspan="2">
          НДС
        </td>
        <td rowspan="2">
          Сумма с учётом НДС, руб. коп.
        </td>
      </tr>
      <tr>
        <td>
          наименование, характеристика, сорт, артикул товара
        </td>
        <td>
          код
        </td>
        <td>
          наиме- нование
        </td>
        <td>
          код по ОКЕИ
        </td>
        <td>
          в одном месте
        </td>
        <td>
          мест, штук
        </td>
        <td>
          ста- вка, %
        </td>
        <td>
          сумма, руб. коп.
        </td>
      </tr>
      <tr>
        <td>1</td>
        <td>2</td>
        <td>3</td>
        <td>4</td>
        <td>5</td>
        <td>6</td>
        <td>7</td>
        <td>8</td>
        <td>9</td>
        <td>10</td>
        <td>11</td>
        <td>12</td>
        <td>13</td>
        <td>14</td>
        <td>15</td>
      </tr>
    </thead>
<!------ ШАПКА ТОВАРОВ ЗАКОНЧЕНА --------->

<!------ ТОВАРЫ ------>

    <?php for ($i = 0; $i < $number - $globalcounter; $i++):?>
    <tr>
        <td style="text-align:right;">
          <?php echo $counter; $counter++;$globalcounter++?>
        </td>
        <td style="text-align:left;white-space:pre-wrap;">
          <?php // ОПИСАНИЕ ТОВАРА?>
          <?php echo $invoices[$globalcounter]->getDescription()?>
        </td>
        <td>
          -
        </td>
        <td>
          шт
        </td>
        <td>
          796
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          <?php // КОЛИЧЕСТВО?>
          <?php echo number_format($invoices[$globalcounter]->getNumber(),3,',',' ')?>
          <?php $tablecount += $invoices[$globalcounter]->getNumber() // Суммируем количество?>
        </td>
        <td style="text-align:right;">
          <?php // Цена без НДС?>
          <?php echo number_format(($invoices[$globalcounter]->getPrice() - $invoices[$globalcounter]->getPrice()*18/118),2,',',' ')?>

        </td>
        <td style="text-align:right;">
          <?php // СУММА БЕЗ НДС?>
          <?php echo number_format((($invoices[$globalcounter]->getPrice() - $invoices[$globalcounter]->getPrice()*18/118) * $invoices[$globalcounter]->getNumber()),2,',',' ')?>
          <?php  $tablesummwithoutnds += ($invoices[$globalcounter]->getPrice() - $invoices[$globalcounter]->getPrice()*18/118) * $invoices[$globalcounter]->getNumber()?>
        </td>
        <td>
          18%
        </td>
        <td style="text-align:right;">
          <?php // Сумма НДС?>
          <nobr><?php echo number_format(($invoices[$globalcounter]->getSum()*18/118),2,',',' ')?></nobr>
          <?php $tablesummnds += $invoices[$globalcounter]->getSum()*18/118 ?>
        </td>
        <td style="text-align:right;">
          <?php echo number_format($invoices[$globalcounter]->getSum(),2,',',' ')?>
          <?php $tablesumm += $invoices[$globalcounter]->getSum()?>
        </td>
      </tr>
    <?php endfor?>
      <tr>
        <td colspan="7" style="text-align:right;border:none;">
          Итого
        </td>
        <td>
          -
        </td>
        <td>
          -
        </td>
        <td>
          <?php // КОЛИЧЕСТВО ТОВАРА В ТАБЛИЦЕ?>
          <?php echo number_format($tablecount,3,',',' ')?>
          <?php $sharecount += $tablecount?>
        </td>
        <td>
          X
        </td>
        <td style="text-align:right;">
          <?php // Сумма без учёта НДС?>
          <?php echo number_format($tablesummwithoutnds,2,',',' ')?>
          <?php $sharesummwithoutnds += $tablesummwithoutnds?>
        </td>
        <td>
          X
        </td>
        <td style="text-align:right;">
          <?php // Сумма НДС?>
          <?php echo number_format($tablesummnds,2,',',' ')?>
          <?php $sharesummnds += $tablesummnds?>
        </td>
        <td style="text-align:right;">
          <nobr><?php echo number_format($tablesumm,2,',',' ')?></nobr>
          <?php $sharesumm += $tablesumm?>
        </td>
      </tr>
    </tbody>
    <tfoot class="f04-td">
          <tr>
            <td colspan="7" style="text-align:right;border:none;">
              Всего по накладной
            </td>
            <td>
              -
            </td>
            <td>
              -
            </td>
            <td>
              <?php //Общее количество товара?>
              <?php echo number_format($sharecount,3,',',' ')?>
            </td>
            <td>
              X
            </td>
            <td style="text-align:right;">
              <?php //Общая цена товара без НДС?>
              <?php echo number_format($sharesummwithoutnds ,2,',',' ')?>
            </td>
            <td>
              X
            </td>
            <td style="text-align:right;">
              <?php //Общая цена товара без НДС?>
              <?php echo number_format($sharesummnds ,2,',',' ')?>
            </td>
            <td style="text-align:right;">
              <?php //Общая цена товара без НДС?>
              <?php echo number_format($sharesumm,2,',',' ')?>
            </td>
          </tr>
        </tfoot>
   </table>
   </div>
   <div class="page-landscape f04 tn-929">
      <div class="border-page">
        <div style="position:absolute;bottom:0;right:0;" class="f04-label">
        </div>
      </div>
  <table class="bord-0 f04-td" style="margin-top:8px;">
    <colgroup>
      <col width="194px">
      <col width="20px">
      <col width="90px">
      <col width="auto">
      <col width="142px">
    </colgroup>
    <tbody>
      <tr>
        <td>
          Товарная накладная имеет приложение на
        </td>
        <td style="border-bottom:1px solid silver;">
          <?php if ($notfullpagecount <= 0){
                    echo ($fullpagecount + 2);
                }
          ?>
          <?php if ($notfullpagecount > 0 && $notfullpagecount <= $countposonlastpage){
                    echo ($fullpagecount + 2);
                }
          ?>
          <?php if ($notfullpagecount > $countposonlastpage){
                    echo ($fullpagecount + 3);
                }
          ?>
        </td>
        <td>
          листах и содержит
        </td>
        <td style="border-bottom:1px solid silver;">
          <?php
            echo num2str($globalcounter);
          ?>
        </td>
        <td>
          порядковых номеров записей
        </td>
      </tr>
      <tr>
        <td></td>
        <td></td>
        <td></td>
        <td style="vertical-align:top">
          <div class="f04-label" style="text-align:center;">
            (прописью)
          </div>
        </td>
        <td></td>
      </tr>
    </tbody>
</table>

<table class="bord-0 f04-td" style="border-collapse:separate;">
  <colgroup>
    <col width="56px">
    <col width="190px">
    <col width="110px">
    <col width="auto">
    <col width="10px">
    <col width="150px">
  </colgroup>
  <tbody>
    <tr>
      <td rowspan="2" style="vertical-align:bottom;">
        Всего мест
      </td>
      <td></td>
      <td>&nbsp;
        Масса груза (нетто)
      </td>
      <td style="border-bottom:1px solid silver;">
      </td>
      <td></td>
      <td style="text-align:center;border-left:1px solid gray;border-top:1px solid gray;border-right:1px solid gray;border-bottom:1px solid silver;">
      </td>
    </tr>
    <tr>
      <td style="border-bottom:1px solid silver;vertical-align:bottom;">
        -
      </td>
      <td style="vertical-align:bottom;">&nbsp;
        Масса груза (брутто)
      </td>
      <td style="border-bottom:1px solid silver;vertical-align:top;">
        <div class="f04-label" style="text-align:center;">
          (прописью)
        </div>
      </td>
      <td></td>
      <td style="text-align:center;border-left:1px solid gray;border-right:1px solid gray;border-bottom:1px solid gray;">
      </td>
    </tr>
    <tr>
      <td></td>
      <td style="vertical-align:top">
        <div class="f04-label" style="text-align:center;">
          (прописью)
        </div>
      </td>
      <td></td>
      <td style="vertical-align:top">
        <div class="f04-label" style="text-align:center;">
          (прописью)
        </div>
      </td>
      <td colspan="2"></td>
    </tr>
  </tbody>
</table>

<table class="bord-0 f04-td">
  <colgroup>
    <col width="46%">
    <col width="54%">
  </colgroup>
  <tbody>
    <tr>
      <td style="padding:0 6px 0 0;">
        <table class="bord-0">
          <colgroup>
            <col width="224px">
            <col width="auto">
            <col width="40px">
          </colgroup>
          <tbody>
            <tr>
              <td style="vertical-align:bottom;">
                Приложение (паспорта, сертификаты и т. п.) на
              </td>
              <td style="border-bottom:1px solid silver;">
                -
              </td>
              <td style="vertical-align:bottom;">
                листах
              </td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (прописью)
                </div>
              </td>
              <td></td>
            </tr>
          </tbody>
        </table>
        <table class="bord-0">
          <colgroup>
            <col width="80px">
            <col width="auto">
          </colgroup>
          <tbody>
            <tr>
              <td rowspan="2">
                Всего отпущено на сумму
              </td>
              <td style="border-bottom:1px solid silver;">
                <?php
                  echo num2rub($sharesumm)
                ?>
              </td>
            </tr>
            <tr>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (прописью)
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="bord-0">
          <colgroup><col width="70px">
            <col width="90px">
            <col width="6px">
            <col width="auto">
            <col width="6px">
            <col width="90px">
          </colgroup>
          <tbody>
            <tr>
              <td rowspan="2">
                Отпуск груза разрешил
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
                <div style="position:relative;">&nbsp;
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="position:absolute;top:-20px;">
                </div>
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;vertical-align:bottom;"></td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
            <tr>
              <td rowspan="2" colspan="2">
                Главный (старший) бухгалтер
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
                <div style="position:relative;">&nbsp;
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                </div>
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
            <tr>
              <td rowspan="2">
                Отпуск груза произвел
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
                <div style="position:relative;">&nbsp;
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                  <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:124px;height:auto;position:absolute;top:-14px;left:-10px;">
                </div>
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;vertical-align:bottom;"></td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
      <td style="border-left:1px solid gray;padding-left:6px;">
        <table class="bord-0">
          <colgroup>
            <col width="100px">
            <col width="auto">
          </colgroup>
          <tbody>
            <tr>
              <td>
                По доверенности №
              </td>
              <td style="border-bottom:1px solid silver;"></td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (номер, дата доверенности)
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="bord-0">
          <colgroup>
            <col width="50px">
            <col width="auto">
          </colgroup>
          <tbody>
            <tr>
              <td>
                выданной
              </td>
              <td colspan="2" style="border-bottom:1px solid silver;">&nbsp;</td>
            </tr>
            <tr>
              <td style="border-bottom:1px solid silver;"></td>
              <td style="height:26px;border-bottom:1px solid silver;vertical-align:top;">
                <div class="f04-label" style="text-align:center;">
                  (кем, кому (организация, должность, фамилия, и., о.))
                </div>&nbsp;
              </td>
            </tr>
            <tr>
              <td></td>
              <td style="vertical-align:top;">
                <div class="f04-label" style="text-align:center;">&nbsp;
                </div>
              </td>
            </tr>
          </tbody>
        </table>

        <table class="bord-0">
          <colgroup>
            <col width="86px">
            <col width="90px">
            <col width="6px">
            <col width="auto">
            <col width="6px">
            <col width="90px">
          </colgroup>
          <tbody>
            <tr>
              <td rowspan="2">
                Груз принял
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;">&nbsp;
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;">
              </td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;">
              </td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
            <tr>
              <td rowspan="2">
                Груз получил грузополучатель
              </td>
              <td style="border-bottom:1px solid silver;text-align:center;">&nbsp;</td>
              <td></td>
              <td style="border-bottom:1px solid silver;"></td>
              <td></td>
              <td style="border-bottom:1px solid silver;text-align:center;"></td>
            </tr>
            <tr>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (должность)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (подпись)
                </div>
              </td>
              <td></td>
              <td style="vertical-align:top">
                <div class="f04-label" style="text-align:center;">
                  (расшифровка подписи)
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td style="text-align:center">
        <div style="position:relative;">&nbsp;
          <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///////yH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" class="stamp h" style="width:213px;height:auto;position:absolute;top:-92px;left:0;z-index:-1;">
          </div>
          М. П.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <?php 
              $monthes = array(
                              1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
                              5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
                              9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
              echo("\"".date("d",strtotime($order->getSubmitedAt()))."\""." ".$monthes[date('n',strtotime($order->getSubmitedAt()))] . date(' Y',strtotime($order->getSubmitedAt())));
          ?> года
      </td>
      <td style="text-align:center">
        М. П.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php 
              $monthes = array(
                              1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
                              5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
                              9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
              echo("\"".date("d",strtotime($order->getSubmitedAt()))."\""." ".$monthes[date('n',strtotime($order->getSubmitedAt()))] . date(' Y',strtotime($order->getSubmitedAt())));
          ?> года
      </td>
    </tr>
  </tbody>
</table>
</div>
  <?php endif;//if ($notfullpagecount > 0 && $notfullpagecount > $countposonlastpage): // если пункты вместе с футером не влезают на страницу?>

<?php endif;?>
<div class="title-size">Параметры печати</div>
<div class="print-options">
<h4 id="t_tn" class="h" style="display: block;">Товарная накладная</h4><ul id="c_tn" class="doc h" style="display: block;"><li><input class="hide-doc" type="checkbox" id="tn-929" checked="">№ <a href="" title="Товарная накладная "><?php echo $order->getWaybillNumber() ?></a><span> от <?php echo date("d.m.Y",strtotime($order->getSubmitedAt()))?></span></li></ul>

<h4><a href="" onclick="window.print();return false">Распечатать</a></h4>
</body>
</html>