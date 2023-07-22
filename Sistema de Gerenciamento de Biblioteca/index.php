<?php

class Gerenciador_de_Biblioteca {
    private $titles;
    private $authors;
    private $editors;
    private $ISBNs;
    private $Qtds;

    public function __construct() {
        $this->titles = array();
        $this->authors = array();
        $this->editors = array();
        $this->ISBNs = array();
        $this->Qtds = array();
    }

    public function Cadastro($titulo, $autor, $editora, $isbn, $quantidade) {
        $this->titles[] = $titulo;
        $this->authors[] = $autor;
        $this->editors[] = $editora;
        $this->ISBNs[] = $isbn;
        $this->Qtds[] = $quantidade;
    }

    public function Search_Title($name) {
        $temp = strtolower($name);
        $found = false;

        foreach ($this->titles as $i => $title) {
            if (strtolower($title) === $temp) {
                echo "Exemplar encontrado no repositório" . PHP_EOL;
                $found = true;
                break;
            }
        }

        if (!$found) {
            echo "Exemplar não encontrado" . PHP_EOL;
        }
    }

    public function Search_Author($autor) {
        $temp = strtolower($autor);
        $found = false;

        foreach ($this->authors as $i => $author) {
            if (strtolower($author) === $temp) {
                echo "Livro: " . $this->titles[$i] . ", Autor: " . $author . ", Editora: " . $this->editors[$i] . ", ISBN: " . $this->ISBNs[$i] . ", Quantidade: " . $this->Qtds[$i] . PHP_EOL;
                $found = true;
            }
        }

        if (!$found) {
            echo "Nenhum livro encontrado para o autor: " . $autor . PHP_EOL;
        }
    }

    public function Search_ISBN($isbn) {
        $temp = strtolower($isbn);
        $found = false;

        foreach ($this->ISBNs as $i => $book_isbn) {
            if (strtolower($book_isbn) === $temp) {
                echo "Livro: " . $this->titles[$i] . ", Autor: " . $this->authors[$i] . ", Editora: " . $this->editors[$i] . ", ISBN: " . $book_isbn . ", Quantidade: " . $this->Qtds[$i] . PHP_EOL;
                $found = true;
                break;
            }
        }

        if (!$found) {
            echo "Nenhum livro encontrado para o ISBN: " . $isbn . PHP_EOL;
        }
    }

    public function AtualizarLivro($isbn, $novoTitulo, $novoAutor, $novaEditora, $novaQuantidade) {
        $temp = strtolower($isbn);
        $found = false;

        foreach ($this->ISBNs as $i => $book_isbn) {
            if (strtolower($book_isbn) === $temp) {
                $this->titles[$i] = $novoTitulo;
                $this->authors[$i] = $novoAutor;
                $this->editors[$i] = $novaEditora;
                $this->Qtds[$i] = $novaQuantidade;
                echo "Livro atualizado com sucesso." . PHP_EOL;
                $found = true;
                break;
            }
        }

        if (!$found) {
            echo "Nenhum livro encontrado para o ISBN: " . $isbn . PHP_EOL;
        }
    }

    public function ExcluirLivro($isbn) {
        $temp = strtolower($isbn);
        $found = false;

        foreach ($this->ISBNs as $i => $book_isbn) {
            if (strtolower($book_isbn) === $temp) {
                unset($this->titles[$i]);
                unset($this->authors[$i]);
                unset($this->editors[$i]);
                unset($this->ISBNs[$i]);
                unset($this->Qtds[$i]);
                $this->titles = array_values($this->titles);
                $this->authors = array_values($this->authors);
                $this->editors = array_values($this->editors);
                $this->ISBNs = array_values($this->ISBNs);
                $this->Qtds = array_values($this->Qtds);
                echo "Livro excluído com sucesso." . PHP_EOL;
                $found = true;
                break;
            }
        }

        if (!$found) {
            echo "Nenhum livro encontrado para o ISBN: " . $isbn . PHP_EOL;
        }
    }

    public function RegistroEmprestimo($isbn, $nomeUsuario, $dataDevolucao) {
        $temp = strtolower($isbn);
        $found = false;

        foreach ($this->ISBNs as $i => $book_isbn) {
            if (strtolower($book_isbn) === $temp) {
                if ($this->Qtds[$i] > 0) {
                    $this->Qtds[$i]--;
                    echo "Empréstimo registrado com sucesso." . PHP_EOL;
                } else {
                    echo "Não há exemplares disponíveis para empréstimo." . PHP_EOL;
                }
                $found = true;
                break;
            }
        }

        if (!$found) {
            echo "Nenhum livro encontrado para o ISBN: " . $isbn . PHP_EOL;
        }
    }

    public function RegistroDevolucao($isbn) {
        $temp = strtolower($isbn);
        $found = false;

        foreach ($this->ISBNs as $i => $book_isbn) {
            if (strtolower($book_isbn) === $temp) {
                $this->Qtds[$i]++;
                echo "Devolução registrada com sucesso." . PHP_EOL;
                $found = true;
                break;
            }
        }

        if (!$found) {
            echo "Nenhum livro encontrado para o ISBN: " . $isbn . PHP_EOL;
        }
    }
}

// Exemplo de utilização do sistema:
$biblioteca = new Gerenciador_de_Biblioteca();

// Cadastrar Livro
$biblioteca->Cadastro("Dom Casmurro", "Machado de Assis", "Editora XYZ", "978-85-99999-99-9", 5);
$biblioteca->Cadastro("O Pequeno Príncipe", "Antoine de Saint-Exupéry", "Editora ABC", "978-85-77777-77-7", 3);

// Pesquisar por título
$biblioteca->Search_Title("Dom Casmurro"); // Deve encontrar o livro

// Pesquisar por autor
$biblioteca->Search_Author("Machado de Assis"); // Deve encontrar o livro

// Pesquisar por ISBN
$biblioteca->Search_ISBN("978-85-99999-99-9"); // Deve encontrar o livro

// Atualizar Livro
$biblioteca->AtualizarLivro("978-85-77777-77-7", "O Pequeno Príncipe", "Antoine de Saint-Exupéry", "Editora XYZ", 5);

// Excluir Livro
$biblioteca->ExcluirLivro("978-85-99999-99-9");

// Registro de Empréstimo
$biblioteca->RegistroEmprestimo("978-85-77777-77-7", "João da Silva", "2023-07-30");

// Registro de Devolução
$biblioteca->RegistroDevolucao("978-85-77777-77-7");
?>