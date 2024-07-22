#!/bin/bash

# Configuration variables
DB_USER="postgres"
DB_NAME="em_wait_ash_tom"
DB_HOST="localhost"  # Use localhost if running locally, or specify the IP/hostname
DB_PASSWORD='1234'
DB_PORT='5432'

# Create Database
echo "Creating database..."
PGPASSWORD=$DB_PASSWORD psql -U $DB_USER -h $DB_HOST -p $DB_PORT -c "CREATE DATABASE $DB_NAME;"

# Check if the database was created successfully
if [ $? -eq 0 ]; then
    echo "Database created successfully."
else
    echo "Failed to create database."
    exit 1
fi

# Apply Schema
echo "Applying schema..."
PGPASSWORD=$DB_PASSWORD psql -U $DB_USER -d $DB_NAME -h $DB_HOST -p $DB_PORT -a -f db/schema.sql

# Insert Seed Data
echo "Inserting seed data..."
PGPASSWORD=$DB_PASSWORD psql -U $DB_USER -d $DB_NAME -h $DB_HOST -p $DB_PORT -a -f db/seed.sql

echo "Database setup complete!"