<?php

    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 08/07/16
     * Time: 14:58
     */
    class PhotoTest extends PHPUnit_Framework_TestCase
    {

        /**
         * @var \Microsistec\DbParser\Definition\Photo
         */
        protected $photo;

        public function setUp()
        {
            $stocks = $this->getMockBuilder(\Microsistec\DbParser\Definition\Photo::class)
                            ->setMethods(['getPhotosPath'])
                            ->getMock();


            $stocks->method('getPhotosPath')
                    ->withAnyParameters()
                    ->willReturn( __DIR__.'/F00/01' );

            $this->photo = $stocks;
        }

        /** @test */
        public function it_must_detect_correctly_if_the_file_belongs_to_the_property()
        {
            $file = '20100-teste.jpg';
            $file1 = '20100i-teste.jpg';
            $file2 = '20101-teste.jpg';

            $this->assertTrue($this->photo->belongsToProperty(201,0, $file));
            $this->assertFalse($this->photo->belongsToProperty(201,0, $file1));
            $this->assertFalse($this->photo->belongsToProperty(201,0, $file2));

        }


        /** @test */
        public function it_must_return_the_right_path()
        {
            $photo = new \Microsistec\DbParser\Definition\Photo();
            $photo->setAccount('u0444');
            $this->assertEquals('/home/u0444/public_html/fotos/F01/00', $photo->getPhotosPath(200,01));
            $this->assertEquals(__DIR__.'/F00/01', $this->photo->getPhotosPath(200,01));
            $this->assertTrue(is_dir(__DIR__.'/F00/01'));
        }


        /** @test */
        public function it_must_fetch_a_single_photo()
        {
            $this->assertCount(3, $this->photo->getPhotos(201, 0));
        }

        /** @test */
        public function it_builds_the_correct_url()
        {
            $domain = 'macarena.com';


            $this->assertEquals('http://macarena.com/fotos/F00/01/20100-foto_teste.jpg',
                    $this->photo->buildUrl($domain, 201, 0, '20100-foto_teste.jpg')
                );


        }

    }