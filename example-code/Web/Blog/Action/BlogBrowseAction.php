<?php
namespace Web\Blog\Action;

use Aura\Web\Request;
use Domain\Blog\BlogService;
use Web\Blog\Responder\BlogBrowseResponder;

class BlogBrowseAction
{
    protected $request;
    protected $domain;
    protected $responder;

    public function __construct(
        Request $request,
        BlogService $domain,
        BlogBrowseResponder $responder
    ) {
        $this->request = $request;
        $this->domain = $domain;
        $this->responder = $responder;
    }

    public function __invoke()
    {
        $page = $this->request->query->get('page', 1);
        $this->responder->collection = $this->domain->fetchAllByPage($page);
        $this->responder->setAccept($this->request->accept);
        return $this->responder->__invoke();
    }
}