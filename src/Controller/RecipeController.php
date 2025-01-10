<?php

namespace App\Controller;

<<<<<<< HEAD
=======
<<<<<<< HEAD
use App\Repository\RecipeRepository;
=======
>>>>>>> ac1c2b8fb0883605d3eb0f1aa441a90cab3608c8
use App\Entity\Recipe;
use App\Repository\RecipeRepository;
use App\Form\RecipeType;
use Doctrine\ORM\EntityManagerInterface;
<<<<<<< HEAD
=======
>>>>>>> f89d9a1 (Ajout d'un formulaire d'édition de recette. Ainsi qu'une route spécifique.)
>>>>>>> ac1c2b8fb0883605d3eb0f1aa441a90cab3608c8
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecipeController extends AbstractController
{
    /**
     * @param RecipeRepository $repository
     * @return Response
     */
    #[Route('/recettes', name: 'recipe.index')]
<<<<<<< HEAD
    public function index(RecipeRepository $repository) {
=======
<<<<<<< HEAD
    public function index(RecipeRepository $repository): Response
    {
=======
    public function index(RecipeRepository $repository) {
>>>>>>> f89d9a1 (Ajout d'un formulaire d'édition de recette. Ainsi qu'une route spécifique.)
>>>>>>> ac1c2b8fb0883605d3eb0f1aa441a90cab3608c8
        $recipes = $repository->findWithDurationLowerThan(20);
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
<<<<<<< HEAD
    public function show(string $slug, int $id, RecipeRepository $repository) {
=======
<<<<<<< HEAD
    public function show(string $slug, int $id, RecipeRepository $repository): Response
    {
=======
    public function show(string $slug, int $id, RecipeRepository $repository) {
>>>>>>> f89d9a1 (Ajout d'un formulaire d'édition de recette. Ainsi qu'une route spécifique.)
>>>>>>> ac1c2b8fb0883605d3eb0f1aa441a90cab3608c8
        $recipe = $repository->find($id);

        if ($recipe->getSlug() !== $slug) {
            return $this->redirectToRoute('recipe.show', ['slug' => $recipe->getSlug(), 'id' => $recipe->getId()]);
        }

        return $this->render('recipe/show.html.twig', [
            'recipe' => $recipe,
<<<<<<< HEAD
=======
<<<<<<< HEAD
=======
>>>>>>> ac1c2b8fb0883605d3eb0f1aa441a90cab3608c8
        ]);
    }

    #[Route('/recettes/{id}/edit', name: 'recipe.edit', requirements: ['id' => '\d+'])]
    public function edit(Recipe $recipe, Request $request, EntityManagerInterface $em) {
        $form = $this->createForm(RecipeType::class, $recipe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash('success', 'La recette a bien été modifiée.');
            return $this->redirectToRoute('recipe.show', ['slug' => $recipe->getSlug(), 'id' => $recipe->getId()]);
        }

        return $this->render('recipe/edit.html.twig', [
            'recipe' => $recipe,
            'form' => $form,
<<<<<<< HEAD
=======
>>>>>>> f89d9a1 (Ajout d'un formulaire d'édition de recette. Ainsi qu'une route spécifique.)
>>>>>>> ac1c2b8fb0883605d3eb0f1aa441a90cab3608c8
        ]);
    }
}
