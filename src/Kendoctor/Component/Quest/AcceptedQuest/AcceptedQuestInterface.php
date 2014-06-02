<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Kendoctor
 * Email: kendoctor@163.com
 * Date: 14-5-30
 * Time: 下午6:42
 * To change this template use File | Settings | File Templates.
 */

namespace Kendoctor\Component\Quest\AcceptedQuest;

use Kendoctor\Component\Quest\QuestInterface;
use Kendoctor\Component\Quest\Questor\QuestorInterface;

interface AcceptedQuestInterface {
    public function setQuestor(QuestorInterface $questor);
    public function setQuest(QuestInterface $quest);
    public function getQuest();
    public function getQuestor();
    public function getState();
    public function getLockState();
    public function lockFinished();
    //public function lockF
}