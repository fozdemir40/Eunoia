<?php namespace System\Handlers;


use System\Availabilities\AvailabilitiesCollection;
use System\Children\AllChildren;
use System\Children\Child;
use System\Databases\Database;
use System\Availabilities\Availability;
use System\Form\Data;
use System\Form\Validation\BookingValidator;

class UserHandler extends BaseHandler
{
    use ChildFillAndValidate;

    private $child;

    private $availability;

    private $formData;

    private $db;

    public function __construct($templateName)
    {
        parent::__construct($templateName);
        $this->db = (new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME))->getConnection();
    }

    /**
     * @throws \Exception
     */
    protected function dashboard()
    {
        if($this->session->keyExists('user')){

            $user = $this->session->get('user');
            $userFirstName  = $user->first_name;

            $allChildren = new AllChildren();
            $allChildren->add(Child::getByParenId($user->user_id, $this->db));



        } else {
            header('Location: notfound');
            exit;
        }

        $this->renderTemplate([
            'pageTitle' => 'User Dashboard',
            'children' => $allChildren->get(),
            'userFirstName' => $userFirstName,
            'errors' => $this->errors
        ]);
    }

    protected function history()
    {
        if($this->session->keyExists('user')){
            $allBookings = new AvailabilitiesCollection();
            $allBookings->add(Availability::getAllCompleted($this->db));


        } else {
            header('Location: notfound');
            exit;
        }

        $this->renderTemplate([
            'pageTitle' => 'Afpsraak geschiedenis',
            'bookings' => $allBookings->get(),
            'errors' => $this->errors,
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

    protected function edit_child()
    {
        if(!$this->session->keyExists('user')){
            header('Location: notfound');
            exit;
        }

        try{

            $this->child = Child::getById($_GET['id'], $this->db);
            $this->executePostChild();

            if (isset($this->formData) && empty($this->errors)){
                if ($this->child->update($this->db)){
                    header('Location: dashboard');
                    $_SESSION['msg'] = $this->child->child_name . " is succesvol gewijzigd";
                    exit;
                } else {
                    $this->logger->error(new \Exception("Db Error"));
                    $this->errors[] = "Whoops, someting went wrong";
                }
            }

            $pageTitle = $this->child->child_name . "- Bewerken";
        } catch (\Exception $e) {
            $this->logger->error($e);
            $this->errors[] = "Whoops: " . $e->getMessage();
            $pageTitle = 'Child does not exist';
        }

        $this->renderTemplate([
            'pageTitle' => $pageTitle,
            'child' => $this->child ?? false,
            'errors' => $this->errors
        ]);
    }

    protected function delete_child()
    {
        if(!$this->session->keyExists('user')){
            header('Location: notfound');
            exit;
        }

        try{
            $child = Child::getById($_GET['id'], $this->db);

            if($child){
                $child->delete($this->db);

                header('Location: dashboard');
                exit;

            }

        } catch (\Exception $e){
            $this->logger->error($e);
            header('Location: '. BASE_PATH);
            exit;
        }
    }

}