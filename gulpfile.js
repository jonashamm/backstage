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
	livereload = require('gulp-livereload');

gulp.task('sass', function() {
	return gulp.src('public/src/styles/frontend-global.scss')
		.pipe(sass({style: 'compressed'}).on('error', sass.logError))
		.pipe(autoprefixer({
			browsers: ['last 2 versions'],
			cascade: false
		}))
		.pipe(cssnano())
		.pipe(gulp.dest('public/dist/'))
		.pipe(livereload());
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

gulp.task('watch', function() {
	livereload.listen();
	gulp.watch('public/src/styles/**', ['sass']);
	gulp.watch('public/src/img/ui/**', ['svgmin']);
});

// Default Task
gulp.task('default', ['startArtisanServer','sass','svgmin','watch']);