<?php

namespace App\Security;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class AccountVoter extends Voter
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }




    const VIEW = 'view';
    const EDIT = 'edit';
    const NEW = 'new';
    const DELETE = 'delete';

    protected function supports($attribute, $subject)
    {
        if (!in_array($attribute, [self::VIEW, self::EDIT, self::NEW, self::DELETE])) {
            return false;
        }

        if (!$subject instanceof Account) {
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $account = $token->getUser();

        if (!$account instanceof Account || !$this->security->isGranted('ROLE_USER')) {
            return false;
        }

        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        switch ($attribute) {
            case self::VIEW:
                return true;
            case self::EDIT:
                return $this->canEdit($subject, $account);
            case self::NEW:
                return $this->canCreate($account);
            case self::DELETE:
                return $this->canDelete($account);

        }

        throw new \LogicException('This code should not be reached!');
    }

    private function canEdit($subject, $account)
    {
        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        return $subject->getEmployee()->getId() == $account->getEmployee()->getId();
    }

    private function canDelete($account)
    {
        return $this->canCreate($account);
    }

    private function canCreate($account , OutputInterface $output)
    {

        if ($this->security->isGranted('ROLE_ADMIN')) {
            return true;
        }

        if ($this->security->isGranted('ROLE_USER') && $account->getValidTo() == null) {
            return true;
        }

        return false;
    }
}
