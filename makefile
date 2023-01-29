up:
	docker-compose up -d --build --force-recreate --remove-orphans

down:
	docker-compose down --volumes --remove-orphans

composer-install:
	docker-compose exec php su --command="composer -n install --prefer-dist" www-data

cache-clean:
	git clean -fdX project/temp/

start-project: up composer-install


