<?php

namespace PokedexBundle\Service;

use Symfony\Component\HttpFoundation\File\File;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use PokedexBundle\Entity\Pokemon;

class PokemonManager {
    
    private $entityManager;
    private $uploadPath;
    
    function __construct(EntityManagerInterface $em, $uploadPath = '../web/uploads') {
        $this->entityManager = $em;
        $this->uploadPath = $uploadPath;
    }

    function paramMap() {
        return [
            'nome' => function(QueryBuilder $qb, $value) {
                $qb->andWhere('p.nome LIKE :nome')->setParameter('nome', "%{$value}%");
            },
            'numero' => function(QueryBuilder $qb, $value) {
                $qb->andWhere('p.numero = :numero')->setParameter('numero', $value);
            },
            'tipo' => function(QueryBuilder $qb, $value) {
                $qb->andWhere('p.tipo = :tipo')->setParameter('tipo', $value);
            }
        ];
    }
    
    function buscar($id) {
        $pokemon = $this->entityManager->find('PokedexBundle:Pokemon', $id);
        $file = new File($this->uploadPath . '/' . $pokemon->getImagem());
        $pokemon->setArquivoImagem($file);
        return $pokemon;
    }
    
    function listar(array $params) {
        return $this->createQuery($params)->getResult();
    }
    
    private function createQuery(array $params) {
        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('p')->from('PokedexBundle:Pokemon', 'p')->where('p.id > 0');
        $paramMap = $this->paramMap();
        foreach ($params as $name => $value) {
            if (key_exists($paramMap, $name)) {
                $paramMap[$name]($qb, $value);
            }
        }
        return $qb->orderBy('p.nome')->getQuery();
    }
    
    function inserir(Pokemon $pokemon) {
        $fileName = $pokemon->getNumero() . '.' . $pokemon->getArquivoImagem()->guessExtension();
        $pokemon->setImagem($fileName);
        $this->entityManager->persist($pokemon);
        $this->entityManager->flush();
        $pokemon->getArquivoImagem()->move($this->uploadPath, $fileName);
    }
    
    function atualizar(Pokemon $pokemon) {
        if ($pokemon->getArquivoImagem()) {
            $fileName = $pokemon->getNumero() . '.' . $pokemon->getArquivoImagem()->guessExtension();
            $pokemon->setImagem($fileName);
            $pokemon->getArquivoImagem()->move($this->uploadPath, $fileName);
        }
        $this->entityManager->merge($pokemon);
        $this->entityManager->flush();
    }
    
    function remover($id) {
        $pokemon = $this->entityManager->getReference('PokedexBundle:Pokemon', $id);
        $this->entityManager->remove($pokemon);
        $this->entityManager->flush();
    }
    
}
