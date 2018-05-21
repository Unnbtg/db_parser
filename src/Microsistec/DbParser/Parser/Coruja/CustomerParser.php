<?php
/**
 * Created by PhpStorm.
 * User: mueller
 * Date: 05/03/18
 * Time: 11:16
 */

namespace Microsistec\DbParser\Parser\Coruja;


use Microsistec\DbParser\AbstractParsedType;
use Microsistec\DbParser\Customer;
use Microsistec\DbParser\CustomerEmail;
use Microsistec\DbParser\Parser\ParserInterface;
use Microsistec\DbParser\Phone;

class CustomerParser extends AbstractParser implements ParserInterface
{
    public function parse($model, $domain = "", $account = "")
    {
        $uniq = hexdec(uniqid());
        $id   = substr($uniq, -8, 8);

        $customer               = new Customer();
        $customer->maintence_id = (int)$id;
        $customer->id           = (int)$id;
        $customer->code         = (int)$id;
        $customer->branch_id    = 0;
        $customer->name         = $model['PROPRIETARIO'] ? $model['PROPRIETARIO'] : 'não cadastrado';
        $phones                 = [
            $model['TELEFONE'],
            $model['CELULAR'],
            $model['TEL_COMERCIAL'],
        ];
        $customer->phones       = $this->parsePhones($phones);

        $emails           = [
            $model['EMAIL'],
            $model['EMAIL2'],
        ];
        $customer->emails = $this->parseEmails($emails);

        $customer->status        = 0;
        $customer->type          = 1;
        $customer->owner         = true;
        $customer->interested    = false;
        $customer->user_id       = 1;
        $customer->property_code = $model['CODIGO'];
        $customer->hash          = $this->generateMd5Data($model);

        return $customer;
    }

    protected function parsePhones($phones)
    {
        $result = [];

        foreach ($phones as $phone) {

            $cPhone          = new Phone();
            $cPhone->phone   = $this->unMask($phone);
            $cPhone->carrier = null;

            if ($cPhone->phone != '' && $cPhone->phone != 0) {
                $result[] = $cPhone;
            }

        }

        return $result;
    }

    protected function parseEmails($emails)
    {
        $result = [];

        foreach ($emails as $email) {
            if ($email != '0') {
                $result[] = $email;
            }
        }

        return $result;
    }

    private function generateMd5Data($model)
    {
        return md5(
            $model['PROPRIETARIO'] .
            $model['TELEFONE'] .
            $model['CELULAR'] .
            $model['TEL_COMERCIAL'] .
            $model['EMAIL'],
            $model['EMAIL2']
        );
    }

}