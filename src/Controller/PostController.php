<?php

namespace App\Controller;

use App\Entity\Comments;
use App\Entity\Posts;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\CommentType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class PostController extends AbstractController
{
    #[Route('/post/{id}', name: 'app_post')]
    public function index(EntityManagerInterface $entityManager, int $id): Response
    {
        $posts = $entityManager->getRepository(Posts::class)->findBy(['id' => $id], []);

        //On met le $post[0] à null, comme ça le twig peut handle l'erreur
        if (!$posts[0]) {
            $posts = [null];
        }

        $commentForm = $this->createForm(CommentType::class);

        return $this->render('post/index.html.twig', [
            'posts' => $posts[0],
            'user' => $this->getUser(),
            'commentForm' => $commentForm->createView()
        ]);
    }
    
    #[Route('/posts', name: 'app_posts')]
    public function indexArticle(EntityManagerInterface $entityManager): Response
    {
        $posts = $entityManager->getRepository(Posts::class)->findAll();

        return $this->render('post/indexAll.html.twig', [
            'posts' => $posts,
            'user' => $this->getUser()
        ]);
    }
    #[Route("/post/{id}/comment/add", name: "add_comment")]
    public function addComment(Request $request, EntityManagerInterface $entityManager, Posts $post): Response
    {
        $comments = new Comments();
        $comments->setUser($this->getUser());
        $comments->setPost($post);

        $commentForm = $this->createForm(CommentType::class, $comments);
        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {
            $entityManager->persist($comments);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_post', [
            'id' => $post->getId()
        ]);
    }
#[Route("/comment/{id}/like", name:"like_comment")]
public function likeComment(Comments $comment, EntityManagerInterface $entityManager)
{
    $comment->setLikes($comment->getLikes() + 1);
    $entityManager->flush();

    return $this->redirectToRoute('app_post', [
        'id' => $comment->getPost()->getId()
    ]);}

#[Route("/comment/{id}/dislike", name:"dislike_comment")]
public function dislikeComment(Comments $comment, EntityManagerInterface $entityManager)
{
    $comment->setDislikes($comment->getDislikes() + 1);
    $entityManager->flush();

    return $this->redirectToRoute('app_post', [
        'id' => $comment->getPost()->getId()
    ]);}

}