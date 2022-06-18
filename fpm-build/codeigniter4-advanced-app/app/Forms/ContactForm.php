<?php

namespace App\Forms;

use Config\Services;
use Config\Email as EmailConfig;
use Exception;

class ContactForm extends \CodeIgniter\Model
{

    protected $returnType = 'array';  

    protected $allowedFields = [
        'name', 
        'email', 
        'subject', 
        'body'
    ];
    
    protected $validationRules = [
        'name' => [
            'rules' => 'required|max_length[255]',
            'label' => 'Name'
        ],
        'email' => [
            'rules' => 'required|valid_email|max_length[255]',
            'label' => 'Email'
        ],
        'subject' => [
            'rules' => 'required|max_length[255]',
            'label' => 'Subject' 
        ],
        'body' => [
            'rules' => 'required|max_length[255]',
            'label' => 'Body'
        ]
    ];

    public function load(array $data)
    {
        foreach($this->allowedFields as $field)
        {
            if (!array_key_exists($field, $data))
            {
                $data[$field] = '';
            }
        }

        return $data;
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($data, &$error)
    {
        $email = compose_email('mail/contact', $data);

        $config = config(EmailConfig::class);

        $email->setTo($config->fromEmail, $config->fromName);

        $email->setReplyTo($data['email'], $data['name']);

        return send_email($email, $error);
    }

}