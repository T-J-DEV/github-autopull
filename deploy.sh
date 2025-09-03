#!/bin/sh

# Clone the repo if it doesn't exist
if [ ! -f /app/repo/index.html ]; then
  rm -rf /app/repo/*
  git clone https://github.com/T-J-DEV/github-autopull.git /app/repo
fi

# Start auto-pull loop
while true; do
  echo ">>> Fetching latest code..."
  cd /app/repo
  git fetch origin main
  git reset --hard origin/main
  echo ">>> Pull complete, sleeping 30s..."
  sleep 30
done
chmod +x deploy.sh
