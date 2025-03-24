<?php

namespace App\Form;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Core\Form\FormParam;
use Core\Form\FormType;
use Core\Http\Request;

class ArticleType extends FormType
{
    private ArticleRepository $repository;

    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
        $this->build();
    }

    private function build(): void
    {
        $this->add(new FormParam("title", "string"));
        $this->add(new FormParam("description", "string"));
        $this->add(new FormParam("prix", "float"));
        $this->add(new FormParam("stock", "int"));
    }

    public function CreateArticle(Article $article, Request $request): int
    {
        $article->setTitle($this->getValue("title"));
        $article->setDescription($this->getValue("description"));
        $article->setPrix($this->getValue("prix"));
        $article->setStock($this->getValue("stock"));

        return $this->repository->saveArticle($article); //-> return de l'id
    }
}