<?php

namespace Kendoctor\Component\Quest;

use Kendoctor\Component\Quest\Npc\NpcInterface;
use Kendoctor\Component\Quest\Requirement\RequirementInterface;

/**
 * Quest
 * availability : completed once for ever | completed everyday only once
 * | completed not exceeds n times any time | complete it not exceeds n times in one day => strategy
 *
 * Class Quest
 *
 * @package Kendoctor\Component\Quest
 */
class Quest implements QuestInterface
{
    private $title;

    private $brief;
    private $details;

    private $requirements;
    private $npcsToSubmit;
    private $rewards;

    public function __construct($title = null)
    {
        $this->title = $title;
        $this->requirements = array();
        $this->npcsToSubmit = array();
        $this->rewards = array();
    }

    /**
     * Sets the title of quest
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Return the title of quest
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Gets all requirements of quest
     *
     * @return array
     */
    public function getRequirements()
    {
        return $this->requirements;
    }

    /**
     * Adds a requirement to quest
     *
     * @param $requirement
     * @return $this
     */
    public function addRequirement(RequirementInterface $requirement)
    {
        if (!$this->hasRequirement($requirement)) {
            $this->requirements[] = $requirement;
        }
        return $this;
    }

    /**
     * Determines if quest has the requirement or not
     *
     * @param $requirement
     * @return bool
     */
    public function hasRequirement(RequirementInterface $requirement)
    {
        foreach($this->requirements as $requirementToCompare)
        {
            if ($requirement === $requirementToCompare) {
                return true;
            }
        }
        return false;
    }


    /**
     * Determines if has any requirements or not
     *
     * @return bool
     */
    public function hasRequirements()
    {
       return count($this->requirements) !== 0;
    }


    /**
     * Returns npcs to submit
     *
     * @return array
     */
    public function getNpcsToSubmit()
    {
        return $this->npcsToSubmit;
    }

    /**
     * Adds a npc to submit
     *
     * @param $npc
     * @return $this
     */
    public function addNpcToSubmit(NpcInterface $npc)
    {
        if (!$this->hasNpcToSubmit($npc)) {
            $this->npcsToSubmit[] = $npc;
        }
        return $this;
    }

    /**
     * Determines if it has npc to submit or not
     *
     * @param $npc
     * @return bool
     */
    public function hasNpcToSubmit(NpcInterface $npc)
    {
        foreach($this->npcsToSubmit as $npcToCompare)
        {
            if($npc === $npcToCompare) return true;
        }
        return false;
    }

    /**
     * Determine if it has any npcs to submit or not
     *
     * @return bool
     */
    public function hasNpcsToSubmit()
    {
       return count($this->npcsToSubmit) !== 0;
    }


    /**
     * Returns all rewards of quest
     *
     * @return array
     */
    public function getRewards()
    {
        return $this->rewards;
    }

    /**
     * Adds a reward for the quest
     *
     * @param $reward
     */
    public function addReward($reward)
    {
        $this->rewards[] = $reward;
        return $this;
    }

    public function setBrief($brief)
    {
       $this->brief = $brief;
       return $this;
    }

    public function setDetails($details)
    {
        $this->details = $details;
        return $this;
    }

    public function getBrief()
    {
        return $this->brief;
    }

    public function getDetails()
    {
        return $this->details;
    }
}
