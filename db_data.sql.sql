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

Insert into nhl_divisions (divisionName) values
("Pacific"),
("Central"),
("Metropolitan"),
("Atlantic");

Insert into nhl_teams(teamName, city, divisionID) values
("Canucks", "Vancouver, BC", 1),
("Bruins", "Boston, MA", 3),
("Blackhawks", "Chicago, IL", 2),
("Flyers", "Philladelphia, PA", 3),
("Rangers", "New York, NY", 3);

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

Insert into players(name, hometown, weight, height, dob) values
("Wayne Gretzky", "Brantford, ON", 72, 185, "1961-1-26"),
("Zdeno Chara", "Trencin, CZ", 81 , 255, "1977-3-18"),
("Roberto Luongo", "Montreal, QC", 75, 217, "1979-4-4"),
("Bo Horvat", "London, ON", 72, 206, "1995-4-5"),
("Ryan Miller", "East Lansing, MI", 74, 168, "1980-7-17");

insert into plays_for (playerID, teamName, gamesPlayed, goals, hits, giveaways, takeaways, penalties_drawn, SAcorsi, qot, qoc, ozs, toi, season) values
(1, "Canucks", 80, 60, 300, 100, 1600, 1, 99.9, 303, 1.6, 1.3, 70.9, "2010"),
(2, "Blackhawks", 78, 10, 2, 80, 1405, 2, 50.2, 2, 1.4, 2.1, 44.5, "2011"),
(3, "Rangers", 77, 2, 1, 78, 1799, 3, 55.5, 4, 0.5, 2.7, 76.3, "2012"),
(4, "Flyers", 69, 40, 10, 209, 900, 4, 44.5, 90, 2.3, 1.5, 50, "2013"),
(5, "Bruins", 73, 20, 30, 5, 1500, 5, 2.4, 5, 2.2, 0.9, 60.3, "2014");

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
