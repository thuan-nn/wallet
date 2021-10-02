help:
	@IFS=$$'\n' ; \
		help_lines=(`fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//'`); \
	for help_line in $${help_lines[@]}; do \
		IFS=$$'#' ; \
		help_split=($$help_line) ; \
		help_command=`echo $${help_split[0]} | sed -e 's/^ *//' -e 's/ *$$//'` ; \
		help_info=`echo $${help_split[2]} | sed -e 's/^ *//' -e 's/ *$$//'` ; \
		printf "%-30s %s\n" $$help_command $$help_info ; \
    done

build:
	sudo docker-compose down
	sudo docker build -t php-74 .

run:
	sudo docker-compose up webserver mysql app

run-d:
	sudo docker-compose up -d webserver mysql app

app-exec:
	docker exec -it app /bin/bash

down:
	docker-compose down

migrate:
	docker exec -it app /bin/sh -c "php artisan migrate"

seed:
	docker exec -it app /bin/sh -c "php artisan db:seed"

migrate-seed:
	docker exec -it app /bin/sh -c "php artisan migrate:refresh --seed"

generate:
	php artisan key:generate

optimize:
	docker exec app /bin/sh -c "php artisan optimize:clear"



## Show this help.
build: ## DOCKER BUILD IMAGE
run: ## START APPLICATION
run-d: ## START APPLICATION BACKGROUND
app-exec: ## EXEC TO APP
down: ## STOP APPLICATION
migrate: ## MIGRATION DATABASE
seed: ## SEED DATABASE
migrate-seed: ## MIGRATION & SEED DATABASE
generate: ## GENERATE KEY
optimize: ## CLEAR CACHE APPLICATION
