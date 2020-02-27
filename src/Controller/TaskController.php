<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Task;
use App\Form\TaskType;
/**
 * Task controller.
 * @Route("/api", name="api_")
 */
class TaskController extends FOSRestController
{
  /**
   * Lists all Tasks.
   * @Rest\Get("/tasks")
   *
   * @return Response
   */
  public function getTaskAction()
  {
    $repository = $this->getDoctrine()->getRepository(Task::class);
    $tasks = $repository->findall();
    if(!empty($tasks)) {
      return $this->handleView($this->view($tasks));
    }
    return $this->handleView($this->view(['status' => 'No records'], Response::HTTP_NOT_FOUND));
  }

  /**
   * Get one task.
   * @Rest\Get("/task/{id}")
   *
   * @return Response
   */
  public function getTaskByIdAction(Request $request)
  {
    $path = explode('/', $request->getPathInfo());
    if ( isset($path) && is_numeric(end($path)) )
    {
      $id = end($path);
      $repository = $this->getDoctrine()->getRepository(Task::class);
      $record = $repository->find($id);
      if($record) {
        return $this->handleView($this->view($record));
      }
      return $this->handleView($this->view(['status' => 'error: not found'], Response::HTTP_NOT_FOUND));
    }
    return $this->handleView($this->view(['status' => 'error: bad request'], Response::HTTP_NOT_FOUND));
  }

  /**
   * Delete one task.
   * @Rest\Delete("/task/{id}")
   *
   * @return Response
   */
  public function deleteTaskByIdAction(Request $request)
  {
    $path = explode('/', $request->getPathInfo());
    if ( isset($path) && is_numeric(end($path)) )
    {
      $id = end($path);
      $repository = $this->getDoctrine()->getRepository(Task::class);
      $record = $repository->find($id);

      if($record) {
        $em = $this->getDoctrine()->getManager();
        $em->remove($record);
        $em->flush();
        return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_OK));
      }
      return $this->handleView($this->view(['status' => 'error: not found'], Response::HTTP_NOT_FOUND));
    }
    return $this->handleView($this->view(['status' => 'error: bad request'], Response::HTTP_NOT_FOUND));
  }

  /**
   * Create Task.
   * @Rest\Post("/task")
   *
   * @return Response
   */
  public function postTaskAction(Request $request)
  {
    $task = new Task();
    $form = $this->createForm(TaskType::class, $task);
    $data = json_decode($request->getContent(), true);
    $form->submit($data);
    if ($form->isSubmitted() && $form->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($task);
      $em->flush();
      return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
    }
    return $this->handleView($this->view($form->getErrors()));
  }
}
