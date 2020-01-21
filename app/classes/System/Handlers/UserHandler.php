<?php namespace System\Handlers;


use System\Children\Child;
use System\Databases\Database;

class UserHandler extends BaseHandler
{
    use ChildFillAndValidate;

    private $child;

    private $formData;

    private $db;

    public function __construct($templateName)
    {
        parent::__construct($templateName);
        $this->db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();
    }

    protected function dashboard()
    {
        if($this->session->keyExists('user')){

            $user = $this->session->get('user');
            $userFirstName  = $user->first_name;



        } else {
            header('Location: notfound');
            exit;
        }

        $this->renderTemplate([
            'pageTitle' => 'User Dashboard',
            'userFirstName' => $userFirstName,
            'errors' => $this->errors
        ]);
    }

    protected function add_child(){
        if($this->session->keyExists('user')){
            $this->child = new Child();
            $this->executePostChild();

            if(isset($this->formData) && empty($this->errors)){
                $this->child->parent_id = $this->session->get('user')->user_id;

                if(Child::add($this->child, $this->db)){
                    $success = "Uw kind is toegevoegd!";
                    $this->child = new Child();
                } else {
                    $this->logger->error(new \Exception("DB error: {$this->db->errorInfo()}"));
                    $this->errors[] = "Er is een systeem fout ontstaan!";
                }
            }



        } else {
            header('Location: notfound');
            exit;
        }

        $this->renderTemplate([
            'pageTitle' => 'Kind toeveogen',
            'child' => $this->child ?? false,
            'success' => $success ?? false,
            'errors' => $this->errors
        ]);

    }

}