// Include gulp
var gulp = require('gulp');

// Include plugins
var concat = require('gulp-concat'),
	uglify = require('gulp-uglify'),
	rename = require('gulp-rename'),
	sass = require('gulp-sass'),
	cssnano = require('gulp-cssnano'),
	svgmin = require('gulp-svgmin'),
	autoprefixer = require('gulp-autoprefixer'),
	shell = require('gulp-shell'),
	uglify = require('gulp-uglify'),
	babel = require('gulp-babel'),
	replace = require('gulp-replace'),
	browserSync = require('browser-sync').create();

// Custom folder variables //////////////////////////////////////
var folderSrc = 'public/src/',
	folderDist = 'public/dist/';

gulp.task('sass', function() {
	return gulp.src([
		'node_modules/normalize.css/normalize.css',
		'public/src/styles/custom.scss'
		])
		.pipe(concat('all-styles.scss'))
		.pipe(sass({style: 'compressed'}).on('error', sass.logError))
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		// .pipe(cssnano())
		.pipe(rename({
			suffix: ".min"
		}))
		.pipe(gulp.dest('public/dist/'))
		.pipe(browserSync.stream());
});

gulp.task('compileJS',function() {
	return gulp.src( [
		'node_modules/vue/dist/vue.js',
		'node_modules/axios/dist/axios.js',
		'node_modules/plyr/dist/plyr.js',
		folderSrc + 'js/custom.js'
	])
		/*.pipe(babel({
			presets: ['es2015']
		}))*/
		.pipe(concat('all-scripts.js'))
		// .pipe(uglify())
		.pipe(rename({
			suffix: '.min'
		}))
		.pipe(gulp.dest(folderDist))
		.pipe(browserSync.stream());
});

gulp.task('startArtisanServer', shell.task([
	'php artisan serve --host 0.0.0.0'
]));

gulp.task('svgmin', function () {
	return gulp.src('public/src/img/ui/*.*')
		.pipe(svgmin())
		.pipe(rename(function(path) {
			path.extname = ".blade.php"
		}))
		.pipe(gulp.dest('resources/views/icon-files/'))
});

gulp.task('renameSVGs', function () {
	return gulp.src('public/src/img/ui/instruments/*.*')
		.pipe(rename(function(path) {
			path.extname = ".blade.php"
		}))
		.pipe(gulp.dest('resources/views/icons/instruments/'))
});

// Static server
gulp.task('browser-sync', function() {
	browserSync.init({
		browser: "google-chrome", // doesn't start chromium so far on my machine, but prevents firefox from starting :)
		proxy: "0.0.0.0:8000"
	});
});

gulp.task('antiCache', function () {
	return gulp.src('resources/views/src/app.blade.php')
		.pipe(replace('antiCacheString', Date.now()))
		.pipe(gulp.dest('resources/views/dist'));
});

gulp.task('watch', function() {
	gulp.watch('public/src/js/**', ['compileJS', 'antiCache']);
	gulp.watch('public/src/styles/**', ['sass', 'antiCache']);
	gulp.watch('public/src/img/ui/**', ['svgmin']);
	gulp.watch("*.html").on('change', browserSync.reload, ['antiCache']);
});

// Default Task
gulp.task('default', ['startArtisanServer', 'browser-sync', 'compileJS', 'antiCache', 'sass', 'svgmin', 'watch']);