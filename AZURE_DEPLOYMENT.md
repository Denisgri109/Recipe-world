# Azure Deployment Guide (Recipe World)

This guide continues Stage 39-42 for Azure deployment using Azure CLI and Azure App Service.

## 1. Prerequisites

- Azure subscription
- Azure CLI installed
- PHP, Composer, Node, npm installed locally

## 2. Variables

Set these once in your shell and reuse throughout:

```powershell
$SUBSCRIPTION_ID = "<your-subscription-id>"
$LOCATION = "westeurope"
$RESOURCE_GROUP = "rg-recipeworld-prod"
$APP_SERVICE_PLAN = "asp-recipeworld-prod"
$WEBAPP_NAME = "recipeworld-<unique-suffix>"

$MYSQL_SERVER = "mysql-recipeworld-<unique-suffix>"
$MYSQL_ADMIN = "recipeadmin"
$MYSQL_PASSWORD = "<strong-password>"
$MYSQL_DB = "recipe_world_db"
```

## 3. Login and select subscription

```powershell
az login
az account set --subscription $SUBSCRIPTION_ID
```

## 4. Create resource group and MySQL Flexible Server

```powershell
az group create --name $RESOURCE_GROUP --location $LOCATION

az mysql flexible-server create `
  --resource-group $RESOURCE_GROUP `
  --name $MYSQL_SERVER `
  --location $LOCATION `
  --admin-user $MYSQL_ADMIN `
  --admin-password $MYSQL_PASSWORD `
  --sku-name Standard_B1ms `
  --tier Burstable `
  --version 8.0 `
  --public-access 0.0.0.0

az mysql flexible-server db create `
  --resource-group $RESOURCE_GROUP `
  --server-name $MYSQL_SERVER `
  --database-name $MYSQL_DB
```

## 5. Create App Service (PHP)

```powershell
az appservice plan create `
  --name $APP_SERVICE_PLAN `
  --resource-group $RESOURCE_GROUP `
  --location $LOCATION `
  --sku B1 `
  --is-linux

az webapp create `
  --name $WEBAPP_NAME `
  --resource-group $RESOURCE_GROUP `
  --plan $APP_SERVICE_PLAN `
  --runtime "PHP|8.2"
```

## 6. Build the app locally for production

Run these from the project root:

```powershell
composer install --no-dev --optimize-autoloader
npm.cmd install
npm.cmd run build
```

## 7. Deploy code using ZIP deploy

```powershell
if (Test-Path .\deploy.zip) { Remove-Item .\deploy.zip -Force }
Compress-Archive -Path * -DestinationPath .\deploy.zip -Force

az webapp deploy `
  --resource-group $RESOURCE_GROUP `
  --name $WEBAPP_NAME `
  --src-path .\deploy.zip `
  --type zip
```

## 8. Configure App Settings (production)

```powershell
$APP_KEY = php artisan key:generate --show

az webapp config appsettings set `
  --resource-group $RESOURCE_GROUP `
  --name $WEBAPP_NAME `
  --settings `
    APP_NAME="RecipeWorld" `
    APP_ENV="production" `
    APP_DEBUG="false" `
    APP_URL="https://$WEBAPP_NAME.azurewebsites.net" `
    APP_KEY="$APP_KEY" `
    LOG_CHANNEL="stack" `
    LOG_LEVEL="error" `
    DB_CONNECTION="mysql" `
    DB_HOST="$MYSQL_SERVER.mysql.database.azure.com" `
    DB_PORT="3306" `
    DB_DATABASE="$MYSQL_DB" `
    DB_USERNAME="$MYSQL_ADMIN" `
    DB_PASSWORD="$MYSQL_PASSWORD"
```

## 9. Run Laravel one-time setup on the app

Use App Service SSH console or Kudu console:

```bash
php artisan migrate --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## 10. Verify deployment

- Open: `https://<webapp-name>.azurewebsites.net`
- Test register/login
- Create, edit, search, filter, and delete a recipe
- Confirm recipe images load

## 11. Optional: Seed default categories

```bash
php artisan db:seed --class=CategorySeeder --force
```

## Notes

- If MySQL requires SSL in your region/policy, set `MYSQL_ATTR_SSL_CA` in app settings.
- Ensure your MySQL firewall/network rules allow App Service outbound access.
- If deployment fails, inspect logs with:

```powershell
az webapp log tail --resource-group $RESOURCE_GROUP --name $WEBAPP_NAME
```
