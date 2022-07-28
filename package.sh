#!/bin/bash 

mkdir -p releases

# Remove old packages
rm -rf ./releases/open-government-publications ./releases/open-government-publications.zip

# Create an optimized build of the JS app
npm run build:prod > /dev/null

# Copy current dir to tmp
rsync -ua . ./releases/open-government-publications/

# Remove current vendor & node_modules folder (if any) 
# and install the dependencies without dev packages.
cd ./releases/open-government-publications || exit
rm -rf ./vendor/ ./node_modules/
composer install -o --no-dev


# Remove unneeded files in a WordPress plugin
rm -rf ./.git ./composer.json ./composer.lock ./package.sh \
    ./.vscode ./workspace.code-workspace ./bitbucket-pipelines.yml \
    ./.phplint-cache ./.phpunit.result.cache ./.editorconfig ./.eslintignore \
    ./.eslintrc.json ./.gitignore ./phpunit.xml.dist ./psalm.xml ./releases \
    ./babel.config.json ./package.json ./package-lock.json ./tests ./assets/src
    
cd ../

# Create a zip file from the optimized plugin folder
zip -rq open-government-publications.zip ./open-government-publications
rm -rf ./open-government-publications

echo "Zip completed @ $(pwd)/open-government-publications.zip"
