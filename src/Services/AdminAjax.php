<?php

namespace App\Services;

use App\Entity\Devices;
use Doctrine\ORM\EntityManagerInterface;

class AdminAjax
{
    private $data = array(), $status = 200;
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
    public function setData($request, $data)
    {
        if (method_exists($this, $request . 'UserFunction')) {
            $this->data = call_user_func(array($this, $request . 'UserFunction'), $data);
        } else {
            $this->data = array(
                'success' => false,
                'error' => 'Cannot execute your request'
            );
            $this->status = 406;
        }
    }
    public function getData()
    {
        return $this->data;
    }
    public function getStatus()
    {
        return $this->status;
    }
    
    private function getDeviceTypeUserFunction($data)
    {
        if (!is_int($data['id']) || $data['id'] <= 0) {
            $this->status = 400;
            return array(
                'success' => false,
                'error' => 'Wrong ID'
            );
        }

        $device = $this->em->getRepository(Devices::class)->find($data['id']);
        $fields = $device->getType()->getAddFields();
        if ($fields === null) $fields = [];

        return array(
            'success' => true,
            'data' => array('fields' => $fields)
        );
    }
}