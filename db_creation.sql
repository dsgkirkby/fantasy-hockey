DROP TABLE IF EXISTS prospects CASCADE;
DROP TABLE IF EXISTS plays_for CASCADE;
DROP TABLE IF EXISTS player_assignments CASCADE;
DROP TABLE IF EXISTS f_teams CASCADE;
DROP TABLE IF EXISTS seasons CASCADE;
DROP TABLE IF EXISTS nhl_teams CASCADE;
DROP TABLE IF EXISTS players CASCADE;
DROP TABLE IF EXISTS manages CASCADE;
DROP TABLE IF EXISTS f_leagues CASCADE;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS nhl_divisions CASCADE;

DROP VIEW IF EXISTS team_stats;

CREATE TABLE users (
 username varchar(30) NOT NULL UNIQUE,
 password varchar(30) NOT NULL,
 email varchar(30) NOT NULL UNIQUE,
 is_admin boolean,
 PRIMARY KEY (username)
);

CREATE TABLE f_leagues(
 max_size int,
 name varchar(30),
 leagueID int NOT NULL AUTO_INCREMENT,
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

CREATE TABLE nhl_divisions (
 divisionName varchar(30),
 divisionID int AUTO_INCREMENT,
 PRIMARY KEY(divisionID)
);

CREATE TABLE nhl_teams (
 teamName varchar(30),
 city varchar(30),
 divisionID int,
 PRIMARY KEY (teamName),
 FOREIGN KEY (divisionID) REFERENCES nhl_divisions(divisionID)
);

CREATE TABLE seasons (
 season VARCHAR(30),
 PRIMARY KEY (season)
);

CREATE TABLE f_teams (
 teamID int AUTO_INCREMENT,
 name varchar(30),
 username varchar(30),
 season varchar(30),
 leagueID int,
 PRIMARY KEY (teamID),
 FOREIGN KEY (leagueID) REFERENCES f_leagues(leagueID) ON DELETE CASCADE,
 FOREIGN KEY (username) REFERENCES users(username) ON DELETE CASCADE
);

CREATE TABLE player_assignments (
 playerID int,
 teamID int,
 PRIMARY KEY (playerID, teamID),
 FOREIGN KEY (playerID) REFERENCES players(playerID) ON DELETE CASCADE,
 FOREIGN KEY (teamID) REFERENCES f_teams(teamID) ON DELETE CASCADE
);

CREATE TABLE plays_for(
 playerID int,
 teamName varchar(30),
 gamesPlayed int,
 goals int,
 hits int,
 giveaways int,
 takeaways int,
 penalties_drawn int,
 sacorsi real,
 qot real,
 qoc real,
 ozs real,
 toi int,
 season varchar(30),
 PRIMARY KEY (playerID, teamName, season),
 FOREIGN KEY (playerID) REFERENCES players(playerID) ON DELETE CASCADE,
 FOREIGN KEY (teamName) REFERENCES nhl_teams(teamName) ON DELETE CASCADE,
 FOREIGN KEY (season) REFERENCES seasons(season) ON DELETE CASCADE
);

CREATE TABLE manages(
 username varchar(30),
 leagueID int,
 primary key (leagueID, username),
 foreign key (leagueID) references f_leagues(leagueID) ON DELETE CASCADE,
 foreign key (username) references users(username) ON DELETE CASCADE
);

CREATE VIEW team_stats AS
SELECT f_teams.teamID, f_teams.name, f_teams.username, f_teams.season, f_teams.leagueID,
SUM(plays_for.goals) AS totalGoals,
SUM(plays_for.gamesPlayed) AS totalGames,
SUM(plays_for.hits) AS totalHits
FROM f_teams LEFT JOIN (player_assignments NATURAL JOIN plays_for)
ON f_teams.teamID=player_assignments.teamID
GROUP BY f_teams.teamID;


