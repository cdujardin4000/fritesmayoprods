<?php

namespace App\Controller;

use App\Entity\Movie;
use App\Form\MovieType;
use App\Repository\ActorRepository;
use App\Repository\MovieRepository;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\DBAL\Connection;

#[Route('/movie')]
class MovieController extends AbstractController
{
    #[Route('/', name: 'app_movie_index', methods: ['GET'])]
    public function index(MovieRepository $movieRepository): Response
    {
        //dd($ActorRepository->findAll());
        return $this->render('movie/index.html.twig', [

            'movies' => $movieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_movie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, MovieRepository $movieRepository): Response
    {
        $movie = new Movie();
        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($request);
            ($form->getData());
            $movieRepository->save($movie, true);
            //$this->addFlash('TEXT',' added successfully.');
            return $this->redirectToRoute('app_movie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('movie/new.html.twig', [
            'movie' => $movie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_movie_show', methods: ['GET'])]
    public function show(Movie $movie): Response
    {
        //dump($movie);
        return $this->render('movie/show.html.twig', [
            'movie' => $movie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_movie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Movie $movie, MovieRepository $movieRepository): Response
    {

        $form = $this->createForm(MovieType::class, $movie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //dump($request);
            $movieRepository->save($movie, true);

            return $this->redirectToRoute('app_movie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('movie/edit.html.twig', [
            'movie' => $movie,
            'form' => $form,
            'by_reference' => true
        ]);
    }

    #[Route('/{id}', name: 'app_movie_delete', methods: ['POST'])]
    public function delete(Request $request, Movie $movie, MovieRepository $movieRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$movie->getId(), $request->request->get('_token'))) {
            $movieRepository->remove($movie, true);
        }

        return $this->redirectToRoute('app_movie_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @throws Exception

    public function recentMovies(Connection $connection, int $max = 3): Response
    {

        $sql = "SELECT * FROM movie SORT BY release_date DESC LIMIT :max";
        $stmt = $connection->prepare($sql);
        $stmt->bindValue("max", $max);
        $movies = $stmt->executeQuery();


        return $this->render('_last_movies.html.twig', [
            'movies' => $movies
        ]);
    }
<div id="sidebar">
{% for movie in movies %}
<a href="{{ path('app_movie_show', {'id': movie.id}) }}">{{ movie.title }}</a>
        {% endfor %}
        {# if you don't want to expose the controller with a public URL,
            use the controller() function to define the controller to execute#}
        {{ render(controller(
            'App\\Controller\\MovieController::recentMovies'
        )) }}
    </div>     */
}
