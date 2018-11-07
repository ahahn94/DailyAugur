#!/usr/bin/env bash
# Use this file if you want to start the server by cron.
DAILYAUGUR_PATH=foo # absolute path to your DailyAugur-Installation.
COMPOSE_FILE=bar # name of your docker-compose file (armhf.yaml or amd64.yaml).
# If no option -> start server.
if [ $# -eq 0 ]; then
docker-compose -f $DAILYAUGUR_PATH/$COMPOSE_FILE up
else
if [ $1 = "start" ]; then
# If option is start -> start server.
    docker-compose -f $DAILYAUGUR_PATH/$COMPOSE_FILE up
    elif [ $1 = "stop" ]; then
    # If option is stop -> stop server.
    docker-compose -f $DAILYAUGUR_PATH/$COMPOSE_FILE stop
    elif [ $1 = "delete" ]; then
    # If option is delete -> stop server and delete containers.
    docker-compose -f $DAILYAUGUR_PATH/$COMPOSE_FILE down
    elif [ $1 = "build" ]; then
    # If option is build -> rebuild images and start server.
    docker-compose -f $DAILYAUGUR_PATH/$COMPOSE_FILE up --build
fi
fi