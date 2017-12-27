#!/bin/bash

heroku pg:psql < sql/drop_tables.sql
heroku pg:psql < sql/create_tables.sql
heroku pg:psql < sql/add_test_data.sql