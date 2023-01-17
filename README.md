# Crawler
## Container

No projeto há o `DockerFile` para criação do container e o `docker-compose.yml` para utilizá-lo.
Basta executar esses comandos:
```bash
docker build -t crawly .
docker-compose up
```

## Acesso
No arquivo `docker-compose.yml` está definido a porta 8019, então para acessar o projeto é pelo link http://localhost:8019