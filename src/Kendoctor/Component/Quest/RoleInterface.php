<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Email: kendoctor@163.com
 * Date: 14-5-30
 * Time: 下午5:11
 * To change this template use File | Settings | File Templates.
 */

namespace Kendoctor\Component\Quest;


interface RoleInterface {
    public function getQuantityOfItemType($item);
}