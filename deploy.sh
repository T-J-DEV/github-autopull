#!/bin/sh

if [ ! -f /app/repo/index.html ]; then
  git clone -b main https://github.com/T-J-DEV/github-autopull.git /app/repo
fi

while true; do
  cd /app/repo
  git fetch origin main
  git reset --hard FETCH_HEAD
  sleep 30
done
