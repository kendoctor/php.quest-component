<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Email: kendoctor@163.com
 * Date: 14-5-30
 * Time: 下午7:06
 * To change this template use File | Settings | File Templates.
 */

namespace Kendoctor\Component\Quest;
use Kendoctor\Component\Quest\Npc\NpcInterface;
use Kendoctor\Component\Quest\Requirement\RequirementInterface;

interface QuestInterface {
    public function addRequirement(RequirementInterface $requirement);
    public function getRequirements();
    public function hasRequirements();
    public function hasNpcToSubmit(NpcInterface $npc);
    public function addNpcToSubmit(NpcInterface $npc);
    public function hasNpcsToSubmit();
}