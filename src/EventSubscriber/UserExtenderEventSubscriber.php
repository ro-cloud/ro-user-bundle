<?php

namespace RoCloud\UserBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LoadClassMetadataEventArgs;

/**
 * Extends the given user class when its configured. Keeping it as simple as possible
 */
class UserExtenderEventSubscriber implements EventSubscriber
{
    /**
     * @var string
     */
    private $user;

    /**
     * @param array $user - The user configuration set config.yml
     */
    public function __construct(array $user = [])
    {
        $this->user = $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getSubscribedEvents()
    {
        return [
            'loadClassMetadata',
        ];
    }

    public function loadClassMetadata(LoadClassMetadataEventArgs $eventArgs)
    {
        $metadata = $eventArgs->getClassMetadata();

        if (array_key_exists('class', $this->user) && $metadata->getName() !== $this->user['class']) {
            return;
        }

        call_user_func([$metadata, $this->user['mapping']['type']], $this->user['mapping']);
    }
}
