<?php

namespace App\Tests\Controller;
use App\Controller\TaskController;
//use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Task;
use App\Form\TaskType;


class TaskControllerTest extends KernelTestCase {

  /**
   * @var \Doctrine\ORM\EntityManager
   */
  private $entityManager;


  public function testGetTaskAction() {
    $this->assertEquals(null, null);
  }

  public function testGetTaskByIdAction()
  {
    $this->assertEquals(null, null);
  }

  public function testDeleteTaskByIdAction()
  {
    return $this->assertEquals(null, null);
  }

  public function testPostTaskAction()
  {
    return $this->assertEquals(null, null);
  }
}
