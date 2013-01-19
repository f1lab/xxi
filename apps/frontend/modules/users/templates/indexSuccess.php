<h1>Пользователи</h1>

<table class="table table-condensed table-bordered">
  <thead>
    <tr>
      <th>Id</th>
      <th>Имя пользователя</th>
      <th>Имя</th>
      <th>Фамилия</th>
      <th>Электронный адрес</th>
      <th>Активирован</th>
      <th>Админ</th>
      <th>Последний вход</th>
      <th>Создан</th>
      <th>Изменен</th>
    </tr>
  </thead>
  <tbody>
  <div class="btn-group">
    <a href="<?php echo url_for('users/new') ?>" class="btn btn-primary">
      <i class="icon-plus icon-white"></i>
      Добавить пользователя
    </a>
  </div>
  <br>
    <?php foreach ($sf_guard_users as $sf_guard_user): ?>
    <tr>
      <td><?php echo $sf_guard_user->getId() ?></a></td>
      <td><a href="<?php echo url_for('users/edit?id='.$sf_guard_user->getId()) ?>"><?php echo $sf_guard_user->getUsername() ?></td>
      <td><?php echo $sf_guard_user->getFirstName() ?></td>
      <td><?php echo $sf_guard_user->getLastName() ?></td>
      <td><?php echo $sf_guard_user->getEmailAddress() ?></td>
      <td><?php echo $sf_guard_user->getIsActive() ?></td>
      <td><?php echo $sf_guard_user->getIsSuperAdmin() ?></td>
      <td><?php echo $sf_guard_user->getLastLogin() ?></td>
      <td><?php echo $sf_guard_user->getCreatedAt() ?></td>
      <td><?php echo $sf_guard_user->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
