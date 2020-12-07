Característica: Login del sistema
    Como usuario
    Quiero iniciar sesión en el sistema de Conalep
    Para realizar mis acitividades como super usuario.

    Escenario: Credenciales válidas
        Dado que ingreso el usuario "test@zac.conalep.edu.mx" 
        Y la contraseña "testtesttest"
        Cuando presiono el botón Entrar
        Entonces puedo ver en la página principal el nombre de mi usuario "Test".

    Escenario: Credenciales no válidas
        Dado que ingreso el usuario "test@edu.mx" 
        Y la contraseña "123"
        Cuando presiono el botón Entrar
        Entonces puedo ver el mensaje de error "Usuario o contraseña incorrecto".