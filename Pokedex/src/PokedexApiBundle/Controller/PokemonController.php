<?php

namespace PokedexApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Psr\Log\LoggerInterface;
use PokedexBundle\Entity\Pokemon;
use PokedexBundle\Service\PokemonManager;

class PokemonController extends Controller {
    
    private $logger;
    private $pokemonManager;
    
    function __construct(PokemonManager $pokemonManager, LoggerInterface $logger = null) {
        $this->pokemonManager = $pokemonManager;
        $this->logger = $logger;
    }
    
    /**
     * @Route("/pokemons", methods = {"GET"})
     * 
     * @param Request $request
     * @return JsonResponse
     */
    function listarAction(Request $request) {
        $pokemons = array_map(function($p) {
            $p->setLinkImagem($this->generateUrl('api_pokemon_imagem', ['id' => $p->getId()], 0));
            return $p;
        }, $this->pokemonManager->listar($request->query->all()));
        return new JsonResponse($pokemons, 200, ['Access-Control-Allow-Origin' => '*']);
    }
    
    /**
     * @Route("/pokemons/{id}/imagem", methods = {"GET"}, name = "api_pokemon_imagem")
     * 
     * @param Request $request
     * @return Response
     */
    function getImagemAction($id) {
        $pokemon = $this->pokemonManager->buscar($id);
        $basePath = $this->getParameter('kernel.project_dir');
        $imagem = file_get_contents($basePath . '/web/uploads/' . $pokemon->getImagem());
        $ext = explode('.', $pokemon->getImagem())[1];
        return new Response($imagem, 200, [
            'Content-Type' => "image/{$ext}", 
            'Access-Control-Allow-Origin' => '*'
        ]);
    }
    
    /**
     * @Route("/pokemons", methods = {"POST"})
     * 
     * @param Request $request
     * @return type
     */
    function criarAction(Request $request) {
        $dados = $request->request->all();
        try {
            $tipo = $this->getDoctrine()->getRepository('PokedexBundle:Tipo')->find($dados['tipo']);
            $novoPokemon = new Pokemon($dados['nome'], $dados['descricao'], $dados['numero'], $tipo);
            $novoPokemon->setArquivoImagem($request->files->get('imagem'));
            $pokemon = $this->pokemonManager->inserir($novoPokemon);
            return new JsonResponse($pokemon, 200, ['Access-Control-Allow-Origin' => '*']);
        } catch (\Exception $ex) {
            return new Response($ex->getMessage(), 400, ['Access-Control-Allow-Origin' => '*']);
        }
    }
    
    /**
     * @Route("/pokemons/{id}", methods = {"PUT"})
     * 
     * @param Request $request
     * @return type
     */
    function atualizarAction(Request $request, $id) {
        return new Response();
    }
    
    /**
     * @Route("/pokemons/{id}", methods = {"DELETE"})
     * 
     * @param Request $request
     * @return type
     */
    function deletarAction($id) {
        $this->pokemonManager->remover($id);
        return new Response('', 204);
    }
    
}
