<?php
namespace App\Interfaces;

interface EmailInterface
{
    public function getInbox();
    public function getSendBox();
    public function sendEmail($emailRequest);
}