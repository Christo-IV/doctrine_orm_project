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

    public function tag(Request $request, Response $response, $args = [])
    {
        // Primary key
        $tag = $this->ci->get('db')->find('App\Entity\Tag', $args['id']);

        // Doctrine Query Builder
        $dql = "SELECT a FROM App\Entity\Article a
                WHERE a.author = :author 
                ORDER BY a.published DESC";

        $query = $this->ci->get('db')->createQuery($dql);
        $query->setParameter('author', $author);
        $articles = $query->getResult();

        if(!$tag) {
            throw new HttpNotFoundException($request);
        }

        return $this->renderPage($response, 'tag.html', [
            'tag' => $tag,
            'articles' => $tag->getArticles()
        ]);
    }
}
