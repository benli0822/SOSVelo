<?php

namespace SOSVelo\Bundle\CommentBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class SOSVeloCommentBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSCommentBundle';
    }
}
