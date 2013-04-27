<?php
/**
 * Created by Asier Marqués.
 * User: Asier
 * Date: 27/04/13
 * Time: 16:44
 */
namespace Buzz\Tests;
use Silex\WebTestCase;

abstract class BaseTest extends WebTestCase{

    function createApplication(){
        $app = require __DIR__ . '/../../../src/app.php';
        require __DIR__ . '/../../../config/test.php';




        return $app;
    }

}
