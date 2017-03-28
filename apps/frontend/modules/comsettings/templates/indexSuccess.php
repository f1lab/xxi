<h1>Company settingss List</h1>

<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Full name</th>
        <th>Phone</th>
        <th>Email</th>
        <th>Address jure</th>
        <th>Inn</th>
        <th>Kpp</th>
        <th>Rs</th>
        <th>Bank</th>
        <th>Bik</th>
        <th>Ks</th>
        <th>Ogrn</th>
        <th>Okpo</th>
        <th>Buhgalter</th>
        <th>Director</th>
        <th>Created by</th>
        <th>Updated by</th>
        <th>Deleted at</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($company_settingss as $company_settings): ?>
        <tr>
            <td><a href="<?php echo url_for('comsettings/show?id='
                    . $company_settings->getId()) ?>"><?php echo $company_settings->getId() ?></a></td>
            <td><?php echo $company_settings->getName() ?></td>
            <td><?php echo $company_settings->getFullName() ?></td>
            <td><?php echo $company_settings->getPhone() ?></td>
            <td><?php echo $company_settings->getEmail() ?></td>
            <td><?php echo $company_settings->getAddressJure() ?></td>
            <td><?php echo $company_settings->getInn() ?></td>
            <td><?php echo $company_settings->getKpp() ?></td>
            <td><?php echo $company_settings->getRs() ?></td>
            <td><?php echo $company_settings->getBank() ?></td>
            <td><?php echo $company_settings->getBik() ?></td>
            <td><?php echo $company_settings->getKs() ?></td>
            <td><?php echo $company_settings->getOgrn() ?></td>
            <td><?php echo $company_settings->getOkpo() ?></td>
            <td><?php echo $company_settings->getBuhgalter() ?></td>
            <td><?php echo $company_settings->getDirector() ?></td>
            <td><?php echo $company_settings->getCreatedBy() ?></td>
            <td><?php echo $company_settings->getUpdatedBy() ?></td>
            <td><?php echo $company_settings->getDeletedAt() ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<a href="<?php echo url_for('comsettings/new') ?>">New</a>
