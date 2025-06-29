ARTISAN = php artisan

serve:
	$(ARTISAN) serve

migrate:
	$(ARTISAN) serve

octane-start:
	$(ARTISAN) octane:frankenphp --workers=1 --max-requests=20
