<?php
$navLists = [
    "Заказы" => [
        "credentials" => !$sf_user->hasGroup("master") and !$sf_user->hasGroup("design-master"),
        "isActive" => $sf_context->getModuleName() == "order",
        "href" => url_for("@orders"),
    ],
    "Клиенты" => [
        "credentials" => !$sf_user->hasGroup("master") and !$sf_user->hasGroup("design-master"),
        "isActive" => $sf_context->getModuleName() == "client",
        "href" => url_for("@clients"),
    ],

    // "Материалы" => [
    // "Поступления материалов" => [
    //   "credentials" => $sf_user->hasCredential("can_edit_arrivals"),
    //   "isActive" => $sf_context->getModuleName() == "arrival",
    //   "href" => url_for("arrival/index"),
    // ],
    // ],

    "Справочники" => [
        // "Номенклатура" => [
        //   "credentials" => $sf_user->hasCredential("can_edit_nomenclature"),
        //   "isActive" => $sf_context->getModuleName() == "nomenclature",
        //   "href" => url_for("nomenclature/index"),
        // ],
        "Участки" => [
            "credentials" => $sf_user->hasCredential("can_edit_area"),
            "isActive" => $sf_context->getModuleName() == "area",
            "href" => url_for("area/index"),
        ],
        "Работы" => [
            "credentials" => $sf_user->hasCredential("can_edit_work"),
            "isActive" => $sf_context->getModuleName() == "work",
            "href" => url_for("work/index"),
        ],
        "Поставщики материалов" => [
            "credentials" => $sf_user->hasCredential("can_edit_suppliers"),
            "isActive" => $sf_context->getModuleName() == "supplier",
            "href" => url_for("@suppliers"),
        ],
        "Номенклатура материалов" => [
            "credentials" => $sf_user->hasCredential("can_edit_materials"),
            "isActive" => $sf_context->getModuleName() == "material",
            "href" => url_for("material/index"),
        ],
        "Подрядчики" => [
            "credentials" => $sf_user->hasCredential("can_edit_contractors"),
            "isActive" => $sf_context->getModuleName() == "contractor",
            "href" => url_for("@contractors"),
        ],
        "Склады" => [
            "credentials" => $sf_user->hasCredential("can edit warehouses"),
            "isActive" => $sf_context->getModuleName() == "warehouse",
            "href" => url_for("warehouse/index"),
        ],
    ],

    "Отчётность" => [
        "credentials" => $sf_user->hasCredential("can_view_reports"),
        "isActive" => $sf_context->getModuleName() == "report",
        "href" => url_for("report/index"),
    ],

    "Планирование" => [
        "credentials" => (
            $sf_user->hasCredential("сan_see_planning") or $sf_user->hasCredential("сan_edit_planning")
            or $sf_user->hasGroup("master")
            or $sf_user->hasGroup("worker")
            or $sf_user->hasGroup("design-worker")
            or $sf_user->hasGroup("design-master")
        ),
        "isActive" => $sf_context->getModuleName() == "plan",
        "href" => url_for("plan/index"),
    ],

    "Пользователи" => [
        "Права" => [
            "credentials" => $sf_user->isSuperadmin() || $sf_user->hasGroup('director'),
            "isActive" => $sf_context->getModuleName() == "permissions",
            "href" => url_for("permissions/index"),
        ],
        "Группы" => [
            "credentials" => $sf_user->isSuperadmin() || $sf_user->hasGroup('director'),
            "isActive" => $sf_context->getModuleName() == "groups",
            "href" => url_for("groups/index"),
        ],
        "Пользователи" => [
            "credentials" => $sf_user->isSuperadmin() || $sf_user->hasGroup('director'),
            "isActive" => $sf_context->getModuleName() == "users",
            "href" => url_for("users/index"),
        ],
    ],
];
?>

<ul class="nav">
    <?php foreach ($navLists as $navListName => $navList): ?>
        <?php if (count($navList) === 3 and isset($navList["credentials"]) and isset($navList["isActive"])
            and isset($navList["href"])
        ): ?>
            <?php if ($navList["credentials"]): ?>
                <li class="<?php if ($navList["isActive"]) echo "active" ?>"><a
                            href="<?php echo $navList["href"] ?>"><?php echo $navListName ?></a></li>
            <?php endif ?>

        <?php else: ?>
            <?php if (in_array(true, array_map(function ($nav) { // has user any list"s credential?
                return $nav["credentials"];
            }, $navList))): ?>
                <li class="dropdown<?php echo in_array(true, array_map(function ($nav) { // is any of list active?
                    return $nav["isActive"];
                }, $navList)) ? " active" : "" ?>">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <?php echo $navListName ?>
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu"><?php foreach ($navList as $name => $nav): ?>
                            <?php if ($nav["credentials"]): ?>
                                <li class="<?php echo $nav["isActive"] ? " active" : "" ?>"><a
                                            href="<?php echo $nav["href"] ?>"><?php echo $name ?></a></li>
                            <?php endif ?>
                        <?php endforeach ?></ul>
                </li>
            <?php endif ?>
        <?php endif ?>
    <?php endforeach ?>
</ul>
