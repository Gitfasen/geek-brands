var gulp	= require('gulp'),
		cleancss			= require('gulp-clean-css'),
		autoprefixer	= require('gulp-autoprefixer'),
		less					= require('gulp-less'),
		rename 				= require("gulp-rename"),
		concat 				= require('gulp-concat'),
		uglify 				= require('gulp-uglify'),
		pipeline 			= require('readable-stream').pipeline,
		importAllFile	= require('less-plugin-glob'),
		sourcemaps		= require('gulp-sourcemaps');

var link = {
	'dev' : {
		'less' : 'less/',
		'js'   : 'js/'
	}
}
console.log(importAllFile);

gulp.task('less', function() {
	return gulp.src( link.dev.less + 'main.less')
	.pipe(sourcemaps.init())
	.pipe(less({plugins: [ importAllFile ]}))
	.pipe(sourcemaps.init({loadMaps: true}))
	.pipe(rename({ suffix: '.min', prefix : '' }))
	.pipe(autoprefixer(['cover 99.5%']))
	.pipe(cleancss())
	.pipe(sourcemaps.write())
	.pipe(gulp.dest( './../css/' ))
});

gulp.task('compress-js', function() {
	return pipeline(
		gulp.src([link.dev.js + '*.js']),
		concat('all.js'),
		uglify(),
		gulp.dest('./../js/'))
});

gulp.task('watch', ['less', 'compress-js'], function() {
	gulp.watch( link.dev.less + '**/*.less', ['less']);
	gulp.watch( link.dev.less + '**/*.css', ['less']);
});

gulp.task('default', ['watch']);