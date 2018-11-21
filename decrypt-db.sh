#!/bin/sh

openssl enc -d -aes-256-cbc -in lk.sql.enc -out lk.sql
