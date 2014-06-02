<?php

namespace Kendoctor\Component\Quest\Questor;
use Kendoctor\Component\Quest\Npc\NpcInterface;
use Kendoctor\Component\Quest\QuestInterface;
use Kendoctor\Component\Quest\Manager\AcceptedQuestManagerInterface;

class Questor implements QuestorInterface
{
    private $acceptedQuests;
    private $acceptedQuestManager;

    public function __construct(
        AcceptedQuestManagerInterface $acceptedQuestManager
    )
    {
        $this->acceptedQuestManager = $acceptedQuestManager;
        $this->acceptedQuests = array();
    }

    public function getAcceptedQuests()
    {
        return $this->acceptedQuests;
    }


    /**
     * Determines if role has the quest or not
     *
     * @param QuestInterface $quest
     * @return bool
     */
    public function hasQuest(QuestInterface $quest)
    {

        foreach ($this->getAcceptedQuests() as $questToCompare) {
            if ($quest === $questToCompare->getQuest()) {
                return true;
            }
        }
        return false;
    }



    public function acceptQuest(QuestInterface $quest)
    {
        if(!$this->hasQuest($quest))
        {
            $acceptedQuest = $this->acceptedQuestManager->createNew();
            $this->acceptedQuests[] = $acceptedQuest;
            $acceptedQuest->setQuest($quest);
            $acceptedQuest->setQuestor($this);
            //$this->acceptedQuests[] = new AcceptedQuest($this, $quest);
        }

        return $this;
    }

    public function findAcceptedQuest(QuestInterface $quest)
    {
        foreach($this->getAcceptedQuests() as $questToCompare)
        {
            if($quest === $questToCompare->getQuest())
            {
                return $questToCompare;
            }
        }
        return null;
    }

    public function submitQuest(QuestInterface $quest, NpcInterface $npc = null)
    {

        if((null === ($acceptedQuest = $this->findAcceptedQuest($quest)))
            || ($npc && !$quest->hasNpcToSubmit($npc))
            || ($npc === null && $quest->hasNpcsToSubmit()))
            return false;

        if($acceptedQuest->getState() === 'COMPLETED')
        {
            $acceptedQuest->lockFinished();
            return true;
        }

        return false;
    }

    public function getQuantityOfItemType($item)
    {

    }
}
