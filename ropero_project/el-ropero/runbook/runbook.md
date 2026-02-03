# Runbook and Incident Playbook

## Disk alerts

- If disk usage > 85% request increase from hosting or clean logs and old backups.
- Archive old files to S3 and remove from host.

## Cron and background

- Ensure `php artisan schedule:run` runs every minute via cron. See `cron.md`.

## Failures on deploy

- Check `storage/logs/laravel.log` for errors.
- Run `php artisan migrate --force` and check DB connectivity.

## Rollback

- Keep DB backups (mysqldump to S3). If migration issues occur, restore DB from backup.
