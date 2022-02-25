<?php
namespace Controllers;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

use \DataLayer\MovieData;

class MovieController
{
	private MovieData $movieData;

	public function __construct(ContainerInterface $container)
	{
		$this->movieData = $container->get('movieData');
	}

	public function listAll(Request $request, Response $response, array $args)
	{
		$movies = $this->movieData->getAllMovies();
		return $response->withJson($movies);
	}

	public function matchingMovies(Request $request, Response $response)
	{
		$parsedTerm = str_replace("'", '', $_GET['movie']);	
		$parsedTerm = str_replace('"', "", $parsedTerm);	
		$searchTerm = $parsedTerm;
		$matchedMovies = $this->movieData->getMatchingMovies($searchTerm);
		return $response->withJson($matchedMovies);
	}
}
