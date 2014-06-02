<?php

namespace spec\Kendoctor\Component\Quest;

use Kendoctor\Component\Quest\Npc\NpcInterface;
use Kendoctor\Component\Quest\Requirement\Requirement;
use Kendoctor\Component\Quest\Requirement\RequirementInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QuestSpec extends ObjectBehavior
{
    function let()
    {
       // $this->beConstructedWith();
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Kendoctor\Component\Quest\Quest');
        $this->shouldBeAnInstanceOf('Kendoctor\Component\Quest\QuestInterface');
    }

    function its_title_is_mutable_and_setter_implements_fluent_interface()
    {
        $this->setTitle("It's a first quest for you")->shouldReturn($this);
        $this->getTitle()->shouldBe("It's a first quest for you");
    }

    function its_brief_is_mutable_and_setter_implements_fluent_interface()
    {
        $this->setBrief("Learn how to make a hell world program")->shouldReturn($this);
        $this->getBrief()->shouldBe("Learn how to make a hell world program");
    }

    function its_details_is_mutable_and_setter_implements_fluent_interface()
    {
        $this->setDetails("bla bla bla")->shouldReturn($this);
        $this->getDetails()->shouldBe("bla bla bla");
    }

    function it_has_empty_requirements_by_default()
    {
        $this->getRequirements()->shouldHaveCount(0);
    }

    function its_addRequirement_implements_a_fluent_interface(RequirementInterface $requirement)
    {
        $this->addRequirement($requirement)->shouldReturn($this);
    }

    function its_requirements_is_addable(RequirementInterface $requirement)
    {
        $this->addRequirement($requirement);
        $this->getRequirements()->shouldHaveCount(1);
    }

    function it_has_the_requirement_which_just_added(RequirementInterface $requirement)
    {
        $this->addRequirement($requirement);
        $this->hasRequirement($requirement)->shouldReturn(true);
    }

    function it_adds_the_same_requirement_only_once(RequirementInterface $requirement)
    {
        $this->addRequirement($requirement);
        $this->addRequirement($requirement);
        $this->getRequirements()->shouldHaveCount(1);
    }

    function it_has_requirements_when_any_requirement_added(RequirementInterface $requirement)
    {
        $this->addRequirement($requirement);
        $this->hasRequirements()->shouldReturn(true);
    }

    function it_has_empty_npcsToSubmit_by_default()
    {
        $this->getNpcsToSubmit()->shouldHaveCount(0);
    }

    function its_addNpcToSubmit_implements_a_fluent_interface(NpcInterface $npc)
    {
        $this->addNpcToSubmit($npc)->shouldReturn($this);
    }

    function its_npcsToSubmit_is_addable(NpcInterface $npc)
    {
        $this->addNpcToSubmit($npc);
        $this->getNpcsToSubmit()->shouldHaveCount(1);
    }

    function it_has_the_npc_to_submit_which_just_added(NpcInterface $npc)
    {
        $this->addNpcToSubmit($npc);
        $this->hasNpcToSubmit($npc)->shouldReturn(true);
    }

    function it_adds_the_same_npc_to_submit_only_once(NpcInterface $npc)
    {
        $this->addNpcToSubmit($npc);
        $this->addNpcToSubmit($npc);
        $this->getNpcsToSubmit()->shouldHaveCount(1);
    }

    function it_has_npcsToSubmit_when_any_npc_to_submit_added(NpcInterface $npc)
    {
        $this->addNpcToSubmit($npc);
        $this->hasNpcsToSubmit()->shouldReturn(true);
    }

    function it_has_empty_rewards_by_default()
    {
        $this->getRewards()->shouldHaveCount(0);
    }

    function its_rewards_is_addable($reward)
    {
        $this->addReward($reward);
        $this->getRewards()->shouldHaveCount(1);
    }

    function its_addReward_implements_a_fluent_interface($reward)
    {
        $this->addReward($reward)->shouldReturn($this);
    }





    /*function it_is_completed_when_it_has_no_any_requirements()
    {
        $this->getState()->shouldBe('COMPLETED');
    }

    function it_is_completed_when_its_requirements_are_all_matched(
        RequirementInterface $requirement1,
        RequirementInterface $requirement2
    )
    {
        $this->addRequirement($requirement1);
        $this->addRequirement($requirement2);
        $this->getState()->shouldBe('COMPLETED');
    }*/


/*
    function it_is_accepted_when_it_has_requirement_not_matched_finished($acceptor, $requirement)
    {
        $requirement->determineState($acceptor)->willReturn(false);
        $this->addRequirement($requirement);
        $this->getState()->shouldBe('ACCEPTED');
    }*/

}
