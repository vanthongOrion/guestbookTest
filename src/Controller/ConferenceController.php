<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Conference;
use App\form\CommentFormType;
use App\Repository\CommentRepository;
use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class ConferenceController extends AbstractController
{
    private $twig;

    public function __construct(Environment $twig)
    {
        $this->twig = $twig;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function index(ConferenceRepository $conferenceRepository): Response
    {
        // $greet = '';
        // if ($name) {
        //     $greet = sprintf('<h1>Hello %s!</h1>',htmlspecialchars(($name)));
        // }
        // return new Response(<<<EOF
        //     <html>
        //         <body>
        //             $greet
        //             <img src="/images/under-construction.gif" />
        //         </body>
        //     </html>
        // EOF);
        return new Response($this->twig->render('conference/index.html.twig', [
            'conferences' => $conferenceRepository->findAll(),
        ]));
    }

    /**
     * @Route("/conference/{slug}", name="conference")
     */
    public function show(Request $request, Conference $conference, CommentRepository $commentRepository, ConferenceRepository $conferenceRepository)
    {
        $comment = new Comment();
        $form = $this->createForm(CommentFormType::class, $comment);
        
        $offset = max(0, $request->query->getInt('offset', 0));
        $paginator = $commentRepository->getCommentPaginator($conference,$offset);
        
        return new Response($this->twig->render('conference/show.html.twig',[
            'conferences'  => $conferenceRepository->findAll(),
            'conference'   => $conference,
            'comments'     => $paginator,
            'previous'     => $offset - CommentRepository::PAGINATOR_PER_PAGE,
            'next'         => min(count($paginator), $offset + CommentRepository::PAGINATOR_PER_PAGE),
            'comment_form' => $form->createView(),
            ]));
    }
}
