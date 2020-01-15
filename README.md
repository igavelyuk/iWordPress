# iwordpress
Boilerplate for Bootsrap Wordpress Theme

#### Modules and environment
* Based on

```bash
npm -v
6.4.1
node -v
v8.16.0
gulp -v
[01:17:02] CLI version 3.9.0
[01:17:02] Local version 3.9.1
```
* Order to install from Zero

```bash
npm init yourproject
sudo npm install -g n
sudo n 8.16.0
npm install gulp@3.9.1
npm install gulp-cssmin@0.2.0
npm install gulp-html-minify@0.0.14
sudo apt-get install libpng-dev
```

- download for Ubuntu 18 `http://security.ubuntu.com/ubuntu/pool/main/libp/libpng/libpng12-0_1.2.54-1ubuntu1.1_amd64.deb`
- install `sudo dpkg -i libpng12-0_1.2.54-1ubuntu1.1_amd64.deb`
- continue install

```bash
npm install gulp-image@4.3.0
npm i browser-sync@2.26.7 --save-dev
```

#### Install from Git clone

```bash
sudo npm install
```

#### Depencies
```
"dependencies": {
  "gulp": "^3.9.1",
  "gulp-cssmin": "^0.2.0",
  "gulp-html-minify": "0.0.14",
  "gulp-image": "^4.3.0",
  "gulp-minify": "^3.1.0",
  "gulp-sass": "^4.0.2"
},
"devDependencies": {
  "browser-sync": "^2.26.7"
}
```

#### Project folder structure
```bash
#/.git
#/node_modules
#package-lock.json
#/dist  <- minified files
# this kind of files not upload to github
/src
 index.html
    /css  <-sass ans css
      main.sass
      menu.sass
    /js   <-js
      script.js
    /json <-source files (db)
      productdb.json
      jsonReadme.md <-some explanations
    /img  <-images
.gitignore
gulpfile.js
package.json
README.md

```
