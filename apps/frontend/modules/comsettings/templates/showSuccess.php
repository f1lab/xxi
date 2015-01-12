<table class="table  table-striped table-bordered">
  <tbody>
    <tr>
      <th>Наименование:</th>
      <td><?php echo $company_settings->getName() ?></td>
    </tr>
    <tr>
      <th>Полное наименование:</th>
      <td><?php echo $company_settings->getFullName() ?></td>
    </tr>
    <tr>
      <th>Облагается НДС:</th>
      <td><?php echo $company_settings->getUsesVat() ? 'Да' : 'Нет' ?></td>
    </tr>
    <tr>
      <th>Телефон:</th>
      <td><?php echo $company_settings->getPhone() ?></td>
    </tr>
    <tr>
      <th>Email:</th>
      <td><?php echo $company_settings->getEmail() ?></td>
    </tr>
    <tr>
      <th>Юр. Адрес:</th>
      <td><?php echo $company_settings->getAddressJure() ?></td>
    </tr>
    <tr>
      <th>Инн:</th>
      <td><?php echo $company_settings->getInn() ?></td>
    </tr>
    <tr>
      <th>Кпп:</th>
      <td><?php echo $company_settings->getKpp() ?></td>
    </tr>
    <tr>
      <th>Рс:</th>
      <td><?php echo $company_settings->getRs() ?></td>
    </tr>
    <tr>
      <th>Банк:</th>
      <td><?php echo $company_settings->getBank() ?></td>
    </tr>
    <tr>
      <th>Бик:</th>
      <td><?php echo $company_settings->getBik() ?></td>
    </tr>
    <tr>
      <th>Кс:</th>
      <td><?php echo $company_settings->getKs() ?></td>
    </tr>
    <tr>
      <th>Огрн:</th>
      <td><?php echo $company_settings->getOgrn() ?></td>
    </tr>
    <tr>
      <th>Окпо:</th>
      <td><?php echo $company_settings->getOkpo() ?></td>
    </tr>
    <tr>
      <th>Гл. Бухгалтер:</th>
      <td><?php echo $company_settings->getBuhgalter() ?></td>
    </tr>
    <tr>
      <th>Директор:</th>
      <td><?php echo $company_settings->getDirector() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a class="btn" href="<?php echo url_for('comsettings/edit?id='.$company_settings->getId()) ?>">Редактировать</a>
