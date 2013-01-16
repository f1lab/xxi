<div class="page-header">
  <h1>Добавить пользователя</h1>
</div>

<?php echo $form->renderFormTag(url_for('@users-create'), array('class' => 'well form-fluid')) ?>
  <?php echo $form->renderUsing('bootstrap') ?>
  <div class="form-actions ">
    <button type="submit" class="btn btn-primary">
      <i class="icon-ok icon-white"></i>
      Сохранить
    </button>
    <a class="btn" href="javascript:window.history.back()">
      Вернуться
    </a>
  </div>
</form>