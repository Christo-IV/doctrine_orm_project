<?php

namespace App\Controller;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class TagController extends Controller
{
	// View with QueryBuilder
    public function tags(Request $request, Response $response, $args = [])
    {
    	$qb = $this->ci->get('db')->createQueryBuilder();

    	$qb->select('a')
    		->from('App\Entity\Tag', 'a');

    	$query = $qb->getQuery();

    	$tags = $query->getResult();

    	return $this->renderPage($response, 'tags.html', ['tags' => $tags]);
    }
}
