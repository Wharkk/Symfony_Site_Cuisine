<?php

namespace App\Controller;

use App\Entity\Recipe;
use App\Form\RecipeType;
use App\Repository\RecipeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{
    /**
     * @param RecipeRepository $repository
     * @return Response
     */
    #[Route('/recettes', name: 'recipe.index')]
    public function index(RecipeRepository $repository): Response
    {
        $recipes = $repository->findWithDurationLowerThan(35);
        $totalTime = $repository->findTotalDuration();

        return $this->render('recipe/index.html.twig', [
            'recipes' => $recipes,
            'totalTime' => $totalTime,
        ]);
    }

    /**
     * @param string $slug
     * @param int $id
     * @param RecipeRepository $repository
     * @return Response
     */
    #[Route('/recettes/{slug}-{id}', name: 'recipe.show', requirements: ['id' => '\d+', 'slug' => '[a-z0-9-]+'])]
    public function show(string $slug, int $id, RecipeRepository $repository): Response
    {
        $recipe = $repository->find($id);
        if ($recipe->getSlug() !== $slug) {
            return $this->redirectToRoute('recipe.show', ['slug' => $recipe->getSlug(), 'id' => $recipe->getId()]);
        }

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
        ]);
    }

    #[Route('/recettes/{id}/edit', name: 'recipe.edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(Recipe $recipe, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipe->setUpdatedAt(new \DateTimeImmutable());

            $em->flush();
            $this->addFlash('success', 'La recette a bien été modifiée.');
            return $this->redirectToRoute('recipe.show', ['slug' => $recipe->getSlug(), 'id' => $recipe->getId()]);
        }

        return $this->render('recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form,
        ]);
    }

    #[Route('/recettes/create', name: 'recipe.create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $recipe = new Recipe();
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recipe->setCreatedAt(new \DateTimeImmutable());
            $recipe->setUpdatedAt(new \DateTimeImmutable());

            $em->persist($recipe);
            $em->flush();
            $this->addFlash('success', 'La recette a bien été créée.');
            return $this->redirectToRoute('recipe.show', ['slug' => $recipe->getSlug(), 'id' => $recipe->getId()]);
        }

        return $this->render('recipe/create.html.twig', [
            'form' => $form,
        ]);
    }

    #[Route('/recettes/{id}/edit', name: 'recipe.delete', requirements: ['id' => '\d+'], methods: ['DELETE'])]
    public function delete(Recipe $recipe, EntityManagerInterface $em): Response
    {
        $em->remove($recipe);
        $em->flush();
        $this->addFlash('success', 'La recette a bien été supprimée.');

        return $this->redirectToRoute('recipe.index');
    }
}
