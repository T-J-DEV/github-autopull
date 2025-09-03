#!/bin/sh

# Ensure the repo is cloned
if [ ! -f /app/repo/index.html ]; then
  rm -rf /app/repo/*
  git clone https://github.com/T-J-DEV/github-autopull.git /app/repo
fi

# Auto-pull loop
while true; do
  echo ">>> Fetching latest code..."
  cd /app/repo
  git fetch origin refs/heads/main
  git reset --hard FETCH_HEAD
  echo ">>> Pull complete, sleeping 30s..."
  sleep 30
done
