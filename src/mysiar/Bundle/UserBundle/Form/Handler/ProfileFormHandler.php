<?php
/**
 * Piotr Synowiec (c) 2016 psynowiec@gmail.com
 *
 * Date: 2016-10-12
 * Time: 10:23

services.yml
app.form.handler.profile:
    class: mysiar\Bundle\UserBundle\Form\Handler\ProfileFormHandler
    arguments: ["@fos_user.profile.form", "@request", "@fos_user.user_manager"]
    scope: request
    public: false
*/

namespace mysiar\Bundle\UserBundle\Form\Handler;

use FOS\UserBundle\Form\Handler\ProfileFormHandler as BaseHandler;

use FOS\UserBundle\Model\UserInterface;


class ProfileFormHandler extends BaseHandler
{

    public function process(UserInterface $user)
    {
        parent::process($user);
    }

    protected function onSuccess(UserInterface $user)
    {
        $this->userManager->updateUser($user);
    }

}