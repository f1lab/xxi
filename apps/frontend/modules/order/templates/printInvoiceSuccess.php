<title>Счет-фактура(Печать)</title>
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
  .print-options {padding:10px 0 20px;width:200px;height:auto;max-height:80%;position:fixed;top:50px;left:1000px;border:1px solid #aaaaaa;border-radius:8px;box-shadow:3px 3px 10px #909090;background-color:white;line-height:18px;overflow:auto;}
  .title-size{width:auto;height:40px;display:inline-block;padding:0 20px;border:1px solid gray;border-radius:5px;border-bottom:1px solid silver;background-color:#f4f4f4;font-size:14px;line-height:40px;color:#b3201b;position:fixed;top:10px;left:1020px;}
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
<body lang=RU style='tab-interval:35.4pt'>

<div class=WordSection1>

<table class=MsoNormalTable border=0 cellspacing=0 cellpadding=0 align=left
 width=1342 style='width:1006.3pt;border-collapse:collapse;mso-yfti-tbllook:
 1184;mso-table-lspace:9.0pt;margin-left:6.75pt;mso-table-rspace:9.0pt;
 margin-right:6.75pt;mso-table-anchor-vertical:page;mso-table-anchor-horizontal:
 margin;mso-table-left:left;mso-table-top:6.75pt;mso-padding-alt:0cm 5.4pt 0cm 5.4pt'>
 <tr style='mso-yfti-irow:0;mso-yfti-firstrow:yes;height:24.45pt'>
  <td width=1342 colspan=27 valign=bottom style='width:1006.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:24.45pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>Приложение № 1<br>
  к постановлению Правительства Российской Федерации<br>
  от 26 декабря 2011 г. № 1137<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:1;height:10.1pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=488 nowrap colspan=8 valign=top style='width:366.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><b><span style='font-size:
  14.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Счет-фактура № <?php echo $order->getId()?> от <?php 
    $monthes = array(
    1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
    5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
    9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря');
      
    echo(date("d",strtotime($order->getSubmitedAt()))." ".$monthes[date('n',strtotime($order->getSubmitedAt()))] . date(' Y',strtotime($order->getSubmitedAt())));
  ?> г.<o:p></o:p></span></b></p>
  </td>
  <td width=25 nowrap valign=bottom style='width:18.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=24 nowrap valign=bottom style='width:17.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=45 nowrap valign=bottom style='width:33.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=89 nowrap valign=bottom style='width:67.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=63 nowrap valign=bottom style='width:47.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=80 nowrap valign=bottom style='width:60.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=64 nowrap valign=bottom style='width:48.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=65 nowrap valign=bottom style='width:49.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=90 nowrap valign=bottom style='width:67.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
  <td width=105 nowrap valign=bottom style='width:79.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.1pt'></td>
 </tr>
 <tr style='mso-yfti-irow:2;height:18.55pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=330 nowrap colspan=2 valign=bottom style='width:247.3pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:18.55pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><b><span style='font-size:
  14.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Исправление № -- <span class=GramE>от</span> --<o:p></o:p></span></b></p>
  </td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=30 nowrap valign=bottom style='width:22.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=24 nowrap valign=bottom style='width:17.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=45 nowrap valign=bottom style='width:33.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=89 nowrap valign=bottom style='width:67.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=63 nowrap valign=bottom style='width:47.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=80 nowrap valign=bottom style='width:60.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=64 nowrap valign=bottom style='width:48.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=65 nowrap valign=bottom style='width:49.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=90 nowrap valign=bottom style='width:67.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
  <td width=105 nowrap valign=bottom style='width:79.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:18.55pt'></td>
 </tr>
 <tr style='mso-yfti-irow:3;height:11.4pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
  <td width=1327 colspan=26 valign=bottom style='width:995.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Продавец: ООО "Фабрика 21 век"<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:4;height:11.4pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
  <td width=1327 colspan=26 valign=bottom style='width:995.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Адрес: 90000, г. Владивосток, проспект 100 лет Владивостока, 145 - 24 <o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:5;height:11.4pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
  <td width=1327 colspan=26 valign=bottom style='width:995.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>ИНН/КПП продавца: 2543024343/254301001<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:6;height:11.4pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
  <td width=1327 colspan=26 valign=bottom style='width:995.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Грузоотправитель и его адрес: он же<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:7;height:11.4pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
  <td width=1327 colspan=26 valign=bottom style='width:995.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Грузополучатель и его адрес: <?php echo $order->getClient()->getFullName().", ".$order->getClient()->getAddressJure()?><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:8;height:11.4pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
  <td width=1327 colspan=26 valign=bottom style='width:995.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>К платежно-расчетному документу №<span
  style='mso-spacerun:yes'>    </span><span class=GramE>от</span><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:9;height:11.4pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
  <td width=1327 colspan=26 valign=bottom style='width:995.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Покупатель: <?php echo $order->getClient()->getFullName()?><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:10;height:11.4pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
  <td width=1327 colspan=26 valign=bottom style='width:995.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Адрес: <?php echo $order->getClient()->getAddressJure()?><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:11;height:11.4pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
  <td width=1327 colspan=26 valign=bottom style='width:995.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>ИНН/КПП покупателя:<?php echo " ".$order->getClient()->getInn()."/".$order->getClient()->getKpp()?><o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:12;height:10.75pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=365 nowrap colspan=4 valign=top style='width:273.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Валюта: наименование, код Российский рубль, 643<o:p></o:p></span></p>
  </td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=30 nowrap valign=bottom style='width:22.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=24 nowrap valign=bottom style='width:17.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=45 nowrap valign=bottom style='width:33.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=89 nowrap valign=bottom style='width:67.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=63 nowrap valign=bottom style='width:47.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=80 nowrap valign=bottom style='width:60.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=64 nowrap valign=bottom style='width:48.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=65 nowrap valign=bottom style='width:49.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=90 nowrap valign=bottom style='width:67.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=105 nowrap valign=bottom style='width:79.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
 </tr>
 <tr style='mso-yfti-irow:13;height:31.8pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:31.8pt'></td>
  <td width=330 colspan=2 rowspan=2 style='width:247.3pt;border-top:solid windowtext 1.0pt;
  border-left:solid windowtext 1.0pt;border-bottom:none;border-right:none;
  mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:31.8pt'>
  
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>Наименование товара (описание
  выполненных работ, оказанных услуг), имущественного права<o:p></o:p></span></p>
  </td>
  <td width=129 colspan=5 style='width:96.65pt;border:solid windowtext 1.0pt;
  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:31.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>Единица<br>
  измерения<o:p></o:p></span></p>
  </td>
  <td width=54 colspan=2 rowspan=2 style='width:40.55pt;border:solid windowtext 1.0pt;
  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:31.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>Кол<span class=GramE>и-</span><br>
  <span class=SpellE>чество</span> <br>
  (объем)<o:p></o:p></span></p>
  </td>
  <td width=69 colspan=2 rowspan=2 style='width:51.6pt;border:solid windowtext 1.0pt;
  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:31.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>Цена (тариф) за единицу измерения<o:p></o:p></span></p>
  </td>
  <td width=122 colspan=3 rowspan=2 style='width:91.5pt;border:solid windowtext 1.0pt;
  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:31.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>Стоимость товаров (работ, услуг),
  имущественных прав без налога - всего<o:p></o:p></span></p>
  </td>
  <td width=81 colspan=2 rowspan=2 style='width:60.45pt;border:solid windowtext 1.0pt;
  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:31.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>В том<br>
  числе<br>
  сумма <br>
  акциза<o:p></o:p></span></p>
  </td>
  <td width=80 rowspan=2 style='width:60.3pt;border:solid windowtext 1.0pt;
  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:31.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>Налоговая ставка<o:p></o:p></span></p>
  </td>
  <td width=106 colspan=4 rowspan=2 style='width:79.85pt;border:solid windowtext 1.0pt;
  border-right:none;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:31.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>Сумма налога, предъявляемая
  покупателю<o:p></o:p></span></p>
  </td>
  <td width=95 colspan=2 rowspan=2 style='width:71.45pt;border:solid windowtext 1.0pt;
  mso-border-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:31.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>Стоимость товаров (работ, услуг),
  имущественных прав с налогом - всего<o:p></o:p></span></p>
  </td>
  <td width=155 colspan=2 style='width:116.2pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-top-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:31.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>Страна<br>
  происхождения товара<o:p></o:p></span></p>
  </td>
  <td width=105 rowspan=2 style='width:79.1pt;border:solid windowtext 1.0pt;
  border-left:none;mso-border-left-alt:solid windowtext .5pt;mso-border-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:31.8pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>Номер<br>
  таможенной<br>
  декларации<o:p></o:p></span></p>
  </td>
 </tr>
 <?php 
  $counter = 1;
  $sum = 0;
 ?>
 
 <tr style='mso-yfti-irow:14;height:31.3pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:31.3pt'></td>
  <td width=35 nowrap colspan=2 style='width:26.4pt;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:31.3pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>код<o:p></o:p></span></p>
  </td>
  <td width=94 colspan=3 style='width:70.3pt;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;mso-border-top-alt:
  solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;mso-border-left-alt:
  solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:31.3pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>условное обозначение
  (национальное)<o:p></o:p></span></p>
  </td>
  <td width=65 style='width:49.0pt;border-top:none;border-left:none;border-bottom:
  solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:31.3pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>цифровой код<o:p></o:p></span></p>
  </td>
  <td width=90 style='width:67.25pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:31.3pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>краткое наименование<o:p></o:p></span></p>
  </td>
 </tr>
 <tr style='mso-yfti-irow:15;height:10.75pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'></td>
  <td width=330 nowrap colspan=2 style='width:247.3pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:10.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>1<o:p></o:p></span></p>
  </td>
  <td width=35 nowrap colspan=2 style='width:26.4pt;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>2<o:p></o:p></span></p>
  </td>
  <td width=94 nowrap colspan=3 style='width:70.3pt;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>2а<o:p></o:p></span></p>
  </td>
  <td width=54 nowrap colspan=2 style='width:40.55pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:10.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>3<o:p></o:p></span></p>
  </td>
  <td width=69 nowrap colspan=2 style='width:51.6pt;border-top:none;border-left:
  solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;border-right:
  none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:10.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>4<o:p></o:p></span></p>
  </td>
  <td width=122 nowrap colspan=3 style='width:91.5pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:10.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>5<o:p></o:p></span></p>
  </td>
  <td width=81 nowrap colspan=2 style='width:60.45pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:10.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>6<o:p></o:p></span></p>
  </td>
  <td width=80 nowrap style='width:60.3pt;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;mso-border-left-alt:
  solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:10.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>7<o:p></o:p></span></p>
  </td>
  <td width=106 nowrap colspan=4 style='width:79.85pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:10.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>8<o:p></o:p></span></p>
  </td>
  <td width=95 nowrap colspan=2 style='width:71.45pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:10.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>9<o:p></o:p></span></p>
  </td>
  <td width=65 nowrap style='width:49.0pt;border:none;border-bottom:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:10.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>10<o:p></o:p></span></p>
  </td>
  <td width=90 nowrap style='width:67.25pt;border-top:none;border-left:solid windowtext 1.0pt;
  border-bottom:solid windowtext 1.0pt;border-right:none;mso-border-left-alt:
  solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:10.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>10а<o:p></o:p></span></p>
  </td>
  <td width=105 nowrap style='width:79.1pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;padding:
  0cm 5.4pt 0cm 5.4pt;height:10.75pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>11<o:p></o:p></span></p>
  </td>
 </tr>
  <?php 
    $sumclear = 0;
    $ndssum = 0;
  ?>
  <?php foreach($order->getInvoices() as $invoice):?>
 <tr style='mso-yfti-irow:16;height:11.4pt'>
  <td width=15 nowrap valign=top style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
  <td width=330 colspan=2 valign=top style='width:247.3pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'><?php echo $invoice->getDescription()?><o:p></o:p></span></p>
  </td>
  <td width=35 nowrap colspan=2 valign=top style='width:26.4pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>796<o:p></o:p></span></p>
  </td>
  <td width=94 nowrap colspan=3 valign=top style='width:70.3pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span class=SpellE><span
  class=GramE><span style='font-size:8.0pt;font-family:"Arial","sans-serif";
  mso-fareast-font-family:"Times New Roman";mso-fareast-language:RU'>шт</span></span></span><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'><o:p></o:p></span></p>
  </td>
  <td width=54 nowrap colspan=2 valign=top style='width:40.55pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'><?php echo number_format($invoice->getNumber(),3,',',' ')?><o:p></o:p></span></p>
  </td>
  <td width=69 nowrap colspan=2 valign=top style='width:51.6pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'><?php echo number_format($invoice->getPrice(),2,',',' ')?><o:p></o:p></span></p>
  </td>
  <td width=122 nowrap colspan=3 valign=top style='width:91.5pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'><?php echo 
    number_format(($invoice->getPrice() * $invoice->getNumber()),2,',',' '); ?><o:p></o:p></span></p>
  </td>
  <td width=81 nowrap colspan=2 valign=top style='width:60.45pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>без акциза<o:p></o:p></span></p>
  </td>
  <td width=80 nowrap valign=top style='width:60.3pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>18%<o:p></o:p></span></p>
  </td>
  <td width=106 nowrap colspan=4 valign=top style='width:79.85pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'><?php echo number_format(($invoice->getSum()*18/118),2,',',' ');?><o:p></o:p></span></p>
  </td>
  <td width=95 nowrap colspan=2 valign=top style='width:71.45pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'><?php echo number_format($invoice->getSum(),2,',',' ')?><o:p></o:p></span></p>
  </td>
  <td width=65 valign=top style='width:49.0pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=90 valign=top style='width:67.25pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=105 valign=top style='width:79.1pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
 </tr>
 <?php $sumclear += ($invoice->getNumber() * $invoice->getPrice())?>
 <?php $ndssum += ($invoice->getSum()*18/118)?>
<?php endforeach;?>
  
  
 <tr style='mso-yfti-irow:24;height:11.4pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
  <td width=297 nowrap valign=bottom style='width:222.65pt;border-top:none;
  border-left:solid windowtext 1.0pt;border-bottom:solid windowtext 1.0pt;
  border-right:none;mso-border-left-alt:solid windowtext .5pt;mso-border-bottom-alt:
  solid windowtext .5pt;padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><b><span style='font-size:
  8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Всего к оплате<o:p></o:p></span></b></p>
  </td>
  <td width=33 nowrap valign=bottom style='width:24.65pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><b><span style='font-size:
  8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></b></p>
  </td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=31 nowrap valign=bottom style='width:23.5pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=30 nowrap valign=bottom style='width:22.15pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=25 nowrap valign=bottom style='width:18.4pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=24 nowrap valign=bottom style='width:17.8pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=45 nowrap valign=bottom style='width:33.8pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=122 nowrap colspan=3 valign=bottom style='width:91.5pt;border:solid windowtext 1.0pt;
  border-top:none;mso-border-top-alt:solid windowtext .5pt;mso-border-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'><?php echo number_format($sumclear,2,',',' ') ?><o:p></o:p></span></p>
  </td>
  <td width=81 nowrap colspan=2 valign=bottom style='width:60.45pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><b><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>Х<o:p></o:p></span></b></p>
  </td>
  <td width=80 nowrap valign=bottom style='width:60.3pt;border-top:none;
  border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=106 nowrap colspan=4 valign=bottom style='width:79.85pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'><?php echo number_format($ndssum,2,',',' ') ?><o:p></o:p></span></p>
  </td>
  <td width=95 nowrap colspan=2 valign=bottom style='width:71.45pt;border-top:
  none;border-left:none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  mso-border-top-alt:solid windowtext .5pt;mso-border-top-alt:solid windowtext .5pt;
  mso-border-bottom-alt:solid windowtext .5pt;mso-border-right-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:11.4pt'>
  <p class=MsoNormal align=right style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:right;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:8.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'><?php echo number_format($ndssum + $sumclear,2,',',' ') ?><o:p></o:p></span></p>
  </td>
  <td width=65 nowrap valign=bottom style='width:49.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
  <td width=90 nowrap valign=bottom style='width:67.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
  <td width=105 nowrap valign=bottom style='width:79.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:11.4pt'></td>
 </tr>
 <tr style='mso-yfti-irow:25;height:3.7pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=297 nowrap valign=bottom style='width:222.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=30 nowrap valign=bottom style='width:22.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=24 nowrap valign=bottom style='width:17.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=45 nowrap valign=bottom style='width:33.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=89 nowrap valign=bottom style='width:67.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=63 nowrap valign=bottom style='width:47.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=80 nowrap valign=bottom style='width:60.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=64 nowrap valign=bottom style='width:48.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=65 nowrap valign=bottom style='width:49.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=90 nowrap valign=bottom style='width:67.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
  <td width=105 nowrap valign=bottom style='width:79.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:3.7pt'></td>
 </tr>
 <tr style='mso-yfti-irow:26;height:22.0pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:22.0pt'></td>
  <td width=297 valign=bottom style='width:222.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:22.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Руководитель организации<br>
  или иное уполномоченное лицо<o:p></o:p></span></p>
  </td>
  <td width=33 nowrap valign=bottom style='width:24.65pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:22.0pt'></td>
  <td width=109 nowrap colspan=4 valign=bottom style='width:81.85pt;border:
  none;border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Горбунова И.Н.<o:p></o:p></span></p>
  </td>
  <td width=185 colspan=5 valign=bottom style='width:138.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:22.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Главный бухгалтер<br>
  или иное уполномоченное лицо<o:p></o:p></span></p>
  </td>
  <td width=63 nowrap valign=bottom style='width:47.3pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=80 nowrap valign=bottom style='width:60.3pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:22.0pt'></td>
  <td width=66 nowrap colspan=2 valign=bottom style='width:49.15pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>Цуканова В.В.<o:p></o:p></span></p>
  </td>
  <td width=64 nowrap valign=bottom style='width:48.35pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:22.0pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=31 nowrap valign=bottom style='width:23.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:22.0pt'></td>
  <td width=65 nowrap valign=bottom style='width:49.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:22.0pt'></td>
  <td width=90 nowrap valign=bottom style='width:67.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:22.0pt'></td>
  <td width=105 nowrap valign=bottom style='width:79.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:22.0pt'></td>
 </tr>
 <tr style='mso-yfti-irow:27;height:4.95pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'></td>
  <td width=297 nowrap valign=bottom style='width:222.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'></td>
  <td width=99 nowrap colspan=4 valign=top style='width:74.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>(подпись)<o:p></o:p></span></p>
  </td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'></td>
  <td width=109 nowrap colspan=4 valign=top style='width:81.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>(<span class=SpellE>ф.и.о.</span>)<o:p></o:p></span></p>
  </td>
  <td width=45 nowrap valign=bottom style='width:33.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'></td>
  <td width=89 nowrap valign=bottom style='width:67.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'></td>
  <td width=164 nowrap colspan=3 valign=top style='width:122.95pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>(подпись)<o:p></o:p></span></p>
  </td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'></td>
  <td width=130 nowrap colspan=3 valign=top style='width:97.45pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>(<span class=SpellE>ф.и.о.</span>)<o:p></o:p></span></p>
  </td>
  <td width=31 nowrap valign=bottom style='width:23.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'></td>
  <td width=65 nowrap valign=bottom style='width:49.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'></td>
  <td width=90 nowrap valign=bottom style='width:67.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'></td>
  <td width=105 nowrap valign=bottom style='width:79.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.95pt'></td>
 </tr>
 <tr style='mso-yfti-irow:28;height:4.15pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=297 nowrap valign=bottom style='width:222.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.5pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=30 nowrap valign=bottom style='width:22.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=25 nowrap valign=bottom style='width:18.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=24 nowrap valign=bottom style='width:17.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=45 nowrap valign=bottom style='width:33.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=89 nowrap valign=bottom style='width:67.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=63 nowrap valign=bottom style='width:47.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=80 nowrap valign=bottom style='width:60.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=64 nowrap valign=bottom style='width:48.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=65 nowrap valign=bottom style='width:49.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=90 nowrap valign=bottom style='width:67.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
  <td width=105 nowrap valign=bottom style='width:79.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:4.15pt'></td>
 </tr>
 <tr style='mso-yfti-irow:29;height:9.25pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:9.25pt'></td>
  <td width=297 valign=bottom style='width:222.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'><br>
  Индивидуальный предприниматель<o:p></o:p></span></p>
  </td>
  <td width=33 nowrap valign=bottom style='width:24.65pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:9.25pt'></td>
  <td width=109 nowrap colspan=4 valign=bottom style='width:81.85pt;border:
  none;border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=45 nowrap valign=bottom style='width:33.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:9.25pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:9.25pt'></td>
  <td width=89 nowrap valign=bottom style='width:67.1pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=63 nowrap valign=bottom style='width:47.3pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=80 nowrap valign=bottom style='width:60.3pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=33 nowrap valign=bottom style='width:24.55pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=33 nowrap valign=bottom style='width:24.6pt;border:none;border-bottom:
  solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=64 nowrap valign=bottom style='width:48.35pt;border:none;
  border-bottom:solid windowtext 1.0pt;mso-border-bottom-alt:solid windowtext .5pt;
  padding:0cm 5.4pt 0cm 5.4pt;height:9.25pt'>
  <p class=MsoNormal style='margin-bottom:0cm;margin-bottom:.0001pt;line-height:
  normal;mso-element:frame;mso-element-frame-hspace:9.0pt;mso-element-wrap:
  around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:margin;
  mso-element-top:6.75pt;mso-height-rule:exactly'><span style='font-size:8.0pt;
  font-family:"Arial","sans-serif";mso-fareast-font-family:"Times New Roman";
  mso-fareast-language:RU'>&nbsp;<o:p></o:p></span></p>
  </td>
  <td width=31 nowrap valign=bottom style='width:23.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:9.25pt'></td>
  <td width=65 nowrap valign=bottom style='width:49.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:9.25pt'></td>
  <td width=90 nowrap valign=bottom style='width:67.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:9.25pt'></td>
  <td width=105 nowrap valign=bottom style='width:79.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:9.25pt'></td>
 </tr>
 <tr style='mso-yfti-irow:30;mso-yfti-lastrow:yes;height:16.2pt'>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=297 nowrap valign=bottom style='width:222.65pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=99 nowrap colspan=4 valign=top style='width:74.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>(подпись)<o:p></o:p></span></p>
  </td>
  <td width=31 nowrap valign=bottom style='width:23.4pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=109 nowrap colspan=4 valign=top style='width:81.85pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>(<span class=SpellE>ф.и.о.</span>)<o:p></o:p></span></p>
  </td>
  <td width=45 nowrap valign=bottom style='width:33.8pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=15 nowrap valign=bottom style='width:11.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=89 valign=bottom style='width:67.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'>
  <p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
  text-align:center;line-height:normal;mso-element:frame;mso-element-frame-hspace:
  9.0pt;mso-element-wrap:around;mso-element-anchor-vertical:page;mso-element-anchor-horizontal:
  margin;mso-element-top:6.75pt;mso-height-rule:exactly'><span
  style='font-size:6.0pt;font-family:"Arial","sans-serif";mso-fareast-font-family:
  "Times New Roman";mso-fareast-language:RU'>(реквизиты свидетельства о
  государственной <br>
  регистрации индивидуального предпринимателя)<o:p></o:p></span></p>
  </td>
  <td width=18 nowrap valign=bottom style='width:13.2pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=18 nowrap valign=bottom style='width:13.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=63 nowrap valign=bottom style='width:47.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=80 nowrap valign=bottom style='width:60.3pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=20 nowrap valign=bottom style='width:15.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.55pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=33 nowrap valign=bottom style='width:24.6pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=64 nowrap valign=bottom style='width:48.35pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=31 nowrap valign=bottom style='width:23.15pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=65 nowrap valign=bottom style='width:49.0pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=90 nowrap valign=bottom style='width:67.25pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
  <td width=105 nowrap valign=bottom style='width:79.1pt;padding:0cm 5.4pt 0cm 5.4pt;
  height:16.2pt'></td>
 </tr>
</table>

<p class=MsoNormal><o:p>&nbsp;</o:p></p>

</div>
<div class="title-size">Параметры печати</div>
<div class="print-options">
<h4 id="t_tn" class="h" style="display: block;">Товарная накладная</h4><ul id="c_tn" class="doc h" style="display: block;"><li><input class="hide-doc" type="checkbox" id="tn-929" checked="">№ <a href="" title="Счет-фактура"><?php echo $order->getId()?></a><span>от 
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
