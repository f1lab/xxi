<?php

class Version114 extends Doctrine_Migration_Base
{

    public function up()
    {
        $credential = sfGuardPermission::createFromArray([
            'name' => sfGuardPermissionTable::CAN_VIEW_COSTS,
            'description' => 'Может просматривать стоимости заказов',
        ]);
        $credential->save();
        foreach (['worker', 'buhgalter'] as $groupName) {
            /** @var \sfGuardGroup $group */
            $group = Doctrine_Core::getTable('sfGuardGroup')->findOneBy('name', $groupName);
            foreach ($group->getUsers() as $user) {
                if ($user) {
                    $user->addPermissionByName($credential->name);
                }
            }
        }

        $credential = sfGuardPermission::createFromArray([
            'name' => sfGuardPermissionTable::CAN_EDIT_COSTS,
            'description' => 'Может редактировать стоимости заказов',
        ]);
        $credential->save();
        foreach (['director', 'manager'] as $groupName) {
            /** @var \sfGuardGroup $group */
            $group = Doctrine_Core::getTable('sfGuardGroup')->findOneBy('name', $groupName);
            foreach ($group->getUsers() as $user) {
                if ($user) {
                    $user->addPermissionByName($credential->name);
                }
            }
        }
    }

    public function down()
    {
        $c1 = sfGuardPermissionTable::getInstance()->findBy('name', sfGuardPermissionTable::CAN_VIEW_COSTS);
        if ($c1) {
            $c1->delete();
        }

        $c2 = sfGuardPermissionTable::getInstance()->findBy('name', sfGuardPermissionTable::CAN_EDIT_COSTS);
        if ($c2) {
            $c2->delete();
        }
    }
}
