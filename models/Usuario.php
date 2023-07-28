<?php 

namespace Model;

class Usuario extends ActiveRecord {
    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $password;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
    }


    //Mensajes de validacion

    public function validarNuevaCuenta() {
        if(!$this->nombre) {
            self::$alertas['error'][] = "Agrega tu nombre.";
        }

        if(!$this->apellido) {
            self::$alertas['error'][] = "Agrega tu apellido.";
        }

        if(!$this->email) {
            self::$alertas['error'][] = "Agrega tu e-mail.";
        }

        if(!$this->password) {
            self::$alertas['error'][] = "Agrega un password.";
        }
                if(strlen($this->password) < 6 ) {
                    self::$alertas['error'][] = "El password debe contener al menos 6 caracteres.";
                }

        if(!$this->telefono) {
            self::$alertas['error'][] = "Agrega tu teléfono.";
        }

        return self::$alertas;
    }



    public function validarLogin() {
        if(!$this->email) {
            self::$alertas['error'][] = "Agrega tu e-mail.";
        }

        if(!$this->password) {
            self::$alertas['error'][] = "Agrega un password.";
        }

        return self::$alertas;
    }


    public function validarEmail() {
        if(!$this->email) {
            self::$alertas['error'][] = "Agrega tu e-mail.";
        }

        return self::$alertas;
    }


  public function validarPassword() {
        if(!$this->password) {
            self::$alertas['error'][] = "Tenés que agregar una contraseña.";
        }
            if(strlen($this->password) < 6 ) {
                self::$alertas['error'][] = "El password debe contener al menos 6 caracteres.";
            }

        return self::$alertas;
    }


    public function existeUsuario() {
        $query = "SELECT * FROM " . self::$tabla . " WHERE email= '" . $this->email .  "' LIMIT 1 ";

        $resultado = self::$db->query($query);

        if($resultado->num_rows) {
            self::$alertas['error'][] = "La cuenta ya está registrada.";
        }

        return $resultado;
        
    } 


    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }

    public function crearToken() {
        $this->token = uniqid();
    }

    public function comprobarPasswordAndVerificado($password) {
        $resultado = password_verify($password, $this->password);
        
        if(!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = "La contraseña es incorrecta o la cuenta no se ha confirmado.";
        } else {
            return true; //si está confirmado y el pass es correcto
        }

    }
}