<script type="text/javascript">
  var fields = [0,1,3,5,10,15,20];

  var products = {
    'stickers': {
      'materials': [
        {
          'name': 'Самоклеящаяся пленка (глянцевая/матовая/прозрачная) 140г/м^2, 85мкр',
          'widths': [
            '1,37',
            '1,52'
          ],
          'options': {
            'lamination': [
              'не требуется',
              'требуется'
            ],
            'fields': fields
          }
        }, {
          'name': 'Самоклеящаяся пленка металик  (серебро/золото) 140г/м^2, 85мкр',
          'widths': [
            '1,37'
          ],
          'options': {
            'lamination': [
              'не требуется',
              'требуется'
            ],
            'fields': fields
          }
        }
      ],
      'cost': 'some formula',
      'extra': 'some formula'
    }
  };

</script>

<form action="" method="post" class="form-horizontal">
  <div class="control-group">
    <label for="type" class="control-label">Материал</label>
    <div class="controls">
      <select name="type" id="type">
        <option value="">Самоклеящаяся пленка (глянцевая/матовая/прозрачная) 140г/м^2, 85мкр</option>
        <option value="">Самоклеящаяся пленка металик  (серебро/золото) 140г/м^2, 85мкр</option>
      </select>
    </div>
  </div>

  <div class="control-group">
    <label for="width" class="control-label">Ширина рулона</label>
    <div class="controls">
      <select name="width" id="width">
        <option value="">1,37</option>
        <option value="">1,52</option>
      </select>
    </div>
  </div>

  <div class="control-group">
    <label for="marging" class="control-label">Поля</label>
    <div class="controls">
      <select name="marging" id="marging">
        <option value="">0</option>
        <option value="">1</option>
        <option value="">3</option>
        <option value="">5</option>
        <option value="">10</option>
        <option value="">15</option>
        <option value="">20</option>
      </select>
    </div>
  </div>

  <div class="control-group">
    <label for="lamination" class="control-label">Ламинация</label>
    <div class="controls">
      <select name="lamination" id="lamination">
        <option value="">Не требуется</option>
        <option value="">Требуется</option>
      </select>
    </div>
  </div>
</form>
