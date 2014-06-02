<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Email: kendoctor@163.com
 * Date: 14-5-30
 * Time: 下午10:24
 * To change this template use File | Settings | File Templates.
 */

namespace Kendoctor\Component\Quest;


interface CollectorInterface {
    public function hasEnoughQuantity($item);
}