# Jirafeau in Docker

Jirafeau is a small PHP application so running it inside a docker is pretty straightforward.

## Get Jirafeau's docker image

### Pull docker image from Docker Hub

`docker pull mojo42/jirafeau`

### Build your own docker image

```
git clone https://gitlab.com/mojo42/Jirafeau.git
cd Jirafeau
docker build -t mojo42/jirafeau:latest .
```

## Run Jirafeau image

Once you have your Jirafeau's image, you can run a quick & dirty Jirafeau using:
```
docker run -d -p 8000:80 mojo42/jirafeau
```
and then connect on [locahost:8000](http://localhost:8000) and proceed to installation.

An other way to run Jirafeau (in a more controlled way) is to mount your Jirafeau's reprository in /www folder so your data are outside the container. This way, you will be able to easily make backups, upgrade Jirafeau, change configuration and develop Jirafeau.
```
docker run -d -p 8000:80 -v$(pwd):/www mojo42/jirafeau
```

There are also other ways to manage your container (like docker's volumes) but this is out of the scope of this documentation.

## Few notes

- SSL is currently not enabled in docker's image for the moment
- `var-...` folder where lives all uploaded data is protected from direct access
- Image has been made using [Alpine Linux](https://alpinelinux.org/) with [lighttpd](https://www.lighttpd.net/) which makes the container very light and start very quickly
