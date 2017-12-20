# Project definition

## Description

A siplme web-based app to manage information on bike components and biking gear.

Inspired by the "My Gear" section in [Strava](https://www.strava.com). Where a user is able to define their bikes and the components attached to said bikes. However, the "My Gear" section is very simplistic. It isn't possible to easily swap components (like tires or wheels) on bikes or between bikes. There is also no way to track usage of other gear than components such as cycling shoes or clothes.

In this app the idea is to enable a user to define gear, components and bikes fairly freely and to allow flexible mixing an matching of components and gear.

Initially allow manual addition of bikes, components and gear. And define the relations between all of these. Also allow manual addition of "distance" to bikes that would cascade on to components currently connected to the bike.

Time permitting, add integration to the [Strava rest API](https://strava.github.io/api/) to allow automatic tracking of accrued distance.

Time permitting, add tagging functionality for gear and components to help keep track of component type, usability status and possibly compatibility.

## Environment

The app will be written in [php](http://php.net/manual/en/intro-whatis.php) and deployed on [Heroku](https://www.heroku.com/). Data will be stored in a [postgresql](https://www.postgresql.org/) database provided by Heroku.

The app will be designed to work on all modern browsers (with the possible exception of MS Internet Explorer and Edge) that support javascript.
