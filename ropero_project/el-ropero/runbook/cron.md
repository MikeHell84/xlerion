# Cron setup

Add the following cron entry in cPanel (or via WebHost cron UI) to run scheduled tasks every minute:

```bash
* * * * * cd /home/<usuario>/el-ropero && php artisan schedule:run >> /dev/null 2>&1
```

The important artisan commands implemented for the MVP:

- `php artisan auctions:close` — closes auctions and creates pending transactions.
- `php artisan queue:work` — run worker for queued thumbnail generation and mails (use on dedicated worker if possible).
