#!/bin/bash

INTERVAL=1
while true; do

  php bdd.php

  # wait for next interval
  WAIT_UNTIL=$(($(date +%s) + $INTERVAL))
  while [ $(date +%s) -lt $WAIT_UNTIL ]; do
    sleep 1
  done

done
