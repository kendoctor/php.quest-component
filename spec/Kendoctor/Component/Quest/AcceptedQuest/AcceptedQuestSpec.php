<?php

namespace spec\Kendoctor\Component\Quest\AcceptedQuest;

use Kendoctor\Component\Quest\QuestInterface;
use Kendoctor\Component\Quest\Questor\QuestorInterface;
use Kendoctor\Component\Quest\Requirement\RequirementInterface;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;


class AcceptedQuestSpec extends ObjectBehavior
{
    function let(QuestorInterface $questor, QuestInterface $quest)
    {
        $this->beConstructedWith($questor, $quest);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Kendoctor\Component\Quest\AcceptedQuest\AcceptedQuest');
    }

    function it_has_a_questor()
    {
        $this->getQuestor()->shouldImplement('Kendoctor\Component\Quest\Questor\QuestorInterface');
    }

    function it_has_a_quest()
    {
        $this->getQuest()->shouldImplement('Kendoctor\Component\Quest\QuestInterface');
    }

    function it_is_completed_when_quest_has_no_requirements()
    {
        $this->getState()->shouldBe('COMPLETED');
    }

    function it_is_uncompleted_when_quest_has_an_unfinished_requirement(
        QuestInterface $quest,
        RequirementInterface $requirement1)
    {
       $requirement1->determineFinished($this->getQuestor())->shouldBeCalled()->willReturn(false);
       $quest->hasRequirements()->willReturn(true);
       $quest->getRequirements()->willReturn(array($requirement1));
       $this->getState()->shouldBe('UNCOMPLETED');
    }

    function it_is_completed_when_all_requirements_of_quest_are_finished(
        RequirementInterface $requirement1,
        RequirementInterface $requirement2,
        $quest
    )
    {
        $requirement1->determineFinished($this->getQuestor())->shouldBeCalled()->willReturn(true);
        $requirement2->determineFinished($this->getQuestor())->shouldBeCalled()->willReturn(true);
        $quest->hasRequirements()->willReturn(true);
        $quest->getRequirements()->willReturn(array($requirement1, $requirement2));

        $this->getState()->shouldBe('COMPLETED');
    }

    function it_successfully_locks_finished_when_it_is_completed()
    {
        //$this->getState()->shouldBeCalled();
        $this->lockFinished()->shouldReturn(true);
        $this->getState()->shouldBe('SUBMITTED');
    }

    function it_fails_to_lock_finished_when_it_is_uncompleted(
        RequirementInterface $requirement1,
        $quest
    )
    {
        $requirement1->determineFinished($this->getQuestor())->shouldBeCalled()->willReturn(false);
        $quest->hasRequirements()->willReturn(true);
        $quest->getRequirements()->willReturn(array($requirement1));

        $this->lockFinished()->shouldReturn(false);
    }

    function it_should_throw_exception_when_it_locks_submitted_quest()
    {
        $this->lockFinished();
        $this->shouldThrow()->during('lockFinished');
    }



}
