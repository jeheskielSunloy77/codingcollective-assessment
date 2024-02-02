run:
	 ./vendor/bin/sail up -d && ./vendor/bin/sail npm run dev

stop:
	./vendor/bin/sail down

restart: stop run