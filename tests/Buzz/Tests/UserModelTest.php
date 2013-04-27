<?php
/**
 * Created by Asier Marqués.
 * User: Asier
 * Date: 27/04/13
 * Time: 12:42
 */

namespace Buzz\Tests;
use Lib\Model\PostModel;
use Silex\WebTestCase;

class UserModelTest extends WebTestCase{




    public function createApplication(){
        $app = require __DIR__ . '/../../../src/app.php';
        $app['debug'] = true;
        return $app;
    }
//
    public function createModel(){
        $app = $this->createApplication();
        return new PostModel($app["db"]);
    }
//
    public function testCreateAndDeletePost(){

        $model = $this->createModel();

        try{

            $post = $model->create(array("text"=>"test"));
            $this->assertEquals("test", $post["text"]);

            if($model->delete($post["id"])){
                $this->assertTrue(true, "delete post");
            }else{
                $this->assertTrue(false, "delete post");
            }

        }catch(\Exception $e){
            $this->assertTrue(false, $e->getMessage());

        }


    }


    public function testCreateUpdateAndDeletePost(){

        $model = $this->createModel();

        try{

            $post = $model->create(array("text"=>"test"));
            $this->assertEquals("test", $post["text"]);

            $post = $model->update(array("text"=>"test2"), $post["id"]);
            $this->assertEquals("test2", $post["text"]);

            if($model->delete($post["id"])){
                $this->assertTrue(true, "delete post");
            }else{
                $this->assertTrue(false, "delete post");
            }

        }catch(\Exception $e){
            $this->assertTrue(false, $e->getMessage());

        }


    }


}

