<title>Счет(Печать)</title>
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
  .print-options {padding:10px 0 20px;width:200px;height:auto;max-height:80%;position:fixed;top:50px;left:900px;border:1px solid #aaaaaa;border-radius:8px;box-shadow:3px 3px 10px #909090;background-color:white;line-height:18px;overflow:auto;}
  .title-size{width:auto;height:40px;display:inline-block;padding:0 20px;border:1px solid gray;border-radius:5px;border-bottom:1px solid silver;background-color:#f4f4f4;font-size:14px;line-height:40px;color:#b3201b;position:fixed;top:10px;left:920px;}
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
  .page-landscape {width:100%;height:199mm;}
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
<?php
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
    $out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
    $out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
}

/**
 * Склоняем словоформу
 * @ author runcore
 */
function morph($n, $f1, $f2, $f5) {
    $n = abs(intval($n)) % 100;
    if ($n>10 && $n<20) return $f5;
    $n = $n % 10;
    if ($n>1 && $n<5) return $f2;
    if ($n==1) return $f1;
    return $f5;
}
?>
<body lang=RU style='tab-interval:35.4pt'>

<div class=WordSection1>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 width=703
 style='width:527.0pt;margin-left:4.65pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:11.25pt'>
  <td width=667 colspan=36 rowspan=3 style='width:500.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Внимание! Оплата данного счета означает согласие с
  условиями поставки товара. Уведомление об оплате <br>
  <span style='mso-spacerun:yes'> </span>обязательно, в противном случае не
  гарантируется наличие товара на складе. Товар отпускается по факту<br>
  <span style='mso-spacerun:yes'> </span>прихода денег на <span class=GramE>р</span>/с
  Поставщика, самовывозом, при наличии доверенности и паспорта.<o:p></o:p></span></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:1;height:11.25pt'>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:2;height:11.25pt'>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:3;height:11.25pt'>
  <td width=21 nowrap valign=bottom style='width:16.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=21 nowrap valign=bottom style='width:15.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=19 nowrap valign=bottom style='width:14.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=11 nowrap valign=bottom style='width:8.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:7.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=187 nowrap valign=bottom style='width:140.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:4;height:12.0pt'>
  <td width=306 colspan=18 rowspan=2 valign=top style='width:229.2pt;
  border:solid windowtext 1.0pt;border-bottom:none;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'><?php echo $order->getClient()->getBank();?><o:p></o:p></span></p>
  </td>
  <td width=51 nowrap colspan=4 style='width:38.6pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-top-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>БИК<o:p></o:p></span></p>
  </td>
  <td width=310 nowrap colspan=14 style='width:232.2pt;border-top:solid windowtext 1.0pt;
  border-left:none;border-bottom:none;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'><?php echo $order->getClient()->getBik();?><o:p></o:p></span></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
 </tr>
 <tr style='mso-yfti-irow:5;height:11.25pt'>
  <td width=51 nowrap colspan=4 rowspan=2 valign=top style='width:38.6pt;
  border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
  border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span class=SpellE><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>Сч</span></span><span
  style='font-size:9.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>. №<o:p></o:p></span></p>
  </td>
  <td width=310 nowrap colspan=14 rowspan=2 valign=top style='width:232.2pt;
  border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
  border-right:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;
  mso-border-right-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'><?php echo $order->getClient()->getKs();?><o:p></o:p></span></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:6;height:11.25pt'>
  <td width=306 nowrap colspan=18 valign=bottom style='width:229.2pt;
  border:solid windowtext 1.0pt;border-top:none;mso-border-left-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>Банк
  получателя<o:p></o:p></span></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:7;height:12.0pt'>
  <td width=42 nowrap colspan=2 style='width:31.7pt;border:none;border-left:
  solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>ИНН<o:p></o:p></span></p>
  </td>
  <td width=119 nowrap colspan=7 style='width:89.05pt;border:none;border-right:
  solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'><?php echo $order->getClient()->getInn();?><o:p></o:p></span></p>
  </td>
  <td width=35 nowrap colspan=2 style='width:26.35pt;border:none;mso-border-top-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>КПП<span
  style='mso-spacerun:yes'>  </span><o:p></o:p></span></p>
  </td>
  <td width=109 nowrap colspan=7 style='width:82.1pt;border:none;border-right:
  solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'><?php echo $order->getClient()->getKpp();?><o:p></o:p></span></p>
  </td>
  <td width=51 nowrap colspan=4 rowspan=4 valign=top style='width:38.6pt;
  border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
  border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span class=SpellE><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>Сч</span></span><span
  style='font-size:9.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>. №<o:p></o:p></span></p>
  </td>
  <td width=310 nowrap colspan=14 rowspan=4 valign=top style='width:232.2pt;
  border-top:none;border-left:none;border-bottom:solid windowtext 1.0pt;
  border-right:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'><?php echo $order->getClient()->getRs();?><o:p></o:p></span></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
 </tr>
 <tr style='mso-yfti-irow:8;height:11.25pt'>
  <td width=306 colspan=18 rowspan=2 valign=top style='width:229.2pt;
  border-top:solid windowtext 1.0pt;border-left:solid windowtext 1.0pt;
  border-bottom:none;border-right:none;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&quot;<?php echo $order->getClient()->getFullName();?></span>&quot;<o:p></o:p></span></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:9;height:11.25pt'>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:10;height:11.25pt'>
  <td width=306 nowrap colspan=18 style='width:229.2pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:11.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>Получатель<o:p></o:p></span></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:11;height:11.25pt'>
  <td width=21 nowrap valign=bottom style='width:16.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=21 nowrap valign=bottom style='width:15.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=19 nowrap valign=bottom style='width:14.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=11 nowrap valign=bottom style='width:8.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:7.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=187 nowrap valign=bottom style='width:140.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:12;height:11.25pt'>
  <td width=667 nowrap colspan=36 rowspan=2 style='width:500.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:14.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>Счет на
  оплату № <?php echo $order->getId();?> от 
  <?php 
    $monthes = array(
    1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
    5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
    9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
  if ($order->getSubmitedAt()!=''){
      echo(date("d",strtotime($order->getSubmitedAt()))." ".$monthes[date('n',strtotime($order->getSubmitedAt()))] . date(' Y',strtotime($order->getSubmitedAt())));
  }
  else
  {
      echo(date("d")." ".$monthes[date('n')] . date(' Y'));
  }
  ?> г.<o:p></o:p></span></b></p>
  
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:13;height:11.25pt'>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:14;height:6.95pt'>
  <td width=667 nowrap colspan=36 valign=bottom style='width:500.0pt;
  border:none;border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
 </tr>
 <tr style='mso-yfti-irow:15;height:6.95pt'>
  <td width=21 nowrap valign=bottom style='width:16.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=21 nowrap valign=bottom style='width:15.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=19 nowrap valign=bottom style='width:14.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=11 nowrap valign=bottom style='width:8.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:7.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=187 nowrap valign=bottom style='width:140.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
 </tr>
 <tr style='mso-yfti-irow:16;height:25.35pt'>
  <td width=81 nowrap colspan=4 valign=top style='width:60.95pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:25.35pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>Поставщик:<o:p></o:p></span></p>
  </td>
  <td width=585 colspan=32 valign=top style='width:439.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:25.35pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>ООО "Фабрика 21 век", ИНН 2543024343, КПП 254301001, 690000, Владивосток,
   проспект 100 лет Владивостока, дом № 145, кв.24,
  тел.: (423) 232-84-55, факс: (423) 232-84-55<o:p></o:p></span></b></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:25.35pt'></td>
 </tr>
 <tr style='mso-yfti-irow:17;height:6.95pt'>
  <td width=21 nowrap valign=bottom style='width:16.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=21 nowrap valign=bottom style='width:15.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=19 nowrap valign=bottom style='width:14.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=11 nowrap valign=bottom style='width:8.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:7.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=187 nowrap valign=bottom style='width:140.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
 </tr>
 <tr style='mso-yfti-irow:18;height:25.35pt'>
  <td width=81 nowrap colspan=4 valign=top style='width:60.95pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:25.35pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>Покупатель:<o:p></o:p></span></p>
  </td>
  <td width=585 colspan=32 valign=top style='width:439.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:25.35pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>
  "<?php echo $order->getClient()->getFullName();?>", 
  ИНН <?php echo $order->getClient()->getInn();?>, 
  <?php 
      if ($order->getClient()->getKpp() != ""){
        echo "КПП ".$order->getClient()->getKpp().",";
      }
  ?>
  <?php echo $order->getClient()->getAddressJure();?> 
  <?php 
      if ($order->getClient()->getPhone() != ""){
        echo ",тел.: ".$order->getClient()->getPhone();
      }
  ?><o:p></o:p></span></b></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:25.35pt'></td>
 </tr>
 <tr style='mso-yfti-irow:19;height:6.95pt'>
  <td width=21 nowrap valign=bottom style='width:16.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=21 nowrap valign=bottom style='width:15.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=19 nowrap valign=bottom style='width:14.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=11 nowrap valign=bottom style='width:8.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:7.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=187 nowrap valign=bottom style='width:140.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
 </tr>
 <tr style='mso-yfti-irow:20;height:12.0pt'>
  <td width=42 nowrap colspan=2 style='width:31.7pt;border-top:solid windowtext 1.0pt;
  border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:9.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>№<o:p></o:p></span></b></p>
  </td>
  <td width=275 nowrap colspan=17 style='width:205.9pt;border-top:solid windowtext 1.0pt;
  border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;
  mso-border-top-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:9.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Товары (работы, услуги)<o:p></o:p></span></b></p>
  </td>
  <td width=52 nowrap colspan=4 style='width:39.05pt;border-top:solid windowtext 1.0pt;
  border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;
  mso-border-top-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:9.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Кол-во<o:p></o:p></span></b></p>
  </td>
  <td width=33 nowrap colspan=3 style='width:24.45pt;border-top:solid windowtext 1.0pt;
  border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;
  mso-border-top-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:9.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Ед.<o:p></o:p></span></b></p>
  </td>
  <td width=231 nowrap colspan=6 style='width:172.9pt;border-top:solid windowtext 1.0pt;
  border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;
  mso-border-top-alt:solid windowtext 1.0pt;mso-border-left-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:9.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Цена<o:p></o:p></span></b></p>
  </td>
  <td width=71 nowrap colspan=5 style='width:53.0pt;border:solid windowtext 1.0pt;
  border-bottom:none;mso-border-top-alt:solid windowtext 1.0pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><b><span style='font-size:9.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Сумма<o:p></o:p></span></b></p>
  </td>
 </tr>
 <?php 
  $counter = 1;
  $sum = 0;
 ?>
 <?php foreach($order->getInvoices() as $invoice):?>
 <tr style='mso-yfti-irow:21;height:11.85pt'>
  <td width=42 nowrap colspan=2 valign=top style='width:31.7pt;border-top:solid windowtext 1.0pt;
  border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext 1.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.85pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'><?php echo $counter; $counter++;?><o:p></o:p></span></p>
  </td>
  <td width=275 colspan=17 valign=top style='width:205.9pt;border-top:solid windowtext 1.0pt;
  border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'><?php echo $invoice->getDescription()?><o:p></o:p></span></p>
  </td>
  <td width=52 nowrap colspan=4 valign=top style='width:39.05pt;border-top:
  solid windowtext 1.0pt;border-left:solid windowtext 1.0pt;border-bottom:none;
  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:11.85pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-size:8.0pt;font-family:
  "Arial","sans-serif";mso-fareast-font-family:"Times New Roman";mso-fareast-language:
  RU'><?php echo $invoice->getNumber()?><o:p></o:p></span></p>
  </td>
  <td width=33 nowrap colspan=3 valign=top style='width:24.45pt;border-top:
  solid windowtext 1.0pt;border-left:solid windowtext 1.0pt;border-bottom:none;
  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:11.85pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span class=SpellE><span class=GramE><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>шт</span></span></span><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'><o:p></o:p></span></p>
  </td>
  <td width=231 nowrap colspan=6 valign=top style='width:172.9pt;border-top:
  solid windowtext 1.0pt;border-left:solid windowtext 1.0pt;border-bottom:none;
  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:11.85pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-size:8.0pt;font-family:
  "Arial","sans-serif";mso-fareast-font-family:"Times New Roman";mso-fareast-language:
  RU'><?php echo $invoice->getPrice()?><o:p></o:p></span></p>
  </td>
  <td width=71 nowrap colspan=5 valign=top style='width:53.0pt;border:solid windowtext 1.0pt;
  border-bottom:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext 1.0pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:11.85pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-size:8.0pt;font-family:
  "Arial","sans-serif";mso-fareast-font-family:"Times New Roman";mso-fareast-language:
  RU'><?php $sum +=$invoice->getSum()?>
      <?php echo $invoice->getSum()?>
  <o:p></o:p></span></p>
  </td>
 </tr>
 <?php endforeach;?>
 <tr style='mso-yfti-irow:22;height:6.95pt'>
  <td width=21 nowrap valign=bottom style='width:16.05pt;border:none;
  border-top:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=21 nowrap valign=bottom style='width:15.65pt;border:none;
  border-top:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;border:none;
  border-top:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=19 nowrap valign=bottom style='width:14.3pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=17 nowrap valign=bottom style='width:12.55pt;border:none;
  border-top:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:11.85pt;border:none;
  border-top:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:11.75pt;border:none;
  border-top:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:11.65pt;border:none;
  border-top:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=18 nowrap valign=bottom style='width:13.85pt;border:none;
  border-top:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=17 nowrap valign=bottom style='width:12.5pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:12.15pt;border:none;
  border-top:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:11.8pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:11.7pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=15 nowrap valign=bottom style='width:11.55pt;border:none;
  border-top:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=15 nowrap valign=bottom style='width:11.5pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=15 nowrap valign=bottom style='width:11.4pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=11 nowrap valign=bottom style='width:8.4pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=14 nowrap valign=bottom style='width:10.7pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=14 nowrap valign=bottom style='width:10.65pt;border:none;
  border-top:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=12 nowrap valign=bottom style='width:8.8pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=12 nowrap valign=bottom style='width:8.65pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:7.0pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=187 nowrap valign=bottom style='width:140.4pt;border:none;
  border-top:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;border:none;border-top:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:23;height:12.0pt'>
  <td width=21 nowrap valign=bottom style='width:16.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=21 nowrap valign=bottom style='width:15.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=19 nowrap valign=bottom style='width:14.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=11 nowrap valign=bottom style='width:8.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=bottom style='width:7.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=187 nowrap valign=top style='width:140.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><b><span style='font-size:9.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Итого:<o:p></o:p></span></b></p>
  </td>
  <td width=71 nowrap colspan=5 valign=top style='width:53.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><b><span style='font-size:9.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'><?php echo $sum?><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:24;height:12.0pt'>
  <td width=21 nowrap valign=bottom style='width:16.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=21 nowrap valign=bottom style='width:15.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=19 nowrap valign=bottom style='width:14.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=11 nowrap valign=bottom style='width:8.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=bottom style='width:7.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=187 nowrap valign=top style='width:140.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><b><span style='font-size:9.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>В том числе НДС:<o:p></o:p></span></b></p>
  </td>
  <td width=71 nowrap colspan=5 valign=top style='width:53.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><b><span style='font-size:9.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'><?php echo round(($sum * 18 / 118),2)?><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:25;height:12.0pt'>
  <td width=21 nowrap valign=bottom style='width:16.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=21 nowrap valign=bottom style='width:15.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=19 nowrap valign=bottom style='width:14.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=11 nowrap valign=bottom style='width:8.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=bottom style='width:7.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=9 nowrap valign=top style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=187 nowrap valign=top style='width:140.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><b><span style='font-size:9.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Всего к оплате:<o:p></o:p></span></b></p>
  </td>
  <td width=71 nowrap colspan=5 valign=top style='width:53.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><b><span style='font-size:9.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'><?php echo $sum?><o:p></o:p></span></b></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:26;height:12.0pt'>
  <td width=667 nowrap colspan=36 valign=bottom style='width:500.0pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>Всего
  наименований <?php echo $counter -1?>, на сумму <?php echo $sum ?> руб.<o:p></o:p></span></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
 </tr>
 <tr style='mso-yfti-irow:27;height:13.35pt'>
  <td width=658 colspan=35 valign=top style='width:493.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:13.35pt'>
  <?php
    if (!function_exists('mb_ucfirst') && extension_loaded('mbstring'))
{
    /**
     * mb_ucfirst - преобразует первый символ в верхний регистр
     * @param string $str - строка
     * @param string $encoding - кодировка, по-умолчанию UTF-8
     * @return string
     */
    function mb_ucfirst($str, $encoding='UTF-8')
    {
        $str = mb_ereg_replace('^[\ ]+', '', $str);
        $str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding).
               mb_substr($str, 1, mb_strlen($str), $encoding);
        return $str;
    }
}
  ?>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'><?php echo mb_ucfirst(num2str($sum))?><o:p></o:p></span></b></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:13.35pt'></td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:13.35pt'></td>
 </tr>
 <tr style='mso-yfti-irow:28;height:6.95pt'>
  <td width=21 nowrap valign=bottom style='width:16.05pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=21 nowrap valign=bottom style='width:15.65pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=19 nowrap valign=bottom style='width:14.3pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=17 nowrap valign=bottom style='width:12.55pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:11.85pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:11.75pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:11.65pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=18 nowrap valign=bottom style='width:13.85pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=17 nowrap valign=bottom style='width:12.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:12.15pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:11.8pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:11.7pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=15 nowrap valign=bottom style='width:11.55pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=15 nowrap valign=bottom style='width:11.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=15 nowrap valign=bottom style='width:11.4pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=11 nowrap valign=bottom style='width:8.4pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=14 nowrap valign=bottom style='width:10.7pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=14 nowrap valign=bottom style='width:10.65pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=12 nowrap valign=bottom style='width:8.8pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=12 nowrap valign=bottom style='width:8.65pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:7.0pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=187 nowrap valign=bottom style='width:140.4pt;border:none;
  border-bottom:solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;padding:0cm 5.4pt 0cm 5.4pt;height:6.95pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:6.95pt'></td>
 </tr>
 <tr style='mso-yfti-irow:29;height:11.25pt'>
  <td width=21 nowrap valign=bottom style='width:16.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=21 nowrap valign=bottom style='width:15.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=19 nowrap valign=bottom style='width:14.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=11 nowrap valign=bottom style='width:8.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:7.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=187 nowrap valign=bottom style='width:140.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:30;height:12.0pt'>
  <td width=98 nowrap colspan=5 valign=bottom style='width:73.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>Руководитель<o:p></o:p></span></b></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:11.85pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:11.75pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=16 nowrap valign=bottom style='width:11.65pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=145 nowrap colspan=9 valign=bottom style='width:108.45pt;
  border:none;border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-size:8.0pt;font-family:
  "Arial","sans-serif";mso-fareast-font-family:"Times New Roman";mso-fareast-language:
  RU'>Горбунова И.Н.<o:p></o:p></span></p>
  </td>
  <td width=11 nowrap valign=bottom style='width:8.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
  <td width=64 nowrap colspan=5 valign=bottom style='width:47.65pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><b><span style='font-size:9.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>Бухгалтер<o:p></o:p></span></b></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:7.0pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal'><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=239 nowrap colspan=7 valign=bottom style='width:179.4pt;border:
  none;border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:12.0pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal'><span style='font-size:8.0pt;font-family:
  "Arial","sans-serif";mso-fareast-font-family:"Times New Roman";mso-fareast-language:
  RU'>Цуканова В.В.<o:p></o:p></span></p>
  </td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:12.0pt'></td>
 </tr>
 <tr style='mso-yfti-irow:31;mso-yfti-lastrow:yes;height:11.25pt'>
  <td width=21 nowrap valign=bottom style='width:16.05pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=21 nowrap valign=bottom style='width:15.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=20 nowrap valign=bottom style='width:14.95pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=19 nowrap valign=bottom style='width:14.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.75pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=17 nowrap valign=bottom style='width:12.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:12.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=16 nowrap valign=bottom style='width:11.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=11 nowrap valign=bottom style='width:8.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.7pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=14 nowrap valign=bottom style='width:10.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=12 nowrap valign=bottom style='width:8.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:7.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=187 nowrap valign=bottom style='width:140.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=9 nowrap valign=bottom style='width:6.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
  <td width=36 nowrap valign=bottom style='width:27.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.25pt'></td>
 </tr>
</table>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

</div>
<div class="title-size">Параметры печати</div>
<div class="print-options">
<h4 id="t_tn" class="h" style="display: block;">Счет на оплату</h4><ul id="c_tn" class="doc h" style="display: block;"><li><input class="hide-doc" type="checkbox" id="tn-929" checked="">№ <a href="" title=""><?php echo $order->getId()?></a><span>от 
  <?php 
        if ($order->getSubmitedAt()!=''){
          echo date("d.m.Y",strtotime($order->getSubmitedAt()));
        }
        else {
          echo date("d.m.Y");
        }
  ?>
  </span></li></ul>

<h4><a href="" onclick="window.print();return false">Распечатать</a></h4>
</body>

</html>
