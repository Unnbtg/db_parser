<?php
    /**
     * Created by PhpStorm.
     * User: marco
     * Date: 08/07/16
     * Time: 12:09
     */

    namespace Microsistec\DbParser\Definition;


    class Photo
    {
        protected $accountName;

        protected $basePath;
        public function setAccount($accountName, $basepath = null)
        {
            $this->accountName = $accountName;

            if ( ! is_null($basepath)) {
                $this->basePath = $basepath;
            }
        }


        public function getBasePath()
        {
            return "/home/" . $this->accountName. '/public_html/fotos';
        }

        public function getPhotosPath($codigo, $codigoFilial)
        {
            return $this->getBasePath().'/'. $this->getPhotoDir($codigo, $codigoFilial);
        }

        public function getPhotos($codigoImovel, $codigoFilial)
        {
            $directoryIterator = new \DirectoryIterator($this->getPhotosPath($codigoImovel, $codigoFilial));

            $photos = [];

            foreach ($directoryIterator as $file) {

                if ( ! $file->isFile() ||
                    ! $this->belongsToProperty($codigoImovel, $codigoFilial, $file->getFilename())
                ) {
                    continue;
                }

                $photos[] = $file->getFilename();
            }

            return $photos;
        }



        public function belongsToProperty($codigoImovel, $codigoFilial, $file)
        {
            $baseFileName = $codigoImovel . '0' . $codigoFilial . '-';
            return strpos($file, $baseFileName) !== false;
        }

        protected function getPhotoDir($codigo, $codigoFilial)
        {
            $filial = '0' . $codigoFilial;

            $filialDir = 'F' . $filial;
            $imovelDir = substr($codigo, -2);

            $path = $filialDir . '/' . $imovelDir;

            return $path;
        }

        public function buildUrl($domain, $codigoImovel, $codigoFilial, $file) {
            return sprintf('http://%s/fotos/%s/%s', $domain, $this->getPhotoDir($codigoImovel, $codigoFilial), $file);
        }

        public function getPhotosUrl($codigoImovel, $codigoFilial, $domain)
        {
            $photos = $this->getPhotos($codigoImovel, $codigoFilial);
            $photosUrl = [];

            foreach ($photos as $photo){
                $photosUrl[] = $this->buildUrl($domain, $codigoImovel, $codigoFilial, $photo);
            }

            return $photosUrl;
        }

    }