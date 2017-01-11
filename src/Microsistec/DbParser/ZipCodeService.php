<?php
/**
 * Created by PhpStorm.
 * User: unm
 * Date: 21/12/16
 * Time: 10:01
 */

namespace Microsistec\DbParser;


class ZipCodeService
{
    private $url = "http://cep.mimo4.com.br/v1/";

    private $token = "Y2VwOjEwMTA=";

    public function getAddress($zipcode)
    {
        try {
            $fileContent = file_get_contents($this->url. $zipcode.'?token='.$this->token);
        } catch (\Exception $e) {
            echo $e->getMessage();
            return false;
        }

        $content = json_decode($fileContent, true);
        $zipAddress = $content['endereco'];

        if (empty($zipAddress)) {
            return false;
        }

        foreach ($content['bairros'] as $bairro) {
            if ($bairro['id_bairro'] == $zipAddress['id_bairro']) {
                $zipAddress['bairro'] = $bairro;
            }
        }

        return $zipAddress;
    }
}