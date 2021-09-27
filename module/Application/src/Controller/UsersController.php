<?php

namespace Application\Controller;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\View\Model\ViewModel;
use Application\Model\UsersTable;
use Application\Model\Rowset\User;
use Application\Form\UserForm;

class UsersController extends AbstractActionController
{
    private $usersTable = null;
    
    public function __construct(UsersTable $usersTable)
    {
        $this->usersTable = $usersTable;
    }
    
    public function indexAction()
    {
        $view = new ViewModel();
        $rows = $this->usersTable->getAll();
        $view->setVariable('userRows', $rows);
        return $view;
    }
    
    public function addAction()
    {
        $request = $this->getRequest();
        $userForm = new UserForm();
        $userForm->get('submit')->setValue('Add');
        if (!$request->isPost()) {
            return ['userForm' => $userForm];
        }
        
        $userModel = new User();
        $userForm->setInputFilter($userModel->getInputFilter());
        $userForm->setData($request->getPost());
        if (!$userForm->isValid()) {
            return ['userForm' => $userForm];
        }
        
        $userModel->exchangeArray($userForm->getData());
        $this->usersTable->save($userModel);
        return $this->redirect()->toRoute('users');
    }
    
    public function editAction()
    {
        $view = new ViewModel();
        
        // Get the ID from the URL
        $userId = (int) $this->params()->fromRoute('id');
        $view->setVariable('userId', $userId);
        
        // Check if user ID is not set then move the user back to add action
        if (0 == $userId) {
            return $this->redirect()->toRoute('users', ['action' => 'add']);
        }
        
        // Find the user by ID which might throw an Exception for not found user
        try {
            $userRow = $this->usersTable->getById($userId);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('users', ['action' => 'index']);
        }
        
        // Create new form
        $userForm = new UserForm();
        
        // Assign attributes to form from user object
        $userForm->bind($userRow);
        $userForm->get('submit')->setAttribute('value', 'Save');
        $request = $this->getRequest();
        $view->setVariable('userForm', $userForm);
        
        // Stop the script and render phtml file if we are not submitting a form
        if (!$request->isPost()) {
            return $view;
        }
        
        // Set form validations
        $userForm->setInputFilter($userRow->getInputFilter());
        
        // Set new form data
        $userForm->setData($request->getPost());
        
        // Make sure the data is correct
        if (!$userForm->isValid()) {
            return $view;
        }
        
        // Save the new changes
        $this->usersTable->save($userRow);
        
        // Redirect back to index action of users controller
        return $this->redirect()->toRoute('users', ['action' => 'index']);
    }
    
    public function deleteAction()
    {
        $userId = (int) $this->params()->fromRoute('id');
        
        if (empty($userId)) {
            return $this->redirect()->toRoute('users');
        }
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Cancel');
            if ($del == 'Delete') {
                $userId = (int) $request->getPost('id');
                $this->usersTable->delete($userId);
            }
            
            // Redirect to the users list
            return $this->redirect()->toRoute('users');
        }
        
        return [
            'id' => $userId,
            'user' => $this->usersTable->getById($userId),
        ];
    }
    
    public function profileAction()
    {
        $view = new ViewModel();
        $userName = $this->params()->fromRoute('username');
        $customVar = $this->params()->fromRoute('custom_var');
        $view->setVariable('userName', $userName);
        $view->setVariable('customVar', $customVar);
        return $view;
    }
}