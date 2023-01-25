# Prueba tecnica, para Carryt.co

## Instrucciones de instalacion y despliegue
Incluí cuatro archivos que ponen en marcha del servicio laravel con base de datos sqlite3 , a fin de facilitar el despliegue del servicio,
* 000-default.conf
* docker-compose.yml
* Dockerfile
* entrypoint.sh
### Requisitos tecnico e instalacion 
Se requiere tener instalado docker y docker-compose, yo recomiendo hacerlo en una maquina con linux instalado, puede ser ubuntu 
* clonar repositorio **git clone https://github.com/whohe/technical-test-carryt.co.git**
* ejecute **docker-compose up -d** e ingrese a la url http://localhost:99/api/characters?page=1 
### Pruebas 
Para facilitar las pruebas del servicio adjunto en el repositorio hay un archivo bajo el nombre Insomnia-All_2023-01-24.json que pude ser importado en el gestor de pruebas Insomnia 
