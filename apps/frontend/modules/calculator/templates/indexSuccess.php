<div class="tabbable tabs-left">
  <ul class="nav nav-tabs">
    <li><a href="#" data-product-index="sfp-solvet">ШФП Сольвет</a></li>
    <li><a href="#" data-product-index="stickers">Наклейки с фигурной резкой</a></li>
  </ul>

  <div class="tab-content">
    <form action="" method="post" class="form-horizontal">
      <div class="control-group" id="materials-container">
        <div class="alert alert-info">Выберите калькулятор.</div>
      </div>

      <div class="control-group" id="widths-container">
      </div>

      <div id="options-container">
      </div>

      <hr />

      <div id="params-container">
        <textarea id="calculationProposal"></textarea>

        <div class="control-group">
          <label for="width" class="control-label">Ширина</label>
          <div class="controls">
            <input type="text" name="width" id="width" />
          </div>
        </div>
        <div class="control-group">
          <label for="height" class="control-label">Высота</label>
          <div class="controls">
            <input type="text" name="height" id="height" />
          </div>
        </div>
        <div class="control-group">
          <label for="quantity" class="control-label">Количество</label>
          <div class="controls">
            <input type="text" name="quantity" id="quantity" value="1"/>
          </div>
        </div>
      </div>

      <div class="form-actions">
        <button class="btn btn-primary" id="calculateIt">Считать</button>
      </div>
    </form>
  </div>
</div>



<script type="text/javascript" src="/js/calculator-products.js?<?php echo rand() ?>"></script>
<script type="text/javascript" src="/js/calculator-logic.js?<?php echo rand() ?>"></script>

<style type="text/css">
  #calculationProposal {
    position: absolute;
    right: 3em;
    width: 42%;
    height: 200px;
  }
</style>
