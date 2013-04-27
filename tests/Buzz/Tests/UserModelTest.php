<?php
/**
 * Created by Asier Marqués.
 * User: Asier
 * Date: 27/04/13
 * Time: 12:42
 */

namespace Buzz\Tests;
use Lib\Model\PostModel;

class UserModelTest extends BaseTest{


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

    public function testCreateAndFindPost(){

        $model = $this->createModel();

        try{

            $post = $model->create(array("text"=>"test"));
            $this->assertEquals("test", $post["text"]);

            if($post2 = $model->find($post["id"])){
                $this->assertEquals($post["id"], $post2["id"]);
            }else{
                $this->assertTrue(false, "find post");
            }

        }catch(\Exception $e){
            $this->assertTrue(false, $e->getMessage());

        }


    }


    public function testCreateAndFindAll(){

        $model = $this->createModel();

        try{

            $items = $model->findAll();
            $count = count($items);

            $items2 = $model->findAll();
            $this->assertGreaterThan($count, count($items2));


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

