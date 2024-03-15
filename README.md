# Inkloodle

Vzdělávací platforma pro zvyšování digitálních kompetencí sociálních pracovníků a pracovnic

## Vývojové prostředí

Pro lokální vývoj použijte Docker Compose. Aplikace se spustí na http://localhost:8000.

Moodle spustíte pomocí následujícího příkazu
```bash
docker compose -f docker-compose.dev.yaml up -d
```

Stav běžících kontejnerů zobrazíte pomocí následujícího příkazu.

```bash
docker compose -f docker-compose.dev.yaml ps
```

Logy kontejnerů zobrazíte pomocí následujícího příkazu.

```bash
docker compose -f docker-compose.dev.yaml logs
```

### Adminer a přístup do databáze
Adminer je dostupný na portu 8001 (http://localhost:8001). Přístupové údaje do vývojové databáze najdete v souboru `docker-compose.dev.yaml`