<?php

namespace AppBundle\Repository;
use AuthentificationBundle\Entity\Candidat;

/**
 * FormationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FormationRepository extends \Doctrine\ORM\EntityRepository
{
    public function formationsPourCandidat(Candidat $candidat){
        $formations= [];
        $SQL = $this->getEntityManager()->getConnection();
        $query = $SQL->prepare('
        SELECT f.id 
        FROM formation f , formation_specialite fs , education e , cv, candidat c
        WHERE f.id = fs.formation_id AND fs.specialite_id = e.specialite_id AND e.cv_id = cv.id
        AND cv.id_candidat = c.id AND c.id = :id
        GROUP BY f.id ;
        ');
        $query->bindValue('id',$candidat->getId(),\PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll();
        foreach ($results as $result){
            array_push($formations,$this->find($result['id']));
        }
        return $formations;
    }
}