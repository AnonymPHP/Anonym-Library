<?php
    /**
     * Bu Dosya AnonymFramework'e ait bir dosyadır.
     *
     * @author vahitserifsaglam <vahit.serif119@gmail.com>
     * @see http://gemframework.com
     *
     */

    namespace Anonym\Upload\Multiple;

    use Anonym\Upload\ImageUpload;
    use Anonym\Upload\ImageUploadTypes;

    /**
     * Class MultipileImageUpload
     * @package Anonym\Upload\Multiple
     */
    class MultipileImageUpload extends MultipileUpload
    {


        /**
         * Sınıfı başlatır ve üst sınıfı başlatır
         *
         * @param array $files
         * @param string $target
         */
        public function __construct(array $files = [], $target = ''){
            parent::__construct($files, $target);

        }

        /**
         * Dosyaları yükler
         *
         * @return array
         */
        public function upload()
        {
            $files = $this->getFiles();
            $response = [];
            $types = new ImageUploadTypes();
            foreach($files as $file){

                if(!$file instanceof ImageUpload)
                {
                    $file = new ImageUpload($file);
                    $file->setAllowedMimeTypes($types->getImageMimeTypes());
                    $file->setAllowedExt($types->getImageTypeExt(), ['.php']);
                }

                $response[] = $file->upload();
            }

            return $response;
        }
    }
