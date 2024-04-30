#!/bin/bash

cp .env-gcloud .env
cp app/Config-gcloud/App.php app/Config
cp app/Config-gcloud/Cache.php app/Config
cp app/Config-gcloud/Paths.php app/Config
cp app/Config-gcloud/Logger.php system/Log
gcloud app deploy