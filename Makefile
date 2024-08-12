npm:
	sudo docker-compose run npm ${o}

php-artisan:
	sudo docker-compose run artisan ${o}

composer:
	sudo docker-compose run composer ${o}

logs:
	sudo docker-compose logs ${o}

start:
	sudo docker-compose up -d

stop:
	sudo docker-compose down

build:
	sudo docker-compose build

full-build:
	sudo bash build.bash

help:
	@echo all commands:

	@echo ""
	
	@echo make php-artisan o="<options>"
	@echo "about: the same php artisan"
	
	@echo ""
	
	@echo make npm o="<options>"
	@echo "about: the same npm"
	
	@echo ""
	
	@echo make logs o="<options>"
	@echo "about: this command check logs"
	
	@echo ""
	
	@echo make composer o="<options>"
	@echo "about: the same composer"

	@echo ""

	@echo "make stop"
	@echo "about: this is command stoping project"

	@echo ""

	@echo "make start"
	@echo "about: this is command start project"

	@echo ""

	@echo "make build"
	@echo "about: this is command rebuild project"

	@echo ""

	@echo "make full-build"
	@echo "about: this is command rebuild full project. the same build bash"

                                       
