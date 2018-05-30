<?php

namespace yedincisenol\UserProviderTwitter;

use yedincisenol\UserProvider\UserProviderGrantAbstract;

class UserProviderTwitterGrant extends UserProviderGrantAbstract
{

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return 'twitter';
    }

}