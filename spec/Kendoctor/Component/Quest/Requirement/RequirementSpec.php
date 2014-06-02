<?php

namespace spec\Kendoctor\Component\Quest\Requirement;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RequirementSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Kendoctor\Component\Quest\Requirement\Requirement');
        $this->shouldImplement('Kendoctor\Component\Quest\Requirement\RequirementInterface');
    }


}
