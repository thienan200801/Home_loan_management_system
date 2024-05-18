# Face ID Lab Server Project - Andie Tran 

## Build
```
$ docker pull fl4ming0/faceidlabserver

$ docker run -it  --name faceidlabcontainer -p 1337:80 fl4ming0/faceidlabserver
```
###  -> Go to docker
 ```
# service apache2 start
```
### -> Go to website:
http://localhost:1337

## Train
Open another Command Line Tab (Terminal Tab). In the folder of Data Train, copy data (example: TaylorSwift) to docker using:
```
$ docker cp TaylorSwift faceidlabcontainer:/opt/face_recognizer/training/
```

Go inside docker using docker exec:
```
$ docker exec -it faceidlabcontainer bash
```
Execute Command
```
# cd /opt/face_recognizer/
# python3.9 detector.py --train 
```

