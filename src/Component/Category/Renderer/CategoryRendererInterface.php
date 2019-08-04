<?php

declare(strict_types=1);

namespace Component\Category\Renderer;
use Bundle\UserBundle\Entity\User;

interface CategoryRendererInterface
{

    // JAFETH
//    public function profileAboutMe(string $aboutMe = null);
//    public function appUserName(User $user, $start, $length = null);
    public function tianosCategoryTree();

}
