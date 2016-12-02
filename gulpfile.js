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
	browserSync = require('browser-sync').create();

gulp.task('sass', function() {
	return gulp.src('public/src/styles/custom.scss')
		.pipe(sass({style: 'compressed'}).on('error', sass.logError))
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		.pipe(cssnano())
		.pipe(gulp.dest('public/dist/'))
		.pipe(browserSync.stream());
});

gulp.task('startArtisanServer', shell.task([
	'php artisan serve --host 0.0.0.0'
]));

gulp.task('svgmin', function () {
	return gulp.src('public/src/img/ui/*.svg')
		.pipe(svgmin())
		.pipe(rename(function(path) {
			path.extname = ".blade.php"
		}))
		.pipe(gulp.dest('resources/views/icons/'))
});

// Static server
gulp.task('browser-sync', function() {
	browserSync.init({
		browser: "chromium-browser", // doesn't start chromium so far on my machine, but prevents firefox from starting :)
		proxy: "0.0.0.0:8000"
	});
});

gulp.task('watch', function() {
	gulp.watch('public/src/styles/**', ['sass']);
	gulp.watch('public/src/img/ui/**', ['svgmin']);
	gulp.watch("*.html").on('change', browserSync.reload);
});

// Default Task
gulp.task('default', ['startArtisanServer','browser-sync','sass','svgmin','watch']);