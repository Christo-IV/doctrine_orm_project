<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use Slim\Exception\HttpNotFoundException;

class AuthorController extends Controller
{
	public function author(Request $request, Response $response, $args = [])
    {
    	// Primary key
    	$author = $this->ci->get('db')->find('App\Entity\Author', $args['id']);

    	// Doctrine Query Builder
    	$dql = "SELECT a FROM App\Entity\Article a
    			WHERE a.author = :author 
    			ORDER BY a.published DESC";

    	$query = $this->ci->get('db')->createQuery($dql);
    	$query->setParameter('author', $author);
    	$articles = $query->getResult();

    	if(!$author) {
    		throw new HttpNotFoundException($request);
    	}

    	return $this->renderPage($response, 'author.html', [
    		'author' => $author,
    		'articles' => $articles
    	]);
    }
}