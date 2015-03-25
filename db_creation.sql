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

CREATE TABLE nhl_teams (
 name varchar(30),
 city varchar(30),
 PRIMARY KEY (name)
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
 FOREIGN KEY (teamName) REFERENCES nhl_teams(name) ON DELETE CASCADE,
 FOREIGN KEY (season) REFERENCES seasons(season) ON DELETE CASCADE
);

CREATE TABLE prospects(
 playerID int,
 teamName varchar(30),
 PRIMARY KEY (playerID)
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
FROM f_teams JOIN (player_assignments NATURAL JOIN plays_for)
ON f_teams.teamID=player_assignments.teamID
GROUP BY f_teams.teamID;

Insert into users (username, password, email, is_admin) values
("luongo4eva", "abcdefg", "ab4d@gmail.com", true), 
("bruinzzz", "password", "b6e3@gmail.com", false),
("puckmaster70", "password", "lgjas@gmail.com", true),
("steve", "password", "sjjskd@yahoo.ca", false),
("chair", "password", "lsjf@hotmail.com", false);

Insert into seasons (season) values
("2014"),
("2013"),
("2012"),
("2011"),
("2010");

Insert into nhl_teams(name, city) values
("Canucks", "Vancouver, BC"),
("Bruins", "Boston, MA"),
("Blackhawks", "Chicago, IL"),
("Flyers", "Philladelphia, PA"),
("Rangers", "New York, NY");

Insert into f_leagues(max_size, name, date_created) values
(10, "Dobber Experts League", "2015-1-9"),
(12, "Rockey Horror Roto Show", "2015-4-9"),
(24, "Ultimate Hockey League", "2010-8-29"),
(10, "Newbz and Nerdz", "2014-1-9"),
(8, "What's a Puck?", "2015-10-10");

Insert into f_teams (name, username, season, leagueID) values
("Edler\'s Mind Tricks", "luongo4eva", "2014", 1),
("As Gudas it Gets", "bruinzzz", "2014", 1),
("Malkin X", "puckmaster70", "2013", 3),
("Texas Kane Shaw Massacre", "chair", "2010", 4),
("Fleetwood Mackinnon", "chair", "2014", 1);

Insert into players(name, hometown, height, weight, dob) values
("Wayne Gretzky", "Brantford, ON", 72, 185, "1961-1-26"),
("Zdeno Chara", "Trencin, CZ", 81 , 255, "1977-3-18"),
("Roberto Luongo", "Montreal, QC", 75, 217, "1979-4-4"),
("Bo Horvat", "London, ON", 72, 206, "1995-4-5"),
("Ryan Miller", "East Lansing, MI", 74, 168, "1980-7-17"),
("Jonathan Drouin", "Vancouver, BC", 72, 185, "1961-1-26"),
("Connor McDavid", "Winnipeg, MB", 81, 255, "1977-3-18"),
("Jakob Markstrom", "Stockholm, SW", 75, 217, "1979-4-4");

insert into plays_for (playerID, teamName, gamesPlayed, goals, hits, giveaways, takeaways, penalties_drawn, SAcorsi, qot, qoc, ozs, toi, season) values
(1, "Canucks", 80, 60, 300, 100, 1600, 1, 99.9, 303, 1.6, 1.3, 70.9, "2010"),
(2, "Blackhawks", 78, 10, 2, 80, 1405, 2, 50.2, 2, 1.4, 2.1, 44.5, "2011"),
(3, "Rangers", 77, 2, 1, 78, 1799, 3, 55.5, 4, 0.5, 2.7, 76.3, "2012"),
(4, "Flyers", 69, 40, 10, 209, 900, 4, 44.5, 90, 2.3, 1.5, 50, "2013"),
(5, "Bruins", 73, 20, 30, 5, 1500, 5, 2.4, 5, 2.2, 0.9, 60.3, "2014");

Insert into prospects(playerID,teamName) values
(1, "Canucks"),
(2, "Bruins"),
(3, "Blackhawks"),
(4, "Flyers"),
(5, "Rangers");

Insert into player_assignments(playerID, teamID) values
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5);

Insert into manages(username, leagueID) values
("luongo4eva", 1),
("luongo4eva", 2),
("luongo4eva", 3),
("luongo4eva", 4),
("luongo4eva", 5);
