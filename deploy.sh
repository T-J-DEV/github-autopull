#!/bin/sh

# Clone the repo if the folder is empty
if [ ! -f /app/repo/index.html ]; then
  echo "Cloning repo..."
  git clone -b main https://github.com/T-J-DEV/github-autopull.git /app/repo
fi

# Keep container alive and pull updates every 30s
while true; do
  echo ">>> Fetching latest code..."
  cd /app/repo
  git fetch origin main
  git reset --hard FETCH_HEAD
  echo ">>> Pull complete, sleeping 30s..."
  sleep 30
done
