<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Email: kendoctor@163.com
 * Date: 14-5-30
 * Time: 下午3:15
 * To change this template use File | Settings | File Templates.
 */

namespace Kendoctor\Component\Quest\Requirement;

use Kendoctor\Component\Quest\Questor\QuestorInterface;

interface RequirementInterface {
    public function determineFinished();
    public function doMatch(QuestorInterface $role);
}