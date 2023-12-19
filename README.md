# Slim by mafio :-) 

**For the application to work, it is necessary to run dockerfile or docker-compose**   
**To run on the system, docker and docker-compose must be installed**

---

# Note: All commands are executed in the directory where docker-compose.yml is located

<div style="color: #e35151">   
### WARNING :  
All scripts downloaded from the network must be treated as untrusted!    
All discovered passwords are examples, all addresses also apply to the local network, after deploying locally, they should be changed.    
</div>  

### Linux

1.[install docker ubuntu](https://docs.docker.com/engine/install/ubuntu/)  
2.[install docker-compose ubuntu](https://docs.docker.com/compose/install)
npm install -g ng-cli

### WIN
1.[install docker win 10](https://docs.docker.com/docker-for-windows/install/)

**NOTE `<EXAMPLE>` To be replaced with the appropriate values**  
**`exit 0` or `exit status 0` In linux it means `[OK]` any other number is an error**
___
___

### Problems that may be encountered


#### ERROR WINDOWS

If you work with windows, make sure that the endings of the files are linux (LF - good) and not windows (CRLF - bad).  
Bad termination is shown with bash errors
GIT windows (for problems with scripts and line endings)    
`git config --global core.eol lf`  

## Copy add files

* From `.env.example` to `.env`

Note: In the `.env.example` file do not make changes. Any other `.env` files are freely configurable.

# Mini course docker 
The microservice ports are set in the docker-compose ( `"docker-compose.yml` ) file, they can be
sampled according to a pattern `host:container`
<pre>
services:
  php:
    container_name: slim_php
    ...
    ports:
      -"8080:80"
</pre>
Via port `8080` you have access to the website on your computer. For example `localhost:8080`. 
Name `php` service is also a name server  

## Run Docker Compose
```shell
docker compose up -d
```
## How to use bash inside a container?  
- list container `docker ps`  (take the container id)  
- insert the id of the container (mdm-backend) you want to use `docker exec -it <CONTAINER_ID | container name> bash`  
#### For example  
```shell  
docker exec -it slim_php bash
```
  
## Command in container
```shell
composer install
```
#### DOCKER
___  
`docker builder prune` - Remove build cache  
`docker system prune` - Remove all unused containers which are stopped, networks, images (both dangling and unreferenced), and optionally,
volumes.   
_Use with caution. Especially databases, all data is deleted._  
`docker network create mf-net` add external network, run in bash in host   

___
SLIM official [website](https://www.slimframework.com/)  
GIT config [documentation](https://git-scm.com/book/en/v2/Customizing-Git-Git-Configuration)  
Docker cli [documentation](https://docs.docker.com/engine/reference/commandline)  
Dev.to article [website](https://dev.to/cherif_b/introducing-slim-4-55j9)  
___