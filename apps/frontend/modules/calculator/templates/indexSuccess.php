<form action="" method="post" class="form-horizontal">
  <div class="control-group" id="materials-container">
    
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

<script type="text/javascript" src="/js/calculator-products.js?<?php echo rand() ?>"></script>
<script type="text/javascript" src="/js/calculator-logic.js?<?php echo rand() ?>"></script>

<style type="text/css">
  #calculationProposal {
    position: absolute;
    right: 3em;
    width: 700px;
    height: 200px;
  }
</style>
