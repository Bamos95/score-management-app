# score-management-app

This project aims to develop a score management application for a sports tournament involving four teams: Alpha, Beta, Gamma, and Omega. The application will provide real-time tracking of scores and display a leaderboard.

## Table of Contents

- [Overview](#overview)
- [Environment Configuration](#environment-configuration)
- [Installation](#installation)
- [Usage](#usage)
- [Admin Access](#admin-access)
- [Data Security](#data-security)

## Overview

A regular user can:

- Access schedules for upcoming matches
- Track real-time match scores
- Access scores and statistics for all played matches
- Monitor the real-time ranking of the four tournament teams
- Get insights into tournament teams
- Create an account and log in

An admin user (administrator) can:

- Schedule and delete matches
- Add and remove a team
- Record match scores
- Start live broadcasting of match scores
- Stop live broadcasting of a match
- Record statistics for each team at the end of each match
- Access schedules for upcoming matches
- Track real-time match scores
- Access scores and statistics for all played matches
- Monitor the real-time ranking of the four tournament teams
- Get insights into tournament teams
- Create an account and log in

## Admin Access

The admin area login information is:

- Email: admin@gmail.com
- Password: Admin@@12

To add a new admin, modify the [user] table in the database. Change the [userGroup] attribute from 'sample' to 'admin'.

## Environment Configuration

- PHP (version 7.4 or higher)
- MySQL (version 5.7 or higher)
- Web server (e.g., Apache, Nginx)

## Installation

1. Clone this repository: https://github.com/Bamos95/score-management-app

2. Import the database from the `sportscores.sql` file.

3. Configure the database connection by modifying the [dbConnect()] function in the [method.php] file as follows:

   - $DB_USER = '[your-username]';
   - $DB_PASS = '[your-password]';

## Usage

1. Start your server.

2. Launch the project.

When the application is running, you can schedule and manage matches in real-time, as well as track scores and statistics.

## Data Security

Ensuring data security is a top priority for us. We have implemented encryption and authentication measures to protect the integrity of the scores and prevent any unauthorized access.

[© Bamos95]
