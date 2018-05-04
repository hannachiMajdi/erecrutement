<?php
namespace AuthentificationBundle\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use AuthentificationBundle\Entity\Candidat;
use AuthentificationBundle\Entity\Personnel;
use Symfony\Component\Security\Core\User\UserInterface;

class HashPasswordListener implements EventSubscriber
{
    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function getSubscribedEvents()
    {
        return ['prePersist', 'preUpdate'];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        //he4i
        $entity = $args->getEntity();
        if ((!$entity instanceof Personnel)||(!$entity instanceof Candidat)) {
            return;
        }
        $this->encodePassword($entity);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        if  ((!$entity instanceof Personnel)||(!$entity instanceof Candidat)){
            return;
        }
        $this->encodePassword($entity);
        // necessary to force the update to see the change
        $em = $args->getEntityManager();
        $meta = $em->getClassMetadata(get_class($entity));
        $em->getUnitOfWork()->recomputeSingleEntityChangeSet($meta, $entity);
    }

    /**
     * @param UserInterface $entity
     */
    public function encodePassword(UserInterface $entity)
    {
        if (!$entity->getPlainPassword()) {
            return;
        }
        $encoded = $this->passwordEncoder->encodePassword(
            $entity,
            $entity->getPlainPassword()
        );
        $entity->setMotsDePasse($encoded);
    }
    /**
     * @param UserInterface $entity
     */
    public function encode(UserInterface $entity){
       $this->encodePassword($entity);
    }


}