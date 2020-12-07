Característica: Modificación de un proceso
    Como administrador del sistema de Conalep
    Quiero modificar un proceso
    Para actualizar su informacion.

    Escenario: Datos correctos
        Dado entro a la sección de procesos
        Y selecciono el boton de modificar el proceso Proceso 1
        Y modifico el codigo del proceso como "Proceso1"
        Cuando presiono el botón Guardar
        Entonces puedo ver el codigo del proceso siendo "Proceso1".