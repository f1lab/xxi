<div class="page-header">
  <h1>Отчётность</h1>
</div>

<div class="tabbable tabs-left">
  <?php include_partial('tabs', array('currentRoute' => $sf_context->getRouting()->getCurrentRouteName())) ?>

  <div class="tab-content">
    <h2>Параметры отчёта</h2>
    <form action="" method="post" class="well">
      <div class="control-group">
        <label for="" class="control-label">Период:</label>

        <div class="controls form-horizontal">
          <div class="input-append date" id="order_payed_at_calendar" data-date-format="dd-mm-yyyy" data-date-language="ru">
            <input class="span2" id="order_payed_at_input" type="text" value="" placeholder="from" readonly/><span class="add-on" id="order_payed_at_span"><i class="icon-calendar" style=""></i></span>
          </div>

          <div class="input-append date" id="order_payed_at_calendar" data-date-format="dd-mm-yyyy" data-date-language="ru">
            <input class="span2" id="order_payed_at_input" type="text" value="" placeholder="to" readonly/><span class="add-on" id="order_payed_at_span"><i class="icon-calendar" style=""></i></span>
          </div>
        </div>
      </div>

      <button type="submit" class="btn btn-primary">Получить отчёт</button>
    </form>

    <h2>
      Отчёт
      <small>за период 01.04.2012—01.07.2012</small>
    </h2>
    <table class="table table-striped table-condensed">
      <colgroup>
        <col class="span3" />
        <col class="span" />
        <col class="span2" />
        <col class="span2" />
      </colgroup>
      <thead>
        <tr>
          <th>Менеджер</th>
          <th>Количество заказов</th>
          <th>Σ</th>
          <th>Σ * 0,03</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Вася</td>
          <td>2</td>
          <td>12000</td>
          <td>1200</td>
        </tr>
        <tr>
          <td>Петя</td>
          <td>5</td>
          <td>10000</td>
          <td>1000</td>
        </tr>
        <tr>
          <td>Федя</td>
          <td>1</td>
          <td>150000</td>
          <td>15000</td>
        </tr>
        <tr>
          <td>Игорь</td>
          <td>8</td>
          <td>179999</td>
          <td>17999</td>
        </tr>
        <tr>
          <td>Миша</td>
          <td>1</td>
          <td>1500</td>
          <td>150</td>
        </tr>
        <tr>
          <td><strong>Итого</strong></td>
          <td><strong>21</strong></td>
          <td><strong>152000</strong></td>
          <td><strong>15200</strong></td>
        </tr>
      </tbody>
    </table>
  </div>
</div>