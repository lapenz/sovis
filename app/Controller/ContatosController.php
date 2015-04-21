<?php

App::uses('CakeEmail', 'Network/Email');
App::uses('ConfigsController', 'Controller');

class ContatosController extends AppController {

    public $name = 'Contatos';
    public $uses = array('Contato');
    public $components = array("Captcha");
    public $helpers = array("Captcha");

    function beforeFilter() {
        $this->Auth->allow('index', 'trabalheconosco', 'captcha');
    }
    public function captcha() {
//uncomment  the code below if the captcha doesn't render on localhost,For Unix/Linux Servers it works fine.
        $this->Captcha->configCaptcha(array(
            'pathType' => 2
        ));
        $this->Captcha->getCaptcha();
    }

    public function index() {
        $this->layout = 'ajax';

        if ($this->request->is('post')) {
            $this->Contato->set($this->request->data);
            if ($this->Contato->validates(array('fieldList' => array('nome', 'email', 'telefone', 'como_encontrou', 'cidade', 'arquivo', 'estado', 'assunto', 'mensagem')))) {

                $email = $this->_getMailInstance();
                $email_retorno = $this->_getMailInstance();

                $emailConfig = new ConfigsController();
                $mensagem = 'Nome: ' . $this->request->data['Contato']['nome'] . '<br/><br/>
                    Email: ' . $this->request->data['Contato']['email'] . '<br/><br/>
                    Estado: ' . $this->request->data['Contato']['estado'] . '<br/><br/>
                    Cidade: ' . $this->request->data['Contato']['cidade'] . '<br/><br/>
                    Telefone: ' . $this->request->data['Contato']['telefone'] . '<br/><br/>
                    Como nos encontrou: ' . $this->request->data['Contato']['como_encontrou'] . '<br/><br/>
                    Assunto: ' . $this->request->data['Contato']['assunto'] . '<br/><br/>
                    Mensagem: ' . nl2br($this->request->data['Contato']['mensagem']);
                $email->from(array('contato@sovis.com.br' => 'Sovis Sistemas - ' . $this->request->data['Contato']['assunto']))
                        ->emailFormat('html')
                        ->sender('tempmail@sovis.com.br')
                        ->to($emailConfig->getEmail())
                        ->subject('Formulário de contato');
                $mensagem_retorno = 'Olá ' . $this->request->data['Contato']['nome'] . '! <br/><br/>
                    Obrigado por visitar nossa página e entrar em contato conosco! <br/><br/>
                    Em breve entraremos em contato. <br/><br/><br/>
                    Sovis Sistemas';
                $email_retorno->from(array('contato@sovis.com.br' => 'Sovis Sistemas'))
                        ->emailFormat('html')
                        ->sender('tempmail@sovis.com.br')
                        ->to($this->request->data['Contato']['email'])
                        ->subject('Formulário de contato - Sovis Sistemas');
                try {
                    $email->send($mensagem);
                    $email_retorno->send($mensagem_retorno);
                    $this->Session->setFlash('Mensagem enviada com sucesso.', 'default', array('class' => 'alert alert-success'));
                    $this->redirect('index');
                    return true;
                } catch (Exception $e) {
                    trigger_error("Não pode enviar email para: {$email}.");
                    $this->Session->setFlash('Não foi possível enviar.', 'default', array('class' => 'alert alert-error'));
                    return false;
                }
            }
        }
    }

    public function trabalheconosco() {
        $this->layout = 'ajax';
        if ($this->request->is('post')) {

            $this->Contato->set($this->request->data);
            if ($this->Contato->validates(array('fieldList' => array('nome', 'email', 'telefone', 'como_encontrou', 'arquivo', 'area'))) && $this->Captcha->validateCaptcha()) {
                $email = $this->_getMailInstance();
                $email_retorno = $this->_getMailInstance();

                $emailConfig = new ConfigsController();
                $email->attachments(array($this->request->data['Contato']['arquivo']['name'] => $this->request->data['Contato']['arquivo']['tmp_name']));

                $mensagem = 'Nome: ' . $this->request->data['Contato']['nome'] . '<br/><br/>
                    Email: ' . $this->request->data['Contato']['email'] . '<br/><br/>
                    Celular: ' . $this->request->data['Contato']['celular'] . '<br/><br/>
                    Telefone: ' . $this->request->data['Contato']['telefone'] . '<br/><br/>
                    �?rea de interesse: ' . $this->request->data['Contato']['area'] . '<br/><br/>
                    Como nos encontrou: ' . $this->request->data['Contato']['como_encontrou'] . '<br/><br/>
                    Observação: ' . nl2br($this->request->data['Contato']['observacao']);

                $email->from(array('contato@sovis.com.br' => 'Trabalhe Conosco - ' . $this->request->data['Contato']['area']))
                        ->emailFormat('html')
                        ->to($emailConfig->getEmail())
                        ->sender('tempmail@sovis.com.br')
                        ->subject('Trabalhe Conosco');

                $mensagem_retorno = 'Olá ' . $this->request->data['Contato']['nome'] . '! <br/><br/>
                    Obrigado por visitar nossa página e entrar em contato conosco! <br/><br/>
                    Em breve entraremos em contato. <br/><br/><br/>
                    Sovis Sistemas';
                $email_retorno->from(array('contato@sovis.com.br' => 'Sovis Sistemas'))
                        ->emailFormat('html')
                        ->sender('tempmail@sovis.com.br')
                        ->to($this->request->data['Contato']['email'])
                        ->subject('Trabalhe Conosco - Sovis Sistemas');
                try {
                    $email->send($mensagem);
                    $email_retorno->send($mensagem_retorno);
                    $this->Session->setFlash('Mensagem enviada com sucesso.', 'default', array('class' => 'alert alert-success'));
                    $this->redirect('trabalheconosco');
                    return true;
                } catch (Exception $e) {
                    trigger_error("Não pode enviar email para: {$email}.");
                    $this->Session->setFlash('Não foi possível enviar.', 'default', array('class' => 'alert alert-error'));
                    return false;
                }
            }
        }
    }

    protected function _getMailInstance() {
        App::uses('CakeEmail', 'Network/Email');
        return new CakeEmail('gmail');
    }

}
