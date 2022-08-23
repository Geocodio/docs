.PHONY: default run build clean

default: build

build:
	docker build -t geocodio/docs .

run:
	docker run --rm --volume "`pwd`:/srv/slate" -p 4567:4567 geocodio/docs serve

shell:
	docker run --rm --volume "`pwd`:/srv/slate" -it --entrypoint sh geocodio/docs

clean:
	docker rmi geocodio/docs