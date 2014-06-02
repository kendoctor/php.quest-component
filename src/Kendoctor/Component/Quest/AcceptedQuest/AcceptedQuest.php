<?php

namespace Kendoctor\Component\Quest\AcceptedQuest;

use Kendoctor\Component\Quest\QuestInterface;
use Kendoctor\Component\Quest\Questor\QuestorInterface;

class AcceptedQuest implements AcceptedQuestInterface
{
    private $questor;
    private $quest;
    private $lockState;

    public function __construct(QuestorInterface $questor = null, QuestInterface $quest = null)
    {
        $this->questor = $questor;
        $this->quest = $quest;
    }

    public function getQuestor()
    {
       return $this->questor;
    }

    public function setQuestor(QuestorInterface $questor){
        $this->questor = $questor;
    }

    public function setQuest(QuestInterface $quest){
        $this->quest = $quest;
    }

    public function getQuest()
    {
        return $this->quest;
    }

    /**
     * Returns the lock state, FINISHED, FAILURE, UNKNOWN
     *
     * @return string
     */
    public function getLockState()
    {
        return $this->lockState;
    }


    public function getState()
    {
       if($this->getLockState() === 'FINISHED') return 'SUBMITTED';

       if(!$this->quest->hasRequirements())
       {
           return 'COMPLETED';
       }

       foreach($this->getQuest()->getRequirements() as $requirement)
       {
           if(!$requirement->determineFinished($this->getQuestor())) return 'UNCOMPLETED';
       }

       return 'COMPLETED';
    }

    public function lockFinished()
    {
        if($this->getState() === 'SUBMITTED')
        {
            throw new \Exception('Quest has already locked finished');
        }

        if ($this->getState() === 'COMPLETED') {
            $this->lockState = 'FINISHED';
            return true;
        }
        return false;
    }
}
