<?php

class Employee {
    private $database;

    public function __construct(){
        $this->database = array();
    }

    public function register($name, $office, $salary, $admission) {
        $employee = array(
            'Name' => $name,
            'Office' => $office,
            'Salary' => $salary,
            'Admission' => $admission
        );
        array_push($this->database, $employee);
    }

    public function getAllEmployee(){
        return $this->database;
    }

    public function getEmployeeByName($name){
        foreach($this->database as $employee){
            if($employee['Name'] == $name){
                return $employee;
            }
        }
        echo "Funcionário não encontrado<br>";
        return null;
    }

    public function getSalaryYear($name){
        $employee = $this->getEmployeeByName($name);
        if($employee){
            $SY = $employee['Salary'] * 12;
            echo "Salário anual do funcionário " . $employee['Name'] . " é: $" . $SY . "<br>";
        }
    }
}

class Department {
    private $department;
    private $funcionarios;

    public function __construct($department) {
        $this->department = $department;
        $this->funcionarios = array();
    }

    public function getDepartment(){
        return $this->department;
    }

    public function addEmployeeToDepartment($name, $department){
        $employee = $this->getEmployeeByName($name);
        if($employee){
            $employee['Department'] = $department;
            echo "Departamento atribuído com sucesso<br>";
        } else {
            echo "Funcionário não encontrado<br>";
        }
    }

    public function removeEmployeeFromDepartment($name){
        $employee = $this->getEmployeeByName($name);
        if($employee && isset($employee['Department'])){
            unset($employee['Department']);
            echo "Funcionário removido do departamento<br>";
        } else {
            echo "Funcionário não encontrado ou não pertence a nenhum departamento<br>";
        }
    }

    public function getEmployeeByName($name){
        foreach($this->funcionarios as &$employee){
            if($employee['Name'] == $name){
                return $employee;
            }
        }
        return null;
    }
}

class Company {
    private $company;
    private $repoCompany;

    public function __construct($company) {
        $this->company = $company;
        $this->repoCompany = array();
    }

    public function getNameCompany(){
        return $this->company;
    }

    public function getAllDepartments() {
        echo "Departamentos da empresa " . $this->getNameCompany() . ": ";
        foreach ($this->repoCompany as $department) {
            echo $department->getDepartment() . "<br>";
        }
    }

    public function addDepartment(Department $department){
        array_push($this->repoCompany, $department);
    }
}


// Criando um objeto da classe Employee
$employee1 = new Employee();
$employee2 = new Employee();

// Registrando funcionários
$employee1->register("João", "Gerente", 5000, "2023-07-21");
$employee2->register("Maria", "Assistente", 3000, "2023-07-22");

// Obtendo informações de um funcionário pelo nome
$funcionarioMaria = $employee2->getEmployeeByName("Maria");
if($funcionarioMaria){
    echo "Informações de Maria: " . var_dump($funcionarioMaria) . "<br>";
}

// Obtendo o salário anual de um funcionário pelo nome
$employee1->getSalaryYear("João");

// Criando objetos da classe Department
$departmentRH = new Department("Recursos Humanos");
$departmentTI = new Department("Tecnologia da Informação");

// Adicionando funcionários a um departamento
$departmentRH->addEmployeeToDepartment("João", $departmentRH->getDepartment());
$departmentRH->addEmployeeToDepartment("Maria", $departmentRH->getDepartment());

$departmentTI->addEmployeeToDepartment("Maria", $departmentTI->getDepartment());

// Removendo um funcionário de um departamento
$departmentRH->removeEmployeeFromDepartment("João");

// Criando um objeto da classe Company
$companyXYZ = new Company("XYZ Company");

// Obtendo o nome da empresa
$nomeEmpresa = $companyXYZ->getNameCompany();
echo "Nome da empresa: " . $nomeEmpresa . "<br>";

// Adicionando departamentos à empresa
$companyXYZ->addDepartment($departmentRH);
$companyXYZ->addDepartment($departmentTI);

// Obtendo todos os departamentos associados à empresa
$companyXYZ->getAllDepartments();
?>