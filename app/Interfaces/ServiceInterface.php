<?php
namespace App\Interfaces;

interface ServiceInterface
{
    public function index();
    public function purchaseService($request);
    public function getPurchaseService();
}