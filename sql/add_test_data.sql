--
-- heroku pg:psql < add_test_data.sql
--

INSERT INTO ut (username, password) VALUES ('saskeli', '$2y$10$0uXd41RE7pKywTQ.eyQZZ.7UtlPzZsp3ETt3ozGq4EZRptcQNSzDW');
INSERT INTO ut (username, password) VALUES ('admin', '$2y$10$t8nkPWyjBBnLRKkuuQAHF.XY4LElmICzK2GOSSYfm7gWJWP4fACiS');

INSERT INTO bike (user_id, distance, name, model, year, description)
VALUES (1, 500, 'Spessu', 'Specialized diverge comp carbon', 2017, 'Ostettu sellon pyörästä kesällä 2017. Kuiturunko ja Shimano 105 osasarja'),
    (1, 5000, 'Nisiki', 'Nishiki 401', 2015, 'Leppävaaran urheilust ostettu paska hybridi'),
    (1, 500, 'Biankki', 'Bianchi Via nirone 7', 2007, 'Matiaksen vanha Bianchi johon vaihdettu campan tilalle Shimano 105 osat');
INSERT INTO bike (user_id, distance, name, model, link, year, description)
VALUES (2, 20, 'Jopo', 'jopo 1v 24″ gold edition', 'www.jopo.fi/bike/jopo-1v-24-gold-edition/', 2017, 'Spessujopo');

INSERT INTO gear (user_id, name, model, link, year, in_use)
VALUES (1, 'Shimano winter', 'Shimano MW7 Enduro Trail', NULL, 2016, TRUE),
    (1, 'FiveTen', 'FiveTen Maltese Falcon', 'http://www.fiveten.com/us/maltese-falcon-2016-carbon-red', 2017, FALSE),
    (1, 'Windstopper jacket', 'Gore Windstopper soft shell jacket', 'http://www.goreapparel.co.uk/gore-bike-wear/men/e-windstopper-soft-shell-jacket/JWELMS.html?cgid=gbw-men-geartype-jackets-jackets&prefn1=colorRefinement&start=12&prefv1=08&dwvar_JWELMS_color=0899', 2016, TRUE),
    (2, 'Pillifarkut', 'Lee, LUKE - Slim fit -farkut', 'https://uk.lee.com/uk-en/mens-clothing/shop-by-fit/mens-slim-jeans/luke-l719lmhl.html', 2017, TRUE);

INSERT INTO component (user_id, bike_id, name, model, link, year, in_use)
VALUES (1, NULL, 'Mavic tubeless', 'Yksion Pro UST Tubeless ready 25-622', NULL, 2017, FALSE),
    (1, 2, 'Suomi 40', 'Suomi Tyres W240 A 40-622', 'http://www.suomityres.com/renkaat/?code=T201281&type=winter#specs_winter', 2017, TRUE),
    (1, 1, 'Schwalbe winter 30', 'Schwalbe Active Winter 30-622', 'https://www.schwalbe.com/en/spike-reader/winter.html', 2017, TRUE),
    (2, 4, 'Jopo rengas', 'JOPO RENGAS 47-507 MUSTA/VALKOINEN', 'http://www.joposhop.fi/fi/tuote/24262/62316jbw/jopo-rengas-47-507-musta-valkoinen/35227217/5', 2017, TRUE)
