//{
//  "name": "demo",
//  "version": "0.0.0",
//  "devDependencies": {
//    "gulp": "latest",
//    "gulp-autoprefixer": "latest",
//    "gulp-cssbeautify": "latest",
//    "gulp-csscomb": "latest",
//    "gulp-load-plugins": "latest",
//    "gulp-sass": "latest",
//    "gulp-rename": "latest",
//    "gulp-csso": "latest"
//    "browser-sync": "latest"
//  }
//}

// Requires
var gulp = require('gulp');

var browserSync = require('browser-sync');
var babel = require('gulp-babel');


 
gulp.task('babel', () => {
	return gulp.src('src/**/*.js')
		.pipe(sourcemaps.init())
		.pipe(babel({
			presets: ['es2015']
		}))
		.pipe(concat('all.js'))
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('site/js'));
});

gulp.task('build', function () {

    return gulp.src(source + lessMain)

    .pipe(plugins.sass().on('error', plugins.sass.logError))
    .pipe(plugins.csscomb())
    .pipe(plugins.cssbeautify({indent: '  '}))
    .pipe(plugins.autoprefixer())
    .pipe(gulp.dest(destination + 'site/css/style.css'))
    .pipe(plugins.rename({suffix: '.min'}))
    .pipe(plugins.csso())
    .pipe(gulp.dest(destination + 'css/'));

});

gulp.task('browser-sync', function(){
    browserSync({
        notify: false,
        open: false,
        port: 2000,
        ghostMode: false,
        server: {
            baseDir: './',
            middleware: function (req, res, next) {
                console.log('Adding CORS header for ' + req.method + ': ' + req.url);
                res.setHeader('Access-Control-Allow-Origin', '*');
                next();
            }
        }

    });
});

gulp.task('watch', ['build', 'browser-sync'], function () {
    gulp.watch('./scss/**', ['build', browserSync.reload]);
    gulp.watch('index.html', [browserSync.reload]);
    //gulp.watch('src/js/**', [browserSync.reload]);
});

