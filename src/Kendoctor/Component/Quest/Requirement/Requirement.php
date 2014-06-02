<?php

namespace Kendoctor\Component\Quest\Requirement;

use Kendoctor\Component\Quest\Questor\QuestorInterface;

class Requirement implements RequirementInterface
{
    public function determineFinished()
    {

    }

    public function doMatch(QuestorInterface $role)
    {
      return false;
    }
}
