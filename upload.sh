#!/bin/sh
git pull origin main
cd ..
zip -r capslok-politics.zip capslok-politics
scp -i ~/Documents/AWS\ Key\ Pairs/capslok-political.pem ~/Documents/laravel/capslok-politics.zip ubuntu@ec2-35-183-21-122.ca-central-1.compute.amazonaws.com:~/.
ssh -i ~/Documents/AWS\ Key\ Pairs/capslok-political.pem  ubuntu@ec2-35-183-21-122.ca-central-1.compute.amazonaws.com

