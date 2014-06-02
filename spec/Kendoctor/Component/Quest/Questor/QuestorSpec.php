<?php

namespace spec\Kendoctor\Component\Quest\Questor;

use Kendoctor\Component\Quest\AcceptedQuest\AcceptedQuestInterface;
use Kendoctor\Component\Quest\Manager\AcceptedQuestManagerInterface;
use Kendoctor\Component\Quest\Npc\NpcInterface;
use Kendoctor\Component\Quest\QuestInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class QuestorSpec extends ObjectBehavior
{

    function let(AcceptedQuestManagerInterface $acceptedQuestManager)
    {
        $this->beConstructedWith($acceptedQuestManager);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('Kendoctor\Component\Quest\Questor\Questor');
        $this->shouldBeAnInstanceOf('Kendoctor\Component\Quest\Questor\QuestorInterface');
    }

    function it_has_empty_accepted_quests_by_default()
    {
        $this->getAcceptedQuests()->shouldHaveCount(0);
    }

    function its_acceptQuest_implements_a_fluent_interface(
        AcceptedQuestManagerInterface $acceptedQuestManager,
        QuestInterface $quest, AcceptedQuestInterface $acceptedQuest
    )
    {
        $acceptedQuestManager->createNew()->willReturn($acceptedQuest);
        $this->acceptQuest($quest)->shouldReturn($this);
    }

    function its_accepted_quests_is_mutable(
        AcceptedQuestManagerInterface $acceptedQuestManager,
        QuestInterface $quest, AcceptedQuestInterface $acceptedQuest
    )
    {
        $acceptedQuestManager->createNew()->willReturn($acceptedQuest);
        $this->acceptQuest($quest);
        $this->getAcceptedQuests()->shouldHaveCount(1);
        //$this->removeQuest($quest);
    }

    //function its_rejects_to_accept_already_


   function it_accepts_quests_from_npc(AcceptedQuestManagerInterface $acceptedQuestManager,
                                       QuestInterface $quest, AcceptedQuestInterface $acceptedQuest,
                                       NpcInterface $npc)
    {
        $acceptedQuestManager->createNew()->willReturn($acceptedQuest);
        $this->acceptQuest($quest, $npc);
        $this->getAcceptedQuests()->shouldHaveCount(1);
    }


    function it_fails_to_submit_quest_when_quest_has_npcs_to_submit_but_given_none_npc(
        AcceptedQuestManagerInterface $acceptedQuestManager,
        QuestInterface $quest,
        AcceptedQuestInterface $acceptedQuest)
    {
        $acceptedQuestManager->createNew()->willReturn($acceptedQuest);

        $acceptedQuest->setQuest($quest)->shouldBeCalled();
        $acceptedQuest->setQuestor($this)->shouldBeCalled();
        $acceptedQuest->getQuest()->willReturn($quest);

        $this->acceptQuest($quest, null); //npc is null
        $quest->hasNpcsToSubmit()->shouldBeCalled()->willReturn(true);
        $this->submitQuest($quest)->shouldReturn(false);
    }

    /*function it_succeeds_to_submit_quest_when_quest_has_no_npcs_to_submit_and_given_none_npc(
        AcceptedQuestManagerInterface $acceptedQuestManager,
        QuestInterface $quest,
        AcceptedQuestInterface $acceptedQuest)
    {
        $acceptedQuestManager->createNew()->willReturn($acceptedQuest);
        $acceptedQuest->setQuest($quest)->shouldBeCalled();
        $acceptedQuest->setQuestor($this)->shouldBeCalled();
        $acceptedQuest->getQuest()->willReturn($quest);

        $acceptedQuest->getState()->shouldBeCalled();
        $acceptedQuest->getLockState()->willReturn(null);
        $acceptedQuest->lockFinished()->shouldBeCalled();
        $quest->hasRequirements()->shouldBeCalled(); //default empty
        $quest->hasNpcsToSubmit()->shouldBeCalled(); //default no npcs to submit

        $this->acceptQuest($quest);

        $this->submitQuest($quest)->shouldReturn(true);
    }

            function it_succeeds_to_submit_quest_when_quest_has_this_npc_to_submit(QuestInterface $quest, $npc)
            {
                $quest->hasRequirements()->shouldBeCalled();


                $this->acceptQuest($quest);

                $quest->hasNpcToSubmit($npc)->shouldBeCalled()->willReturn(true);

                $this->submitQuest($quest, $npc)->shouldReturn(true);
            }

            function it_fails_to_submit_quest_when_quest_has_no_this_npc_to_submit(
                QuestInterface $quest,
                NpcInterface $npc)
            {

                $this->acceptQuest($quest);
                $quest->hasNpcToSubmit($npc)->shouldBeCalled()->willReturn(false);

                $this->submitQuest($quest, $npc)->shouldReturn(false);
            }*/

}
