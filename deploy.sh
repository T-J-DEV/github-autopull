#!/bin/sh

# Clone repo only if /app/repo/index.html does not exist
if [ ! -f /app/repo/index.html ]; then
  echo "Cloning repo..."
  git clone -b main https://github.com/T-J-DEV/github-autopull.git /app/repo
fi

# Auto-pull loop
while true; do
  echo ">>> Fetching latest code..."
  cd /app/repo
  git fetch origin main
  git reset --hard FETCH_HEAD
  echo ">>> Pull complete, sleeping 30s..."
  sleep 30
done
