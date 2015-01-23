/* SQL script to create the database. Run this on your server. */

CREATE TABLE users (
	username varchar(30),
	password varchar(30),
	email varchar(30),
	PRIMARY KEY (username)
);

CREATE TABLE f_leagues(
	score_settings varchar(30),
	max_size int,
	name varchar(30),
	leagueID int AUTO_INCREMENT,
	date_created date,
	PRIMARY KEY (leagueID)
);

CREATE TABLE players (
	playerID int AUTO_INCREMENT,
	name varchar(30),
	hometown varchar(30),
	height int,
	weight int,
	dob date,
	PRIMARY KEY (playerID)
);

/* CREATE TABLE nhlers (
	playerID int,
	
);

CREATE TABLE prospects; */

CREATE TABLE nhl_teams (
	name varchar(30),
	city varchar(30),
	PRIMARY KEY (name)
);

CREATE TABLE f_teams (
	name varchar(30),
	username varchar(30),
	season varchar(30),
	leagueID int AUTO_INCREMENT,
	PRIMARY KEY (name, leagueID),
	FOREIGN KEY (leagueID) REFERENCES f_leagues(leagueID)
);

CREATE TABLE prospect_reports (
	playerID int,
	PRIMARY KEY (playerID),
	FOREIGN KEY (playerID) REFERENCES prospects(playerID)
);

CREATE TABLE stats_reports (
	playerID int,
	PRIMARY KEY (playerID),
	FOREIGN KEY (playerID) REFERENCES nhlers(playerID)
);

CREATE TABLE season_records (
	playerID int,
	team varchar(30),
	season varchar(30),
	games int,
	goals int,
	assists int,
	toi real,
	PRIMARY KEY (playerID, team, season),
	FOREIGN KEY (playerID) REFERENCES players(playerID),
	FOREIGN KEY (team) REFERENCES nhl_teams(name),
	FOREIGN KEY (season) REFERENCES seasons(season)
);

CREATE TABLE seasons (
	season VARCHAR(30),
	PRIMARY KEY (season)
);

CREATE TABLE player_assignments (
	playerID int,
	teamName varchar(30),
	leagueID int,
	PRIMARY KEY (playerID, teamName, leagueID),
	FOREIGN KEY (playerID) REFERENCES players,
	FOREIGN KEY (teamName, leagueID) REFERENCES f_teams (name, leagueID)
);